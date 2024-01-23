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
        $this->update($display, $current);
        $this->getPackageswithOfferings($offerings, $entitlement);
        $this->delete($offerings);
        $this->listOffering($entitlement);
        $this->create($lookup, $display,$offerings,$position);
    }

    public function getPackageswithOfferings($offerings,$entitlement)
    {


        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.revenuecat.com/v2/projects/d5f483c5/offerings/'.$offerings.'/packages?starting_after='.$entitlement.'&limit=20', [
            'headers' => [
                'accept' => 'application/json',
                'authorization'=>'Bearer '.env('REVENUE_CAT_SECRET'),
            ],
        ]);

        echo $response->getBody();
    }

    public function create($lookup , $display, $offerings, $position)
    {

        require_once('vendor/autoload.php');

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
}
