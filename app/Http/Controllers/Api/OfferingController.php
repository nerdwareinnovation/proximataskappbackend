<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferingController extends Controller
{
    //
    public function store(Request $request)
    {
        $entitlement = $request->entitlement_id;
        $lookup=$request->lookup_key;
        $display=$request->display_name;
        $offerings = $request->offering_id;
        $current = $request->is_current;
        $this->update($display, $current);
        $this->getOfferings($offerings);
        $this->delete($offerings);
        $this->listOffering($entitlement);
        $this->createOffering($lookup, $display);
    }

    public function createOffering($lookup, $display)
    {

        $client = new \GuzzleHttp\Client();

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

        echo $response->getBody();
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

        echo $response->getBody();
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

        echo $response->getBody();
    }

    public function update($display, $current)
    {

        $client = new \GuzzleHttp\Client();
        $body = [
            'is_current'=> $current,
            'display_name'=>$display,
        ];

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/ofrng4d470e035a', [
            'body' => json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
    }

    public function delete($offerings)
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('DELETE', 'https://api.revenuecat.com/v2/projects/proj1ab2c3d4/offerings/'.$offerings, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer sk_sHIWbHGxYSHfbcSIgUxZqVgyEfjyI',
            ],
        ]);

        echo $response->getBody();
    }


}
