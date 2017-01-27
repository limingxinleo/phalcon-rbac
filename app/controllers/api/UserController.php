<?php

namespace MyApp\Controllers\Api;

use MyApp\Controllers\ControllerBase;
use MyApp\Models\RbacRole;
use MyApp\Models\RbacUser;

class UserController extends ControllerBase
{
    /**
     * [pfnUserListAction desc]
     * @desc 获取用户列表
     * @author limx
     */
    public function pfnUserListAction()
    {
        $pageIndex = $this->request->get('pageIndex');
        $pageSize = $this->request->get('pageSize');
        $user = RbacUser::find([
            'offset' => $pageIndex * $pageSize,
            'limit' => $pageSize
        ]);
        $data['data'] = $user;
        $data['count'] = RbacUser::count();
        return self::success($data);
    }

    /**
     * [pfnUserRoleListAction desc]
     * @desc 获取用户的角色列表
     * @author limx
     */
    public function pfnUserRoleListAction()
    {
        $id = $this->request->get('uid');
        $roles = RbacRole::getRolesByUserId($id);
        return self::success($roles);
    }

}

