<?php

namespace App\Http\Controllers;

use App\Models\Astrology\Transaction;
use Illuminate\Http\Request;
use Session;
use Stripe\Customer;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = auth()->user();
        $token =  $request->stripeToken;
        if (is_null($user->stripe_id)) {
            $stripeCustomer = $user->createAsStripeCustomer();
        }

        Customer::createSource(
            $user->stripe_id,
            ['source' => $token]
        );
        $request->user()
            ->newSubscription('default', $request->plan_id)
            ->create();

//        if($charge->status == 'succeeded'){
           $transaction = new Transaction();
           $transaction->transaction_id = $charge->id;
            $transaction->package_id = $request->package_id;
            $transaction->customer_id = auth()->user()->id;
            $transaction->price =  $request->amount ;
            $transaction->status = $charge->status;
            $transaction->method = "Stripe";
            $transaction->save();

//        };


        Session::flash('success', 'Payment successful!');

        return back();
    }
}
