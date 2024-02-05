<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntitlementController extends Controller
{

    public function store(Request $request)
    {
        $productId=$request->product_ids;
        $entitlementId= $request->entitlement_id;
        $this->getEntitlement($entitlementId);
        $this->getProducts($entitlementId);
        $this->update($entitlementId);
        $this->listProducts($entitlementId);
        $this->delete($entitlementId);
        return redirect()->back();
    }
    public function createEntitlement(Request $request)
    {

        $client = new \GuzzleHttp\Client();
//
//        dd($key);
        $lookup= $request->lookup_key;
        $display=$request->display_name;
        $body = [
            'lookup_key'=> $lookup,
            'display_name'=>$display,
        ];
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements', [

            'body' =>json_encode($body),

            'headers' => [
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),

//        'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $bodyContent = json_decode( $response->getBody()->getContents());
//        dd($items);
        return redirect('/entitlement');


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
        $items = json_decode( $response->getBody()->getContents());

//        dd($items);
        return view('backend.revenueCat.entitlement.edit')->with(compact('items'));
    }
    public function listEntitlement()
    {


        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements?limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'authorization' =>'Bearer '.env('REVENUE_CAT_SECRET'),
//                'content-type' => 'application/json',
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= $bodyContent->items;
//        dd($items);
        return view('backend.revenueCat.entitlement.index')->with(compact('items'));
    }
    public function update($entitlementId, Request $request )
    {
        $client = new \GuzzleHttp\Client();
        $display = $request->display_name;
        $body = [
            'display_name'=>$display,
        ];

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId, [

            'body'=>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

//        $bodyContent = json_decode( $response->getBody()->getContents());
        return redirect('/entitlement');
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

        return redirect('/entitlement');
    }
    public function getProducts($entitlementId)
    {

//        require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);
        $items = json_decode( $response->getBody()->getContents());

//        dd($items);
        return view('backend.revenueCat.entitlement.attach')->with(compact('items'));
    }
    public function attachProducts(Request $request)
    {

        $client = new \GuzzleHttp\Client();
        $productId = $request -> product_ids;
        $entitlementId = $request->entitlement_id;
        $body =[
            'product_ids'=>array($productId),
        ];
//        dd(json_encode($body));

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId.'/actions/attach_products', [
            'body' => json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);
//        $bodyContent = json_decode( $response->getBody()->getContents());
//        $items= $bodyContent->items;
//        dd($items);
        return redirect()->route('entitlement');
    }

    public function detachProducts( Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $entitlementId = $request->entitlement_id;
        $productId = $request -> product_ids;
        $body =[
        'product_ids'=>array($productId),
    ];
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId.'/actions/detach_products', [
            'body' => json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        return redirect()->route('entitlement');
    }
    public function detach($entitlementId)
    {

//        require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);
        $items = json_decode( $response->getBody()->getContents());

//        dd($items);
        return view('backend.revenueCat.entitlement.detach')->with(compact('items'));
    }
    public function listProducts($entitlementId)
    {
        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/entitlements/'.$entitlementId.'/products?limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= $bodyContent->items;
        return view('backend.revenueCat.entitlement.listProducts',compact('items'));
    }

}
