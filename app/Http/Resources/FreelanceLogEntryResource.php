<?php

namespace App\Http\Resources;

use App\Enums\ProductType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelanceLogEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product->name,
            'product_type' => $this->product->type->name,
            'rate' => $this->rate,
            'hours' => $this->hours,
            'company_name' => $this->product->company->name,
        ];
    }
}
