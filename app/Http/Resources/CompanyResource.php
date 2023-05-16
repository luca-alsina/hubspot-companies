<?php

namespace App\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Company */
class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'industry'          => $this->industry ? $this->industry : 'Secteur d\'activité non renseigné',
            'city'              => $this->city ? $this->city : 'Ville non renseignée',
            'zip'               => $this->zip,
            'country'           => $this->country ? $this->country : 'Pays non renseigné',
            'website'           => $this->website,
            'phone'             => $this->phone,
            'email'             => $this->email,
            'number_employees'  => $this->number_employees,
            'annual_revenue'    => $this->annual_revenue,
            'contacts'          => $this->whenLoaded('contacts', fn() => ContactResource::collection($this->contacts)),
            'description'       => $this->description,
            'created_at'        => $this->created_at,
        ];
    }
}
