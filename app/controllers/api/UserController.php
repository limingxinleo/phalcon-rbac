<?php

namespace MyApp\Controllers\Api;

use MyApp\Controllers\ControllerBase;
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
        $user = RbacUser::find();
        return self::success($user);
    }
    
}

