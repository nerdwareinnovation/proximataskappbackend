<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
        $data['package_name'] = $this->name;
        $data['description'] = $this->description;
        $data['no_of_questions'] = $this->number_of_questions;
        $data['price'] = doubleval($this->price);

        return $data;
    }
}
