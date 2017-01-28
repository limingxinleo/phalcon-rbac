<?php

namespace MyApp\Controllers\Api;

use MyApp\Controllers\ControllerBase;
use MyApp\Models\RbacRole;

class RoleController extends ControllerBase
{

    public function pfnRoleListAction()
    {
        $pageIndex = $this->request->get('pageIndex');
        $pageSize = $this->request->get('pageSize');
        $user = RbacRole::find([
            'offset' => $pageIndex * $pageSize,
            'limit' => $pageSize
        ]);
        $data['data'] = $user;
        $data['count'] = RbacRole::count();
        return self::success($data);
    }

}

