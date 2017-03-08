<?php

namespace MyApp\Controllers\Api;

use MyApp\Controllers\ControllerBase;

class IndexController extends ControllerBase
{

    public function clearCacheAction()
    {
        $cache = di('cache');
        $data = $cache->queryKeys('CACHE-');
        foreach ($data as $item) {
            $cache->delete($item);
        }
        return self::success();
    }

}

