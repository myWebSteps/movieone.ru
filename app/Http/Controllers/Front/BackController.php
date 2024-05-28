<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BackController extends Controller
{
    public function __invoke()
    {
         return Redirect::route('front.index');
    }
}
