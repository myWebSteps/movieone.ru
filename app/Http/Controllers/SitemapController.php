<?php
namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Movie;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $movies_link = [
            url('/'),
        ];
        $collections_link = [
            url('/'),
        ];

        $movies = Movie::all();
        $collections= Collection::all();

        foreach ($movies as $movie) {
            $movies_link[] = url('movies/' . $movie->slug);
        }
        foreach ($collections as $collection) {
            $collections_link[] = url('collections/' . $collection->slug);
        }

        $urls = array_merge($movies_link,$collections_link);

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap-image/v1">';

        foreach ($urls as $url) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . htmlspecialchars($url) . '</loc>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>0.5</priority>';
            $sitemap .= '</url>';
         }

        $sitemap .= '</urlset>';

        return response($sitemap, 200, ['Content-Type' => 'application/xml']);
    }
}

/*
namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Movie;

class SitemapController extends Controller
{

    public function index()
    {
        $movie = Movie::orderBy('updated_at', 'desc')->first();
        $collection = Collection::orderBy('updated_at', 'desc')->first();

        return response()->view('Sitemap.index', [
            'movie' => $movie,
            'collection' => $collection
        ])->header('Content-Type', 'text/xml');
    }

    public function movies()
    {
        $movies = Movie::orderBy('updated_at', 'desc')->get();

        return response()->view('Sitemap.movies', [
            'movies' => $movies,
        ])->header('Content-Type', 'text/xml');
    }

    public function movie_single($slug)
    {
        $movies = Movie::where('slug', 'LIKE', "$slug%")->get();

        return response()->view('Sitemap.movies_show', [
            'movies' => $movies,
        ])->header('Content-Type', 'text/xml');
    }

    public function collections()
    {
        $collections= Collection::orderBy('updated_at', 'desc')->get();

        return response()->view('Sitemap.collections', [
            'collections' => $collections,
        ])->header('Content-Type', 'text/xml');
    }
    public function collection_single($slug)
    {
        $collections = Collection::where('slug', 'LIKE', "$slug%")->get();

        return response()->view('Sitemap.collections_show', [
            'collections' => $collections,
        ])->header('Content-Type', 'text/xml');
    }
}
*/
