<?php

namespace App\Http\Controllers\Back\Admin\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       return Inertia::render('Back/Admin/Main/Index');
    }
}
