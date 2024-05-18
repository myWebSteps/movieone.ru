<?php

namespace App\Http\Controllers\Back\Admin\Countries;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {

       return Inertia::render('Back/Admin/Countries/Create');
    }
}
