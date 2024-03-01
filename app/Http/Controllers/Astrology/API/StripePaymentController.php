<?php

namespace App\Http\Controllers\Astrology\API;

use App\Models\Astrology\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Stripe;
class StripePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Stripe\Charge::create ([
            "amount" =>  $request->amount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Aspect Astrology Package Payment"
        ]);

        if($charge->status == 'succeeded'){
            $transaction = new Transaction();
            $transaction->transaction_id = $charge->id;
            $transaction->package_id = $request->package_id;
            $transaction->customer_id = auth()->user()->id;
            $transaction->price =  $request->amount ;
            $transaction->status = $charge->status;
            $transaction->method = "Stripe";
            $transaction->save();

        };


        Session::flash('success', 'Payment successful!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
