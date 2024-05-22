<?php

namespace App\Http\Controllers\BaseControllers\Back;


use App\Http\Controllers\BaseControllers\BaseController;
use App\Services\Back\Cache\CacheService;
use App\Services\Back\IP_info\ip_infoService;
use App\Services\Back\Movies\StoreService;
use App\Services\Back\Movies\UpdateService;

class MoviesController extends BaseController
{
    public $storeService;
    public $updateService;
    public function __construct(CacheService $CacheService,
                                ip_infoService $IP_infoService,
                                StoreService $storeService,
                                UpdateService $updateService)
    {
        parent::__construct($CacheService, $IP_infoService);
        $this->storeService = $storeService;
        $this->updateService = $updateService;
    }



}
