<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data['id']= $this->id;
        $data['name']= $this->name;
        $data['email']= $this->email;
        $data['email_verified']= !($this->email_verified_at == null);
       // isset($this->picture)? $this->picture->full_path : null

        $data['astro_name']= isset($this->moderatorDetails->astro_name) ? $this->moderatorDetails->astro_name : null;
        if(isset($this->details->imageUrl)){
            $data['image_url']=$this->details->imageUrl;
        }
        else if(isset($this->moderatorDetails->image_url)){
          $data['image_url']=$this->moderatorDetails->image_url;
        }
        else{
            $data['image_url']=null;
        }

        $data['details']=new CustomerDetailsResource($this->details);
        $data['customer_package']=new CustomerPackageResource($this->customerPackage);
        return $data;
    }
}
