<?php

namespace App\Http\Controllers\Astrology\API;

use App\Http\Resources\SampleQuestionsResource;
use App\Models\Astrology\SampleQuestions;
use App\Models\Astrology\SampleQuestionsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SampleQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sample_questions = SampleQuestionsCategory::get();
        return SampleQuestionsResource::collection($sample_questions);
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
     * @param  \App\SampleQuestions  $sampleQuestions
     * @return \Illuminate\Http\Response
     */
    public function show(SampleQuestions $sampleQuestions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SampleQuestions  $sampleQuestions
     * @return \Illuminate\Http\Response
     */
    public function edit(SampleQuestions $sampleQuestions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SampleQuestions  $sampleQuestions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SampleQuestions $sampleQuestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SampleQuestions  $sampleQuestions
     * @return \Illuminate\Http\Response
     */
    public function destroy(SampleQuestions $sampleQuestions)
    {
        //
    }
}
