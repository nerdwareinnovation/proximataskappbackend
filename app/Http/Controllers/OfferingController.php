<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferingController extends Controller
{
    //
    public function store(Request $request)
    {
        $entitlement = $request->entitlement_id;
        $offerings = $request->offering_id;

        $this->getOfferings($offerings);
        $this->update($offerings);
        $this->delete($offerings);
    }

    public function createOffering(Request $request)
    {

        $client = new \GuzzleHttp\Client();
        $lookup= $request->lookup_key;
        $display=$request->display_name;
        $body = [
            'lookup_key'=> $lookup,
            'display_name'=>$display,
        ];

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings', [
            'body' =>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        return redirect('/offering');
    }

    public function listOffering()
    {


        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings?&limit=20&expand=items.package.product', [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= $bodyContent->items;
//        dd($items);
        return view('backend.revenueCat.Offerings.index')->with(compact('items'));
    }

    public function getOfferings($offerings)
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings.'?expand=package.product', [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        $items = json_decode( $response->getBody()->getContents());
        return view('backend.revenueCat.Offerings.edit')->with(compact('items'));
    }

    public function update(Request $request, $offerings)
    {

        $client = new \GuzzleHttp\Client();
        $display=$request->display_name;
        $current=$request->boolean('is_current');
        $body = [
            'is_current'=> $current,
            'display_name'=>$display,
        ];


        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings, [
            'body' => json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        return redirect('/offering');
    }

    public function delete($offerings)
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('DELETE', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer sk_sHIWbHGxYSHfbcSIgUxZqVgyEfjyI',
                'content-type' => 'application/json',
            ],
        ]);

        return redirect('/offering');
    }


}
