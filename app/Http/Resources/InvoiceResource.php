<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'paid' => $this->paid,
            'price' => $this->price,
            'product' => ProductResource::collection(json_decode($this->product, 1)),
            'note' => $this->note,
            'created_at' => $this->created_at
        ];
    }
}
