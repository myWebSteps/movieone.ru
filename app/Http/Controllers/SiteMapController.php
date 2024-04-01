<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SiteMapController extends Controller
{
   public function __invoke()
   {
       SitemapGenerator::create('https://www.movieone.ru')->getSitemap()->writeToDisk('public', 'sitemap.xml');
//       SitemapGenerator::create('https://www.movieone.ru')->writeToFile(public_path('/sitemap.xml'));
   }
}
