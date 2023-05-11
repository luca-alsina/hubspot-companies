<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Company */
class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'industry' => $this->industry,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => $this->country,
            'website' => $this->website,
            'phone' => $this->phone,
            'number_employees' => $this->number_employees,
            'annual_revenue' => $this->annual_revenue,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
