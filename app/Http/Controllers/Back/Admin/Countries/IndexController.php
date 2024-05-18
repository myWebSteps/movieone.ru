<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $countries = Country::all();

       return Inertia::render('Back/Admin/Countries/Index', compact('countries'));
    }
}
