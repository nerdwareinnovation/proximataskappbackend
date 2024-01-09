<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
    public function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPassword = Hash::check($request->current_password, auth()->user()->password);
        if($currentPassword){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'message'=>"Password Updated Successfully",
                'status'=>200,
            ]);

        }
        else
        {
            return response()->json([
                'message'=>"Current password doesn't match ",
                'status'=>200,
            ]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.passwords.email', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->Json(['message'=> 'We have e-mailed your password reset link!']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return response()->Json(['message'=> 'Your password has been changed!']);
    }
}
