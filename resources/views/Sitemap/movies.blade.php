<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($movies as $movie)
        <sitemap>
            <loc>{{route('sitemap.movie_single', $movie->slug)}}</loc>
        </sitemap>
    @endforeach
</sitemapindex>
