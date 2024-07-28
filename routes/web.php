<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/.well-known/acme-challenge/y2w5jVMe4L8tKFP4ZMbMfp1YwjiPT_93nG2YfAaYEaw', function (){
    return 'y2w5jVMe4L8tKFP4ZMbMfp1YwjiPT_93nG2YfAaYEaw.LssAdB7xfg32i65M9C72ThKkc5xl9VrbfS7rzzgayZ4';
});
Route::get('/.well-known/acme-challenge/-mB8SOu-hxxW90I4b3uS04gD_nMZzsK0OeZ7_ZAe7YI', function (){
    return '-mB8SOu-hxxW90I4b3uS04gD_nMZzsK0OeZ7_ZAe7YI.LssAdB7xfg32i65M9C72ThKkc5xl9VrbfS7rzzgayZ4';
});

//Info Routes:
Route::get('/get_genres', \App\Http\Controllers\Info\GetGenresController::class);
Route::get('/get_categories', \App\Http\Controllers\Info\GetCategoriesController::class);
Route::post('/playlist', \App\Http\Controllers\Front\Movies\PlaylistController::class);
Route::post('/bookmarks', \App\Http\Controllers\Front\Collections\BookmarksController::class);
Route::post('/get_comments_count', \App\Http\Controllers\Info\CommentsCountController::class);

//Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap.index');
//Route::get('/sitemap/movies.xml', [\App\Http\Controllers\SitemapController::class, 'movies'])->name('sitemap.movies');
//Route::get('/sitemap/movies/{slug}.xml', [\App\Http\Controllers\SitemapController::class, 'movie_single'])->name('sitemap.movie_single');
//Route::get('/sitemap/collections.xml', [\App\Http\Controllers\SitemapController::class, 'collections'])->name('sitemap.collections');
//Route::get('/sitemap/collections/{slug}.xml', [\App\Http\Controllers\SitemapController::class, 'collection_single'])->name('sitemap.collection_single');

Route::get('/', \App\Http\Controllers\Front\HomeController::class)->name('front.index');
Route::get('/movies/{movie}', \App\Http\Controllers\Front\Movies\SingleController::class)->name('single.index');
Route::get('/movies', \App\Http\Controllers\Front\Movies\IndexController::class)->name('catalog.index');
Route::get('/random_movies', \App\Http\Controllers\Front\Movies\RandomMoviesController::class)->name('random.index');
Route::get('/search', \App\Http\Controllers\Front\Movies\SearchController::class)->name('search.index');
Route::get('/privacy_policy', \App\Http\Controllers\Front\PrivacyPolicyController::class)->name('privacy_policy.index');
Route::get('/back', \App\Http\Controllers\Front\BackController::class)->name('back');
//Front Comments Routes
Route::post('/movies/add_comment', \App\Http\Controllers\Comments\Movies\CreateController::class);
Route::post('/collections/add_comment', \App\Http\Controllers\Comments\Collections\CreateController::class);

Route::get('/{any}', \App\Http\Controllers\Front\NotFoundController::class)->where('any', '.*');

Route::prefix('/collections')->group(function(){
    Route::get('/', \App\Http\Controllers\Front\Collections\IndexController::class)->name('front.collections.index');
    Route::get('/{collection}', \App\Http\Controllers\Front\Collections\ShowController::class)->name('front.collections.show');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('/admin')->group(function(){

        Route::post('/get_filtered_movies', \App\Http\Controllers\Back\Admin\FilteredMoviesController::class)->name('collections.filtered_movies');


        route::prefix('/categories')->group(function(){
            Route::get('/{category}/edit', \App\Http\Controllers\Back\Admin\Categories\EditController::class)->name('categories.edit');
            Route::get('/create', \App\Http\Controllers\Back\Admin\Categories\CreateController::class)->name('categories.create');
            Route::post('/store', \App\Http\Controllers\Back\Admin\Categories\StoreController::class)->name('categories.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Categories\IndexController::class)->name('categories.index');
            Route::patch('/{category}', \App\Http\Controllers\Back\Admin\Categories\UpdateController::class)->name('categories.update');
            Route::delete('/{category}', \App\Http\Controllers\Back\Admin\Categories\DestroyController::class)->name('categories.destroy');
        });
        route::prefix('/genres')->group(function(){
            Route::get('{genre}/edit', \App\Http\Controllers\Back\Admin\Genres\EditController::class)->name('genres.edit');
            Route::get('{category}/create', \App\Http\Controllers\Back\Admin\Genres\CreateController::class)->name('genres.create');
            Route::post('{category}/store', \App\Http\Controllers\Back\Admin\Genres\StoreController::class)->name('genres.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Genres\IndexController::class)->name('genres.index');
            Route::patch('/{genre}', \App\Http\Controllers\Back\Admin\Genres\UpdateController::class)->name('genres.update');
            Route::delete('/{genre}', \App\Http\Controllers\Back\Admin\Genres\DestroyController::class)->name('genres.destroy');
        });
        route::prefix('/countries')->group(function(){
            Route::get('/{country}/edit', \App\Http\Controllers\Back\Admin\Countries\EditController::class)->name('countries.edit');
            Route::get('/create', \App\Http\Controllers\Back\Admin\Countries\CreateController::class)->name('countries.create');
            Route::post('/store', \App\Http\Controllers\Back\Admin\Countries\StoreController::class)->name('countries.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Countries\IndexController::class)->name('countries.index');
            Route::patch('/{country}', \App\Http\Controllers\Back\Admin\Countries\UpdateController::class)->name('countries.update');
            Route::delete('/{country}', \App\Http\Controllers\Back\Admin\Countries\DestroyController::class)->name('countries.destroy');
        });
        route::prefix('/movies')->group(function(){
            Route::post('/test_in_bd', \App\Http\Controllers\Back\Admin\Movies\TestInBdController::class);

            Route::get('/{movie}/edit', \App\Http\Controllers\Back\Admin\Movies\EditController::class)->name('movies.edit');
            Route::get('/create', \App\Http\Controllers\Back\Admin\Movies\CreateController::class)->name('movies.create');
            Route::post('/store', \App\Http\Controllers\Back\Admin\Movies\StoreController::class)->name('movies.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Movies\IndexController::class)->name('movies.index');
            Route::patch('/{movie}', \App\Http\Controllers\Back\Admin\Movies\UpdateController::class)->name('movies.update');
            Route::delete('/{movie}', \App\Http\Controllers\Back\Admin\Movies\DestroyController::class)->name('movies.destroy');
        });
        route::prefix('/collections')->group(function(){
            Route::get('/{collection}/edit', \App\Http\Controllers\Back\Admin\Collections\EditController::class)->name('collections.edit');
            Route::get('/create', \App\Http\Controllers\Back\Admin\Collections\CreateController::class)->name('collections.create');
            Route::post('/store', \App\Http\Controllers\Back\Admin\Collections\StoreController::class)->name('collections.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Collections\IndexController::class)->name('collections.index');
            Route::patch('/{collection}', \App\Http\Controllers\Back\Admin\Collections\UpdateController::class)->name('collections.update');
            Route::delete('/{collection}', \App\Http\Controllers\Back\Admin\Collections\DestroyController::class)->name('collections.destroy');
        });
        route::prefix('/comments/movies')->group(function(){
            Route::get('/', \App\Http\Controllers\Back\Admin\Comments\Movies\IndexController::class)->name('comments.index');
            Route::get('/{comment}/edit', \App\Http\Controllers\Back\Admin\Comments\Movies\EditController::class)->name('comments.edit');
            Route::patch('/{comment}', \App\Http\Controllers\Back\Admin\Comments\Movies\UpdateController::class)->name('comments.update');
            Route::delete('/{comment}', \App\Http\Controllers\Back\Admin\Comments\Movies\DestroyController::class)->name('comments.destroy');
        });
        route::prefix('/comments/collections')->group(function(){
            Route::get('/', \App\Http\Controllers\Back\Admin\Comments\Collections\IndexController::class)->name('collection.comments.index');
            Route::get('/{comment}/edit', \App\Http\Controllers\Back\Admin\Comments\Collections\EditController::class)->name('collection.comments.edit');
            Route::patch('/{comment}', \App\Http\Controllers\Back\Admin\Comments\Collections\UpdateController::class)->name('collection.comments.update');
            Route::delete('/{comment}', \App\Http\Controllers\Back\Admin\Comments\Collections\DestroyController::class)->name('collection.comments.destroy');
        });
        route::prefix('/titles')->group(function(){
            Route::get('{title}/edit', \App\Http\Controllers\Back\Admin\Titles\EditController::class)->name('titles.edit');
            Route::get('/create', \App\Http\Controllers\Back\Admin\Titles\CreateController::class)->name('titles.create');
            Route::post('/store', \App\Http\Controllers\Back\Admin\Titles\StoreController::class)->name('titles.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Titles\IndexController::class)->name('titles.index');
            Route::patch('/{title}', \App\Http\Controllers\Back\Admin\Titles\UpdateController::class)->name('titles.update');
            Route::delete('/{title}', \App\Http\Controllers\Back\Admin\Titles\DestroyController::class)->name('titles.destroy');
        });


    Route::get('/', \App\Http\Controllers\Back\Admin\Main\IndexController::class)->name('main.index');

    });


    //Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
