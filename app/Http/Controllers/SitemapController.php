<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Movie;
use Illuminate\Http\Request;

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

        return response()->view('Sitemap.movies.show', [
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
        $collections = Movie::where('slug', 'LIKE', "$slug%")->get();

        return response()->view('Sitemap.collections.show', [
            'collections' => $collections,
        ])->header('Content-Type', 'text/xml');
    }



}
