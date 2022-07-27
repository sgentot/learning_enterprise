<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

 
class CmCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'customer' => $this->customer,
        'customerstate' => $this->customerstate,
        'contact' => $this->contact,
        'sale' => $this->sale,
        'identerprise' => $this->identerprise,
        'paymentmethod' => $this->paymentmethod,
        'elanguage' => $this->elanguage,
        'currency' => $this->currency,
        'country' => $this->country,
        'address' => $this->address,
      ];
    }
}