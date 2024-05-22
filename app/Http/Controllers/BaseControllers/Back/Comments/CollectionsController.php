<?php

namespace App\Http\Controllers\BaseControllers\Back\Comments;

use App\Http\Controllers\BaseControllers\BaseController;
use App\Services\Back\Cache\CacheService;
use App\Services\Back\Comments\Collections\DestroyService;
use App\Services\Back\Comments\Collections\UpdateService;
use App\Services\Back\IP_info\ip_infoService;


class CollectionsController extends BaseController
{
    public $destroyService;
    public $updateService;

    public function __construct(CacheService   $CacheService,
                                ip_infoService $IP_infoService,
                                DestroyService $destroyService,
                                UpdateService  $updateService)
    {
        parent::__construct($CacheService, $IP_infoService);
        $this->destroyService = $destroyService;
        $this->updateService = $updateService;
    }
}

