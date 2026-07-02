<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'industry',
        'category',
        'location',
        'service_areas',
        'description',
        'services',
        'tags',
        'phone',
        'email',
        'rating',
        'jobs_completed',
        'response_time',
        'logo_url',
        'cover_url',
    ];

    protected $casts = [
        'service_areas' => 'array',
        'services' => 'array',
        'tags' => 'array',
        'rating' => 'float',
        'jobs_completed' => 'integer',
    ];
}
