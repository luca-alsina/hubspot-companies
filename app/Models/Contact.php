<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'country',
        'zip',
        'job_title',
        'created_at',
        'updated_at',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
