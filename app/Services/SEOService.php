<?php

namespace App\Services;

use App\Models\Product;

class SEOService
{
    public function getOrganizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'MotoPlus',
            'url' => config('app.url'),
            'logo' => asset('images/logo.png'),
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+213-XXX-XXX-XXX',
                'contactType' => 'customer service',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'DZ',
            ],
        ];
    }

    public function getProductSchema(Product $product): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->title,
            'description' => strip_tags($product->description ?? ''),
            'sku' => $product->sku ?? $product->id,
            'url' => route('products.show', $product->slug),
            'image' => $product->images->first()?->image_url 
                ? asset('storage/' . $product->images->first()->image_url) 
                : asset('images/placeholder.png'),
            'offers' => [
                '@type' => 'Offer',
                'price' => $product->price,
                'priceCurrency' => 'DZD',
                'availability' => $product->inventory > 0 
                    ? 'https://schema.org/InStock' 
                    : 'https://schema.org/OutOfStock',
            ],
        ];

        if ($product->brand) {
            $schema['brand'] = [
                '@type' => 'Brand',
                'name' => $product->brand->name,
            ];
        }

        if ($product->reviews->count() > 0) {
            $schema['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.5',
                'reviewCount' => $product->reviews->count(),
            ];
        }

        return $schema;
    }

    public function getBreadcrumbs(array $items): array
    {
        $itemListElement = [];
        $position = 1;

        foreach ($items as $item) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $item['name'],
                'item' => $item['url'] ?? null,
            ];
            $position++;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement,
        ];
    }

    public function metaTags(string $title, string $description, ?string $image = null, ?string $url = null): array
    {
        $url = $url ?? config('app.url');

        return [
            'title' => $title,
            'description' => $description,
            'og:title' => $title,
            'og:description' => $description,
            'og:url' => $url,
            'og:type' => 'website',
            'og:site_name' => 'MotoPlus',
            'og:image' => $image ?? asset('images/og-default.jpg'),
            'twitter:card' => 'summary_large_image',
            'twitter:title' => $title,
            'twitter:description' => $description,
            'twitter:image' => $image ?? asset('images/og-default.jpg'),
        ];
    }
}
