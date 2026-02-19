<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'website',
        'country',
        'founded_year',
        'is_active'
    ];

    protected $casts = [
        'founded_year' => 'integer',
        'is_active' => 'boolean'
    ];

    public function perfumes(): HasMany
    {
        return $this->hasMany(Perfume::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}