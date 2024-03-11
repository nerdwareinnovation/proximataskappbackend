<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\AstrologerQuery;
use App\Models\Astrology\Chat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueryController extends Controller
{
    public function queryList(){
//        $queries = Chat::whereHas('sender', function ($query){
//                    $query->where('role_id', '2');
//                })->where('receiver_id','!=',0)->latest()->get();


        return view('admin.queryList');
    }
    public function getQueryList(Request $request){
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
        $totalRecords = Chat::select('count(*) as allcount')->count();

//        $searchByCategory = $request->get('category');
//        $searchBySubCategory = $request->get('subCategory');
//        $searchByReporter = $request->get('reporter');
//        $searchByStatus = $request->get('status');
        $query = Chat::query()->whereHas('sender', function ($query){
            $query->where('role_id', '2');
        })->where('receiver_id','!=',0);
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
                ->join('users','chats.sender_id','=','users.id')
                ->where('chats.sender_id', 'like', '%' .$searchValue. '%')
                ->orWhere('users.name', 'like', '%' .$searchValue. '%')
                ->select('chats.*','users.name')
                ->skip($start)
                ->take($rowperpage)
                ->get();
        }
        else{
            $records = $query->orderBy('created_at','desc')
                ->select('chats.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
        }
        $data_arr = array();

        foreach($records as $record){
            $customer = $record->sender->name;
            $id = $record->id;
            $query_time = '';
            switch ($record->read){
                case 0:
                    $read_status = '<div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div>';
                    $query_time = $record->created_at;
                    break;
                case 1:
                    $read_status = '<div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer a.'.@User::find($record->astrologerQuery->astrologer_id)->name.'</span></div>';
                    $query_time = $record->astrologerQuery->moderated_at;
                    break;
                case 2:
                    $read_status = '<div class="td-content"><span class="badge outline-badge-success">Answered by m.'.@User::find($record->astrologerQuery->moderator_id)->name.' | a.'.@User::find($record->astrologerQuery->astrologer_id)->name.'</span></div>';
                    $query_time = $record->astrologerQuery->updated_at;
                    break;
                case 5:
                    $read_status ='<div class="td-content"><span class="badge outline-badge-secondary">Answer Ready to be Moderated m.'.@User::find($record->astrologerQuery->moderator_id)->name.'</span></div>';
                    $query_time = $record->astrologerQuery->astrologer_answer_at;
                    break;
                case 6:
                    $read_status ='<div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div>';
                    $query_time = $record->updated_at;
                    break;
                case 8:
                    $read_status = '<div class="td-content"><span class="badge outline-badge-danger">Clarified</span></div>';
                    $query_time = $record->updated_at;
                    break;
                case 11:
                    $read_status = '<div class="td-content"><span class="badge outline-badge-success">Answered as Pyschologist by m.'.@User::find($record->astrologerQuery->moderator_id)->name.'</span></div>';
                    $query_time = $record->updated_at;
                    break;
                default:
                    $read_status ='<div class="td-content"><span class="badge outline-badge-danger">Undefined</span></div>';
                    $query_time = $record->updated_at;
                    break;
            }

            $data_arr[] = array(
                "customer" => $customer . ' | <a onclick="searchCustomer('.$record->sender_id.')"><b>ID:' . $record->sender_id.'</b></a>',
                "status"=>$read_status,
                "query_time"=>Carbon::createFromDate($query_time)->format('d-M y H:i'),
                "actions" => '<a href="'.URL('admin/customer/'.$record->id).'">View</a>'
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
    public function filterQuery(Request $request){
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);
        $queries = Chat::whereHas('sender', function ($query){
                    $query->where('role_id', '2');
                })->where('receiver_id','!=',0)->whereDate('created_at','<=',$end)
                                                           ->whereDate('created_at','>=',$start)->get();


        return view('astro.admin.queryList')->with(compact('queries','start','end'));

    }
    public function queryCheck(){
        $moderators = User::all()->where('role_id','=','4');
        $moderator_count = 0;
        $mod_id = 0;
        $filtered_moderators = $moderators->filter(function ($item) {
            return $item->isOnline();
        })->values();
        if(count($filtered_moderators) != 0){
            foreach ($filtered_moderators as $filters){
                $chats = (AstrologerQuery::with(['chat' => function($q){
                    $q->where('chats.sender_id', '=', 2);
                }])->where('moderator_id','=',$filters->id)->get());
                if($moderator_count < count($chats)){
                    $moderator = $filters;

                }
                $moderator_count = count($chats);

            }
        }
        else{
            $moderator = $moderators->random();
        }

    }
}
