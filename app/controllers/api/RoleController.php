<?php

namespace MyApp\Controllers\Api;

use MyApp\Controllers\ControllerBase;
use MyApp\Models\RbacPermission;
use MyApp\Models\RbacRole;

class RoleController extends ControllerBase
{
    /**
     * [pfnRoleListAction desc]
     * @desc 角色列表
     * @author limx
     * @return \limx\phalcon\JsonResponse
     */
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

    /**
     * [pfnRolePermissionListAction desc]
     * @desc 获取角色的权限
     * @author limx
     */
    public function pfnRolePermissionListAction()
    {
        $id = $this->request->get('id');
        $roles = RbacPermission::getPermissionsAndStatus($id);
        return self::success($roles);
    }

    public function pfnSaveAction()
    {
        return self::error("未实现！");
    }

}

