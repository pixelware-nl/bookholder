<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'from_company' => $this->fromCompany->name,
            'to_company' => $this->toCompany->name,
            'start_date' => $this->start_date->format('Y-m-d'),
            'end_date' => $this->end_date->format('Y-m-d'),
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'payed' => $this->payed
        ];
    }
}
