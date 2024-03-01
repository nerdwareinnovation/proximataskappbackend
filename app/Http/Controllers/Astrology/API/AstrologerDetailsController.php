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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AstrologerDetails  $astrologerDetails
     * @return \Illuminate\Http\Response
     */
    public function show(AstrologerDetails $astrologerDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AstrologerDetails  $astrologerDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(AstrologerDetails $astrologerDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AstrologerDetails  $astrologerDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AstrologerDetails $astrologerDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AstrologerDetails  $astrologerDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(AstrologerDetails $astrologerDetails)
    {
        //
    }
}
