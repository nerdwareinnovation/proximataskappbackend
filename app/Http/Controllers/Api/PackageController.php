<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function store(Request $request)
    {
        $entitlement = $request->entitlement_id;
        $lookup=$request->lookup_key;
        $display=$request->display_name;
        $offerings = $request->offering_id;
        $current = $request->is_current;
        $position= $request->position;
        $package = $request->package_id;
        $this->getPackage($package);
        $this->update($display, $position, $package);
        $this->getPackagesWithOfferings($offerings, $entitlement);
        $this->delete($offerings);
        $this->listofPackages($package);
        $this->create($lookup, $display,$offerings,$position);
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

        echo $response->getBody();
    }

    public function create($lookup , $display, $offerings, $position)
    {

        $client = new \GuzzleHttp\Client();

        $body = [
            'lookup_key'=> $lookup,
            'display_name'=>$display,
            'position'=>$position
        ];

        $response = $client->request('POST', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings.'/packages', [

            'body'=>json_encode($body),
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
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

        echo $response->getBody();
    }

    public function update($display, $position, $package)
    {

        $client = new \GuzzleHttp\Client();

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

        echo $response->getBody();
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

        echo $response->getBody();
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

        echo $response->getBody();
    }
}