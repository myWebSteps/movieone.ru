<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Home\CollectionsResource;
use App\Http\Resources\Front\Home\IndexResource;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class PrivacyPolicyController extends Controller
{
    public function __invoke()
    {
         return Inertia::render('Front/PrivacyPolicy');
    }
}
