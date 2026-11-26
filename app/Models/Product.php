<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'sku',
        'title',
        'slug',
        'description',
        'vehicle_type',
        'condition',
        'model_year',
        'price',
        'compare_at_price',
        'status',
        'inventory',
        'category',
        'image_url',
        'tags',
        'video_url',
        'manual_pdf',
        'warranty_info',
        'highlights',
        'colors',
        'is_featured',
        'meta_title',
        'meta_description',
        'og_image',
    ];

    protected $casts = [
        'tags' => 'array',
        'highlights' => 'array',
        'colors' => 'array',
        'is_featured' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class);
    }

    public function calculateDiscount(): ?int
    {
        if (!$this->compare_at_price || $this->compare_at_price <= $this->price) {
            return null;
        }

        return round((($this->compare_at_price - $this->price) / $this->compare_at_price) * 100);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
            ->where('status', true)
            ->latest();
    }

    public function scopeDiscounted($query)
    {
        return $query->whereNotNull('compare_at_price')
            ->whereColumn('compare_at_price', '>', 'price')
            ->where('status', true)
            ->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByVehicleType($query, string $type)
    {
        return $query->where('vehicle_type', $type)->active();
    }

    public function scopeInStock($query)
    {
        return $query->where('inventory', '>', 0);
    }
}
