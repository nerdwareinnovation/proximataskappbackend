<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDetailsResource extends JsonResource
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
        $data['gender'] = $this->gender;
        $data['country_of_birth'] = $this->country_of_birth;
        $data['state_of_birth'] = $this->state_of_birth;
         $data['city_of_birth'] = $this->city_of_birth;
        $data['kundali'] = $this->kundali;
        $data['vedic_sign'] = $this->vedic_sign;
        $data['date_of_birth'] = $this->date_of_birth;
        $data['time_of_birth'] = $this->time_of_birth;
        $data['is_time_accurate'] = $this->is_time_accurate;

        return $data;
    }
}
