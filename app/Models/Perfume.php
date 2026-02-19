<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Review;

class Perfume extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'discount_price',
        'discount_ends_at',
        'type',
        'concentration',
        'volume',
        'sku',
        'brand_id',
        'notes',
        'top_notes',
        'heart_notes',
        'base_notes',
        'gender',
        'season',
        'occasion',
        'longevity',
        'sillage',
        'stock_quantity',
        'sold_count',
        'is_active',
        'is_featured',
        'is_new',
        'is_bestseller',
        'featured_image',
        'gallery_images',
        'video_url',
        'average_rating',
        'review_count',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'discount_ends_at' => 'datetime',
        'gallery_images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_bestseller' => 'boolean',
        'average_rating' => 'decimal:2',
        'stock_quantity' => 'integer',
        'sold_count' => 'integer',
        'volume' => 'integer',
        'decant_price' => 'decimal:2',
    'price' => 'decimal:2',
    'is_on_sale' => 'boolean',
    'price' => 'float',
    'decant_price' => 'float',
    'is_active' => 'boolean',
    'is_on_sale' => 'boolean',
    ];
   

// Accessor for decant price (if not stored in DB)
public function getDecantPriceAttribute($value)
{
    if ($value) {
        return $value;
    }
    // Default decant price (30% of full bottle price)
    return $this->price * 0.3;
}

    // Relationships
    public function brand()
{
    return $this->belongsTo(Brand::class);
}



    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeBestseller($query)
    {
        return $query->where('is_bestseller', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getFormattedPriceAttribute(): string
    {
        return 'Kshs' . number_format($this->price, 2);
    }

    public function getFormattedDiscountPriceAttribute(): ?string
    {
        return $this->discount_price ? 'Kshs' . number_format($this->discount_price, 2) : null;
    }

    public function getCurrentPriceAttribute()
    {
        if ($this->discount_price && $this->discount_ends_at?->isFuture()) {
            return $this->discount_price;
        }
        return $this->price;
    }

    public function getFormattedCurrentPriceAttribute(): string
    {
        return 'Kshs' . number_format($this->current_price, 2);
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->discount_price && $this->price > 0) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return null;
    }

    public function getNotesArrayAttribute(): array
    {
        return $this->notes ? explode(',', $this->notes) : [];
    }

    public function getIsOnSaleAttribute(): bool
    {
        return $this->discount_price && 
               $this->discount_ends_at && 
               $this->discount_ends_at->isFuture();
    }
    
}