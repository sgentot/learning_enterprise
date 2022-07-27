<?php

namespace App\Http\Resources;

use App\Models\CmCustomer;
use App\Models\CmOrder;
use Illuminate\Http\Resources\Json\JsonResource;

 
class CmOrdersResource extends JsonResource
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
        'idcustomer' => new CmCustomerResource(CmCustomer::find($this->idcustomer)),
        'order' => $this->order,
        'ordertype' => $this->ordertype,
        'description' => $this->description,
        'units' => $this->units,
        'totalprice' => $this->totalprice,
        'taxes' => $this->taxes,
        'address' => $this->address,
      ];
    }
}