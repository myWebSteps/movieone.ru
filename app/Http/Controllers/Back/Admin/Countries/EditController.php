<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Country $country)
    {
       return Inertia::render('Back/Admin/Countries/Edit', compact('country'));
    }
}
