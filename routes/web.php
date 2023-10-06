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
            Route::get('{genre}/{category}/edit', \App\Http\Controllers\Back\Admin\Genres\EditController::class)->name('genres.edit');
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

//            Route::get('/{category}/edit', \App\Http\Controllers\Back\Admin\Categories\EditController::class)->name('categories.edit');
            Route::get('/create', \App\Http\Controllers\Back\Admin\Movies\CreateController::class)->name('movies.create');
            Route::post('/store', \App\Http\Controllers\Back\Admin\Movies\StoreController::class)->name('movies.store');
            Route::get('/', \App\Http\Controllers\Back\Admin\Movies\IndexController::class)->name('movies.index');
//            Route::patch('/{category}', \App\Http\Controllers\Back\Admin\Categories\UpdateController::class)->name('categories.update');
            Route::delete('/{movie}', \App\Http\Controllers\Back\Admin\Movies\DestroyController::class)->name('movies.destroy');
        });


    Route::get('/', \App\Http\Controllers\Back\Admin\Main\IndexController::class)->name('main.index');

    });

    //Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
