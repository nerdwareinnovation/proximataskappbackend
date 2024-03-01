<?php

namespace App\Http\Controllers\Astrology\API;

use App\Models\Astrology\CustomerPackage;
use App\Models\Astrology\Package;
use App\Models\Astrology\Transaction;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function buyPackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|int'


        ]);
        $package = Package::where('id',$request['package_id'])->first();

        $customer_package = CustomerPackage::where('customer_id',auth('api')->user()->id)->first();
        $customer_package->package_id = $request['package_id'];
        $questions_left = $customer_package->question_left + $package->number_of_questions;
        $customer_package->question_left = $questions_left;
        $customer_package->save();


        return response()->json([
            'message' => $package->name,
            'error' => $validator->errors(),
        ], 201);
    }

    public function customerBuyPackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_type' => 'required'


        ]);

        $package = Package::where('revenue_cat_identifier',$request['package_type'])->first();

        $customer_package = CustomerPackage::where('customer_id',auth('api')->user()->id)->first();
        $customer_package->package_id = $package->id;
        $questions_left = $customer_package->question_left + $package->number_of_questions;
        $customer_package->question_left = $questions_left;
        $customer_package->save();

        $transaction = new Transaction();
        $transaction->transaction_id = "ANDROID-MOBILE-".$customer_package->id.now();
        $transaction->package_id = $package->id;
        $transaction->customer_id = auth('api')->user()->id;
        $transaction->price = $package->price;
        $transaction->status = 'succeeded';
        $transaction->method = 'GOOGLE PAY';
        $transaction->save();



        return response()->json([
            'message' => $package->name,
            'error' => $validator->errors(),
        ], 201);
    }
}
