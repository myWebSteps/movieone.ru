<?php

namespace App\Http\Controllers\BaseControllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Front\Movies\FilterService;

class MoviesController extends Controller
{
    public $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

}
