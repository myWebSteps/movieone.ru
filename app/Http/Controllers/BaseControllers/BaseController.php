<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\CommentsCollectionDestroyService;
use App\Http\Controllers\Controller;
use App\Services\Back\Cache\CacheService;
use App\Services\Back\IP_info\ip_infoService;
use App\Services\Comments\Collections\CommentsCollectionUpdateService;
use App\Services\Movies\StoreMoviesService;
use App\Services\Movies\UpdateMoviesService;

class BaseController extends Controller
{
    public $cacheService;
    public $ip_infoService;

    public function __construct(CacheService $CacheService,
                                IP_infoService $IP_infoService)
    {
        $this->cacheService = $CacheService;
        $this->ip_infoService = $IP_infoService;
    }


}
