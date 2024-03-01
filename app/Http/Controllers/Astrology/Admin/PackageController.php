<?php

namespace App\Http\Controllers\Astrologer\Admin;

use App\Models\Astrology\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::all();
        return view('admin.packageList')->with(compact('packages'));
    }

    public function storePackage(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'no_of_question' => 'required',
            'price' => 'required',
        ]);
        $package = new Package();
        $package->name = $request['name'];
        $package->description = $request['description'];
        $package->number_of_questions = $request['no_of_question'];
        $package->price = $request['price'];
        $package->save();
        return $this->index();
    }
}
