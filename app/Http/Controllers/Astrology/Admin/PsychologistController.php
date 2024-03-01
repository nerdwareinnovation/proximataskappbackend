<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\AstrologerDetails;
use App\Models\Astrology\PsychologistDetails;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PsychologistController extends Controller
{
    public function addNewPsychologist(){
        return view('admin.addNewPsychologist');
    }
    public function storePsychologist(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'designation' => 'required',
        ]);
        $user = new User();
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->role_id=5;
        $user->password=bcrypt($request['password']);
        $user->save();
        $psychologist_details = new PsychologistDetails();
        $psychologist_details->designation = $request['designation'];
        $psychologist_details->user_id = $user->id;
        $image = $request->file('image');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'backend/assets/img/psychologist/';
            $image_url = $upload_path . $image_full_name;
            \Intervention\Image\Facades\Image::make($image)->save($upload_path . $image_full_name);
            $psychologist_details->image_url= $image_url;
        }
        $psychologist_details->save();
        return redirect()->route('admin.addPsychologist');
    }
}
