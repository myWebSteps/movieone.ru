<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       $countries = Country::all();

       return Inertia::render('Back/Admin/Countries/Index', compact('countries'));
    }
}
