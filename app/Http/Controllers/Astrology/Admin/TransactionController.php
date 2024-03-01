<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Astrology\CustomerPackage;
use App\Models\Astrology\Package;
class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('customer','package')->get();

        return view('admin.transaction')->with(compact('transaction'));
    }
    public function subscriptionUpdate(Request $request){
        $parts = explode(':', $request->event['product_id']);
        $packageBuy=$parts[0];
        if ($request->event['type'] == 'RENEWAL'){
       $user = User::where('email',$request->event['app_user_id'])->first();
       if ($user){

           $package = Package::where('identifier',$packageBuy)->first();

           $customer_package = CustomerPackage::where('customer_id',$user->id)->first();
           $customer_package->package_id = $package->id;
           $questions_left = $customer_package->question_left + $package->number_of_questions;
           $customer_package->question_left = $questions_left;
           $customer_package->save();

           $transaction = new Transaction();
           $transaction->transaction_id = "ANDROID-MOBILE-".$customer_package->id.now();
           $transaction->package_id = $package->id;
           $transaction->customer_id = $user->id;
           $transaction->price = $package->price;
           $transaction->status = 'succeeded';
           $transaction->method = 'GOOGLE PAY AUTO RENEW';
           $transaction->save();



           return response()->json([
               'message' => $package->name,
           ], 201);
//           print_r($user);
       }
        }
    }
}
