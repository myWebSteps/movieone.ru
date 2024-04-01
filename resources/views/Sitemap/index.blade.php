<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

        <sitemap>
            <loc>{{ '/sitemap/movies' }}</loc>
            <lastmod>{{ $movie->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        </sitemap>
    <sitemap>
        <loc>{{ '/sitemap/collections' }}</loc>
        <lastmod>{{ $collection->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>

</sitemapindex>







