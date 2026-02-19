<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Perfume;
class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'order',
        'is_active'
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    public function perfumes(): BelongsToMany
    {
        return $this->belongsToMany(Perfume::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}