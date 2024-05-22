<?php

namespace App\Http\Controllers\BaseControllers\Back;


use App\Http\Controllers\BaseControllers\BaseController;
use App\Services\Back\Cache\CacheService;
use App\Services\Back\Collections\DestroyService;
use App\Services\Back\Collections\StoreService;
use App\Services\Back\Collections\UpdateService;
use App\Services\Back\IP_info\ip_infoService;

class CollectionsController extends BaseController
{
    public $storeService;
    public $updateService;
    public $destroyService;
    public function __construct(CacheService $CacheService,
                                ip_infoService $IP_infoService,
                                StoreService $storeService,
                                UpdateService $updateService,
                                DestroyService $destroyService)
    {
        parent::__construct($CacheService, $IP_infoService);
        $this->storeService = $storeService;
        $this->updateService = $updateService;
        $this->destroyService = $destroyService;
    }



}
