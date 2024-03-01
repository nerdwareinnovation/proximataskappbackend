<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SampleQuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['category_name'] = $this->category_name ;
        $data['created_at'] = $this->created_at;
        $data['questions'] = QuestionResource::collection($this->questions);
        return $data;

    }
}
