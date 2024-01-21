<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Entitlement;
class EntitlementController extends Controller
{
    public function store(Request $request)
    {
        $lookup=$request->lookup_key;
        $display=$request->display_name;
        $entitlementId= $request->entitlement_id;
        $this->createEntitlement($display,$lookup);
        $this->getEntitlement($entitlementId);
    }
    public function createEntitlement($lookup, $display)
    {
//        require_once('vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
//
        $key = env('REVENUE_CAT_SECRET');
        $body = [
            'lookup_key'=> $lookup,
            'display_name'=>$display,
        ];
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements', [

            'body' =>json_encode($body),

            'headers' => [
                'authorization'=>'Bearer sk_sHIWbHGxYSHfbcSIgUxZqVgyEfjyI',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        echo $response->getBody();


    }
    public function getEntitlement($entitlementId)
    {

//        require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer sk_sHIWbHGxYSHfbcSIgUxZqVgyEfjyI',
            ],
        ]);

        echo $response->getBody();
    }
}
