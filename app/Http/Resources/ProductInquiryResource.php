<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductInquiryResource extends JsonResource
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
            "id" => $this->id,
            "invoice_number" => $this->invoice_number,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "company_name" => $this->company_name,
            "country" => $this->country,
            "city" => $this->city,
            "sub_distric" => $this->sub_distric,
            "category" => $this->category,
            "product_name" => $this->product_name,
            "quantity" => $this->quantity,
            "note" => $this->note,
            "payment_method" => $this->payment_method,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
