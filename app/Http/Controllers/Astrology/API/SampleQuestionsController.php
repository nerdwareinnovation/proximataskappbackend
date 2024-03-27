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

}
