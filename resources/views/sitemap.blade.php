<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($staticPages as $page)
    <url>
        <loc>{{ $page['loc'] }}</loc>
        <priority>{{ $page['priority'] }}</priority>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
    </url>
    @endforeach
    @foreach ($products as $product)
    <url>
        <loc>{{ route('products.show', $product->slug) }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
        @if ($product->updated_at)
        <lastmod>{{ $product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
    </url>
    @endforeach
    @foreach ($brands as $brand)
    <url>
        <loc>{{ route('brands.show', $brand->slug) }}</loc>
        <priority>0.7</priority>
        <changefreq>weekly</changefreq>
        @if ($brand->updated_at)
        <lastmod>{{ $brand->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
    </url>
    @endforeach
</urlset>
