<?php

namespace App\Http\Controllers\Back\Admin\Main;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
       return Inertia::render('Back/Admin/Main/Index');
    }
}
