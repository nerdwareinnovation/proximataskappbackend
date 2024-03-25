<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\Models\Astrology\CustomerPackage;

class CustomerController extends Controller
{
    public function filterCustomer(Request $request){
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);

        $customers = User::role('customer')->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start)->get();

        return view('astro.admin.customerList')->with(compact('customers','start','end'));

    }
    public function updateAvailableQuestion(Request $request,$id){
        $customer_package = CustomerPackage::where('customer_id',$id)->first();
        $customer_package->question_left =  $request->question_left;
        $customer_package->save();
        return redirect()->back()->with('success','Question Assigned Successfully');
    }
    public function getCustomerList(Request $request){
//        try{
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = User::role('customer')->select('count(*) as allcount')->count();

//        $searchByCategory = $request->get('category');
//        $searchBySubCategory = $request->get('subCategory');
//        $searchByReporter = $request->get('reporter');
//        $searchByStatus = $request->get('status');
        $query = User::role('customer');
        ## Search

//        if($searchByCategory != ''){
//            $query->whereHas('category',function($q) use($searchByCategory) {
//                $q->where('category_id', '=', $searchByCategory);
//            });
//        }
//        if($searchBySubCategory != ''){
//            $query->whereHas('subcategory',function($q) use($searchBySubCategory) {
//                $q->where('sub_category_id', '=', $searchBySubCategory);
//            });
//        }
//        if($searchByReporter != ''){
//            $query->where('reporter',$searchByReporter);
//        }
//        if($searchByStatus != ''){
//            $query->where('published',$searchByStatus);
//        }
        $totalRecordswithFilter = $query->get()->count();

        if ($searchValue != null){
            // Fetch records
            $records = $query->orderBy('created_at','desc')
                ->where('users.name', 'like', '%' .$searchValue. '%')
                ->select('users.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
        }
        else{
            $records = $query->orderBy('created_at','desc')
                ->select('users.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
        }
        $data_arr = array();

        foreach($records as $record){
            $avatar = '';
            if($record->isOnline()){
                $avatar .=  '<div class="avatar avatar-xl avatar-indicators avatar-online">';
            }
            else{
                $avatar .=  '<div class="avatar avatar-xl avatar-indicators avatar-offline">';

            }
            if (isset($record->details)){
                if ($record->details->image_url != null){
                $img_url =asset(@$record->details->image_url);
                }
                else{
                    $img_url = asset('avatar.jpg');
                }
            }
            else{
                $img_url = asset('avatar.jpg');
            }
            $avatar .= '<img alt="avatar" src="'.$img_url.'" class="rounded-circle" />';
            $avatar .= '</div>';
            $customer = $record->name;

            $status ='';
            $action = '';
            switch ($record->status){
                case 1:
                    $status = '  <span class="badge badge-success">Active</span>';
                    $action = '<a href="'.URL::to('admin/user/disable/'.$record->id).'" id="disable">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </a>';
                    break;
                default:
                    $status = '  <span class="badge badge-danger">Inactive</span>';
                    $action = ' <a href="'.URL::to('admin/user/active/'.$record->id).'" id="enable">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </a>';
                    break;
            }
            $assign_question = '<a onclick="updateQuestion('.$record->id.','.@$record->package->question_left.')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#322edc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                               </a>
                                ';
            $action .= $assign_question;
            $data_arr[] = array(
                "avatar" => $avatar,
                "name"=> $customer . ' | <a onclick="searchCustomer('.$record->id.')"><b>ID:' . $record->id.'</b></a>',
                "email"=> $record->email,
                "package"=> 'Type: '.@$record->package->package->name.'<br>'.'Questions Left: '.@$record->package->question_left.'<br>'.'Questions Asked: '.@$record->package->question_asked,
                "platform"=> @$record->details->platform,
                "status"=> $status,
                "actions" => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
//        }
//        catch (\Exception $e) {
//            return back()->with('error',$e->getMessage());
//        }
    }
}
