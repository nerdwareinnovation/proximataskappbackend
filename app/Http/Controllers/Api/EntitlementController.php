<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EntitlementController extends Controller
{

    public function store(Request $request)
    {
        $lookup=$request->lookup_key;
        $display=$request->display_name;
        $productId=$request->product_id;
        $entitlementId= $request->entitlement_id;
        $this->createEntitlement($display,$lookup);
        $this->getEntitlement($entitlementId);
        $this->update($entitlementId, $display);
        $this->attachProducts($entitlementId, $productId);
        $this->detachProducts($entitlementId, $productId);
        $this->listProducts($entitlementId, $productId);
        $this->delete($entitlementId);
    }
    public function createEntitlement($lookup, $display)
    {

        $client = new \GuzzleHttp\Client();
//
//        dd($key);
        $body = [
            'lookup_key'=> $lookup,
            'display_name'=>$display,
        ];
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements', [

            'body' =>json_encode($body),

            'headers' => [
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),

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
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        echo $response->getBody();
    }
    public function listEntitlement()
    {
        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements?limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
    }
    public function update($entitlementId, $display)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId, [

            'body'=>json_encode($display),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
    }

    public function delete($entitlementId)
    {

//        require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();

        $response = $client->request('DELETE', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        echo $response->getBody();
    }
    public function attachProducts($entitlementId, $productId)
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId.'/actions/attach_products', [
            'body' => json_encode($productId),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
    }

    public function detachProducts($entitlementId, $productId)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId.'/actions/detach_products', [
            'body' => json_encode($productId),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        echo $response->getBody();
    }
    public function listProducts($entitlementId, $productId)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId.'products/?starting_after=ent12354&limit=20', [
            'body' => json_encode($productId),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        echo $response->getBody();
    }

}
