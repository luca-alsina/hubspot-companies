<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'id',
        'name',
        'description',
        'phone',
        'industry',
        'number_employees',
        'annual_revenue',
        'website',
        'city',
        'country',
        'zip',
        'created_at',
        'updated_at',
    ];

    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Contact::class);
    }

}
