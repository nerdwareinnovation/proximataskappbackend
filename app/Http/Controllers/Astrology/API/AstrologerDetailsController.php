<?php

namespace App\Http\Controllers\Astrology\API;

use App\Models\Astrology\AstrologerDetails;
use App\Http\Controllers\Controller;
use App\Http\Resources\AstrologerDetailsResource;
use Illuminate\Http\Request;

class AstrologerDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $astrologerDetails = AstrologerDetails::get();
        return AstrologerDetailsResource::collection($astrologerDetails);
    }


}
