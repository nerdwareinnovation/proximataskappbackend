<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\ModeratorDetails;
use App\Models\Astrology\Chat;
use App\Models\User;
use App\Models\Astrology\PostponeTask;
use App\Models\Astrology\AstrologerQuery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorController extends Controller
{
    public function moderatorList(){
        $moderators = User::all()->where('role_id','=','4');
        return view('astro.admin.moderatorList')->with(compact('moderators'));
    }
    public function addNewModerator(){
        return view('astro.admin.addNewModerator');
    }
    public function editModerator($id){
            $moderator = User::with('moderatorDetails')->where('id',$id)->first();

            return view('astro.admin.editModerator')->with(compact('moderator'));
        }
    public function filterModerator(Request $request){
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);

        $moderators = User::where('role_id','4')->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start)->get();

        return view('astro.admin.moderatorList')->with(compact('moderators','start','end'));

    }

    public function updateModerator(Request $request){

     $validated = $request->validate([
                'moderator_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'contact_no' => 'required',

            ]);

            $user =  User::find($request['moderator_id']);
            $user->name=$request['name'];
            $user->email=$request['email'];

            $user->save();
            $moderatorDetails = ModeratorDetails::where('user_id','=',$request['moderator_id'])->first();
            $moderatorDetails->address=$request['address'];
            $moderatorDetails->contact_no=$request['contact_no'];
            $moderatorDetails->astro_name=$request['astro_name'];
            $moderatorDetails->save();

              return $this->moderatorList();



    }

    public function storeModerator(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'astro_name' => 'required',
        ]);
        $user = new User();
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->role_id=4;
        $user->password=bcrypt($request['password']);
        $user->save();
        $moderator_details = new ModeratorDetails();
        $moderator_details->address = $request['address'];
        $moderator_details->contact_no = $request['contact_no'];
         $moderator_details->astro_name = $request['astro_name'];
        $moderator_details->user_id = $user->id;
        $image = $request->file('image');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'backend/assets/img/astrologer/';
            $image_url = $upload_path . $image_full_name;
            \Intervention\Image\Facades\Image::make($image)->save($upload_path . $image_full_name);
            $moderator_details->image_url= $image_url;
        }
        $moderator_details->save();
        return redirect()->route('admin.moderators');
    }
    public function moderatorKPI(Request $request,$id){
        $user = User::find($id);
        $data['questions_answered'] =Chat::where('receiver_id',$id)->where('read',2)->count();
        $data['questions_postponed'] = PostponeTask::where('user_id',$id)->count();
        $data['astrologer_name'] = $user->name;
        $rating = AstrologerQuery::with('customer_rating')->where('astrologer_id',$id)->get();


        $data['rating'] =  round($rating->avg('customer_rating.rating'),2);
        $data['total_raters_count'] = count($rating);
        return view('astro.admin.moderatorKPIDetails')->with($data);
    }
}
