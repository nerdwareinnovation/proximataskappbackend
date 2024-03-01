<?php

namespace App\Http\Controllers\Astrology\API;


use App\Http\Resources\PackageResource;
use App\Models\Astrology\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerPackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return PackageResource::collection($packages);
    }
}
