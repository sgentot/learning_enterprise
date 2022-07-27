<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CmEnterpriseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      return [
        'enterprise' => $this->enterprise,
        'description ' => $this->description,
        'contact ' => $this->contact,
        'estate ' => $this->estate,
        'elanguage ' => $this->elanguage,
        'country ' => $this->country,
        'currency ' => $this->currency
      ];
    }
}
