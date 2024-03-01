<?php

namespace App\Http\Controllers\Astrology\API;

use App\Models\Astrology\CustomerDetails;
use App\Models\Astrology\Http\Resources\CustomerDetailsResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Astrology\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_details = CustomerDetails::where('user_id',auth('api')->user()->id)->get();
        return CustomerDetailsResource::collection($customer_details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerDetails  $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerDetails $customerDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerDetails  $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerDetails $customerDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerDetails  $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $user = User::find(auth()->id());
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        $userDetails = CustomerDetails::where('user_id',auth('api')->user()->id)->first();

         if(($userDetails->date_of_birth != $request['details']['date_of_birth']) OR ($userDetails->time_of_birth != $request['details']['time_of_birth']) OR ($userDetails->country_of_birth != $request['details']['country_of_birth']) OR ( $userDetails->state_of_birth != $request['details']['state_of_birth'])){
                    $chat = new Chat();
                    $chat->sender_id = auth()->user()->id;
                    $chat->receiver_id = 0;
                    $message = "Customer Details Changed<br>Date of Birth: ".$userDetails->date_of_birth." to ".$request['details']['date_of_birth']."<br>Time of Birth: ".$userDetails->time_of_birth." to ". $request['details']['time_of_birth']."<br>Country of Birth: ".$userDetails->country_of_birth." to ".$request['details']['country_of_birth']."<br>State of Birth: ".$userDetails->state_of_birth." to ".$request['details']['state_of_birth']."<br>City of Birth: ".$userDetails->city_of_birth." to ".$request['details']['city_of_birth']."<br>Gender: ".$userDetails->gender." to ".$request['details']['gender'];
                    $chat->message = $message;
                    $chat->read = 0;
                    $chat->save();
                }
        $userDetails->gender = $request['details']['gender'];
        $userDetails->country_of_birth = $request['details']['country_of_birth'];
        $userDetails->state_of_birth = $request['details']['state_of_birth'];
        $userDetails->city_of_birth = $request['details']['city_of_birth'];
        $userDetails->kundali = $request['details']['kundali'];
        $userDetails->date_of_birth = $request['details']['date_of_birth'];
        $userDetails->time_of_birth = $request['details']['time_of_birth'];
        $userDetails->is_time_accurate = $request['details']['is_time_accurate'];
        $userDetails->save();
        return new UserResource($user);


    }
    public function updateUserImage(Request $request){
        $userDetails = CustomerDetails::where('user_id',auth('api')->user()->id)->first();
        $image = $request->file('file');

        if ($image) {

            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'backend/assets/img/customer/';
            $image_url = $upload_path . $image_full_name;
            \Intervention\Image\Facades\Image::make($image)->resize(200, 200)->save($upload_path . $image_full_name);
            $userDetails->imageUrl= $image_url;
        }

        $userDetails->save();
        $user = User::with('details')->where('id',auth('api')->user()->id)->first();
        return new UserResource($user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerDetails  $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerDetails $customerDetails)
    {
        //
    }
}
