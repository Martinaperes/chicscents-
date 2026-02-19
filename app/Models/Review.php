<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Perfume;

class Review extends Model
{
    protected $fillable = [
        'perfume_id',
        'user_id',
        'reviewer_name',
        'reviewer_email',
        'rating',
        'title',
        'comment',
        'longevity_rating',
        'sillage_rating',
        'value_rating',
        'is_verified_purchase',
        'is_approved',
        'is_featured',
        'helpful_count',
        'not_helpful_count'
    ];

    protected $casts = [
        'rating' => 'integer',
        'longevity_rating' => 'integer',
        'sillage_rating' => 'integer',
        'value_rating' => 'integer',
        'is_verified_purchase' => 'boolean',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'helpful_count' => 'integer',
        'not_helpful_count' => 'integer'
    ];

    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified_purchase', true);
    }
}