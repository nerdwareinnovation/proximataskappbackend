<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AstrologerDetailsResource extends JsonResource
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
        $data['name'] = $this->name;
        $data['designation'] = $this->designation;
        $data['image_url']= isset($this->image_url)? $this->image_url: null;

        $data['ratings'] =AstrologerRatingResource::collection($this->rating);
        return $data;
    }
}
