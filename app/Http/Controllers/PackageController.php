<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function store(Request $request)
    {
        $offerings = $request->offering_id;
        $package = $request->package_id;
        $this->getPackage($package);
        $this->update($package);
        $this->getPackagesWithOfferings($offerings);
        $this->delete($offerings);
        $this->listofPackages($package);
        $this->attach($package);
        $this->detach($package);
    }

    public function getPackagesWithOfferings($offerings)
    {


        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings.'/packages?&limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= $bodyContent->items;
//        dd($items);
        return view('backend.revenueCat.package.index')->with(compact('items'));
    }

    public function create( Request $request)
    {

        $client = new \GuzzleHttp\Client();
        $display=$request->display_name;
        $offerings=$request->offering_id;
        $lookup=$request->lookup_key;
        $position=$request->integer('position');

        $body = [
            'lookup_key'=> $lookup,
            'display_name'=>$display,
            'position'=>$position,
        ];

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings.'/packages', [

            'body'=>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        return redirect()->back();

    }

    public function getPackage($package)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package.'?expand=product', [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);
        $items = json_decode( $response->getBody()->getContents());

//        dd($items);
        return view('backend.revenueCat.package.edit')->with(compact('items'));

    }

    public function update(Request $request, $package)
    {

        $client = new \GuzzleHttp\Client();
        $display=$request->display_name;
        $position=$request->integer('position');
        $body = [
            'display_name'=>$display,
            'position'=>$position
        ];

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package.'?expand=product', [
            'body'=>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        return redirect('/offering');

    }

    public function delete($package)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('DELETE', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package.'?expand=product', [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

       return redirect()->back();
    }

    public function listofPackages($package)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package.'/products?limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        $bodyContent = json_decode( $response->getBody()->getContents());
        $items= array($bodyContent->items[0]->product);

//        dd($items);
        return view('backend.revenueCat.package.list', compact('items'));
    }
    public function attachPackage( Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $package = $request->package_id;
//        dd($package);
        $products = array('product_id'=>$request->product_id, 'eligibility_criteria'=>$request->eligibility_criteria);


        $body =[
            'products'=>array($products),
        ];
//        dd($body);
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package.'/actions/attach_products', [
            'body' =>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
            ]);
        return redirect('/offering');
    }
    public function detachPackage(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $package = $request->package_id;

        $product = $request->product_ids;

        $body =[
            'product_ids'=>array($product),
        ];
        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package.'/actions/detach_products', [
            'body' =>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
            ]);
        return redirect('/offering');
    }
    public function detach($package)
    {

//        require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);
        $items = json_decode( $response->getBody()->getContents());

//        dd($items);
        return view('backend.revenueCat.package.detach')->with(compact('items'));
    }
    public function attach($package)
    {

//        require_once('vendor/autoload.php');

        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/packages/'.$package, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);
        $items = json_decode( $response->getBody()->getContents());

//        dd($items);
        return view('backend.revenueCat.package.attach')->with(compact('items'));
    }
}
