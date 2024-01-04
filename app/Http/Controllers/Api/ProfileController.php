<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfile($id,  Request $request )
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'date_of_birth'=>'required',
            'birth_city'=>'required',
            'birth_state'=>'required',
            'birth_country'=>'required',
            'birth_time'=>'required',
            'gender'=>'required',
            'interested_in'=>'required',
            'current_city'=>'required',
            'current_state'=>'required',
            'current_country'=>'required',
            'bio'=>'required',
            'occupation'=>'required',
            'relationship_status'=>'required',

            ]);
        $record = User::find($id);
        $record->name = $request->name;
        $record->email = $request->email;
        $record->date_of_birth = $request->date_of_birth;
        $record->birth_city = $request->birth_city;
        $record->birth_state = $request->birth_state;
        $record->birth_country = $request->birth_country;
        $record->birth_time = $request->birth_time;
        $record->gender = $request->gender;
        $record->interested_in = $request->interested_in;
        $record->current_city = $request->current_city;
        $record->current_state = $request->current_state;
        $record->current_country = $request->current_country;
        $record->bio = $request->bio;
        $record->occupation = $request->occupation;
        $record->relationship_status = $request->relationship_status;

        if (isset($request->open_to_job)){
            $record->open_to_job=1;
        }else{
            $record->open_to_job=0;
        }
        if(isset($request->open_to_date)){
            $record->open_to_date=1;
        }
        else
        {
            $record->open_to_date = 0;
        }
        if(isset($request->is_time_accurate)){
            $record->is_time_accurate=1;
        }
        else
        {
            $record->is_time_accurate = 0;
        }
        if(isset($request->is_verified)){
            $record->is_verified=1;
        }
        else
        {
            $record->is_verified = 0;
        }
        if(isset($request->is_profile_detail_complete)){
            $record->is_profile_detail_complete=1;
        }
        else
        {
            $record->is_profile_detail_complete = 0;
        }

        $record->save();
        return response()->json([
            'data'=> $record,
            'message'=>"User profile has been updated successfully",
            'status'=>200,
        ]);
    }
}
