<?php

namespace App\DTOs;

use App\Models\Product;

class ProductDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly ?string $description,
        public readonly float $price,
        public readonly ?float $compareAtPrice,
        public readonly ?int $discountPercent,
        public readonly string $status,
        public readonly int $inventory,
        public readonly string $vehicleType,
        public readonly ?string $brandName,
        public readonly ?string $brandSlug,
        public readonly ?string $mainImage,
        public readonly array $images,
        public readonly array $specifications,
        public readonly array $highlights,
        public readonly ?string $warrantyInfo,
        public readonly ?string $manualPdf,
        public readonly ?string $videoUrl,
        public readonly float $rating,
        public readonly int $reviewCount,
    ) {}

    public static function fromModel(Product $product): self
    {
        return new self(
            title: $product->title,
            slug: $product->slug,
            description: $product->description,
            price: (float) $product->price,
            compareAtPrice: $product->compare_at_price ? (float) $product->compare_at_price : null,
            discountPercent: $product->calculateDiscount(),
            status: $product->status,
            inventory: $product->inventory,
            vehicleType: $product->vehicle_type ?? 'motorcycle',
            brandName: $product->brand?->name,
            brandSlug: $product->brand?->slug,
            mainImage: $product->images->first()?->image_url,
            images: $product->images->pluck('image_url')->toArray(),
            specifications: $product->specifications->groupBy('group')->toArray(),
            highlights: $product->highlights ?? [],
            warrantyInfo: $product->warranty_info,
            manualPdf: $product->manual_pdf,
            videoUrl: $product->video_url,
            rating: 4.5,
            reviewCount: $product->reviews->count(),
        );
    }
}
