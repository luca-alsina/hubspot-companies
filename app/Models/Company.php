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
        'numberofemployees',
        'annualrevenue',
        'website',
        'city',
        'country',
        'zip',
        'created_at',
        'updated_at',
    ];

}
