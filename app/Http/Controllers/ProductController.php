<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = $request->product_id;
        $this->get($product);
        $this->delete($product);
    }
    public function get($product)
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/products/'.$product, [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= $bodyContent;
        return view('backend.revenueCat.products.get')->with(compact('items'));
    }
    public function create(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $app= $request->app_id;
        $display=$request->display_name;
        $store = $request->store_identifier;
        $type = $request->type;

        $body = [
            'store_identifier'=> $store,
            'display_name'=>$display,
            'type'=>$type,
            'app_id'=>$app,
        ];
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/products', [
            'body' =>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        return redirect('/product');
    }
    public function delete($product)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('DELETE', 'https://api.revenuecat.com/v2/projects/d5f483c5/products/'.$product, [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

       return redirect('/entitlement');
    }

    public function getList()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/products?limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= $bodyContent->items;
//        dd($items);
        return view('backend.revenueCat.products.index')->with(compact('items'));

    }
}
