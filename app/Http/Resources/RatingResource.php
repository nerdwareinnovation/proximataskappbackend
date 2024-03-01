<?php

namespace App\Http\Resources;

use App\CustomerRating;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
        $data['chat_id'] = $this->chat_id;
        $data['rating'] = $this->rating;
        $data['customer_id'] = $this->customer_id;

        return $data;
    }
}
