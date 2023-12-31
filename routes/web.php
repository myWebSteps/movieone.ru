<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Info Routes:
Route::get('/get_genres', \App\Http\Controllers\Info\GetGenresController::class);
Route::get('/get_categories', \App\Http\Controllers\Info\GetCategoriesController::class);
Route::post('/playlist', \App\Http\Controllers\Front\Single\PlaylistController::class);


Route::get('/', \App\Http\Controllers\Front\Home\IndexController::class)->name('front.index');
Route::get('/movies', \App\Http\Controllers\Front\Catalog\IndexController::class)->name('catalog.index');
Route::get('/movies/{movie}', \App\Http\Controllers\Front\Single\IndexController::class)->name('single.index');
Route::get('/search', \App\Http\Controllers\Front\Search\IndexController::class)->name('search.index');
Route::post('/add_comment', \App\Http\Controllers\Comments\CreateController::class);



Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('/admin')->group(function(){
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
        route::prefix('/comments')->group(function(){
            Route::get('/', \App\Http\Controllers\Back\Admin\Comments\IndexController::class)->name('comments.index');
            Route::get('/{comment}/edit', \App\Http\Controllers\Back\Admin\Comments\EditController::class)->name('comments.edit');
            Route::patch('/{comment}', \App\Http\Controllers\Back\Admin\Comments\UpdateController::class)->name('comments.update');
            Route::delete('/{comment}', \App\Http\Controllers\Back\Admin\Comments\DestroyController::class)->name('comments.destroy');
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
