<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'rate' => $this->rate,
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'company_name' => $this->company->name,
            'payed' => $this->payed,
            'created_at' => $this->created_at,
        ];
    }
}
