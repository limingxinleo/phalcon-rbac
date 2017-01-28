<?php

namespace MyApp\Controllers\Api;

use MyApp\Controllers\ControllerBase;
use MyApp\Models\RbacPermission;

class PermissionController extends ControllerBase
{

    /**
     * [pfnPermissionListAction desc]
     * @desc 获取权限列表
     * @author limx
     * @return \limx\phalcon\JsonResponse
     */
    public function pfnPermissionListAction()
    {
        $pageIndex = $this->request->get('pageIndex');
        $pageSize = $this->request->get('pageSize');

        $user = RbacPermission::find([
            'offset' => $pageIndex * $pageSize,
            'limit' => $pageSize
        ]);
        $data['data'] = $user;
        $data['count'] = RbacPermission::count();
        return self::success($data);
    }

}

