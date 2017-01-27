<?php

namespace MyApp\Controllers\Api;

use limx\phalcon\DB;
use MyApp\Controllers\ControllerBase;
use MyApp\Models\RbacRole;
use MyApp\Models\RbacUser;
use MyApp\Models\RbacUserRole;

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
     * @desc 获取角色列表
     * @author limx
     */
    public function pfnUserRoleListAction()
    {
        $id = $this->request->get('uid');
        $roles = RbacRole::getRolesAndStatus($id);
        return self::success($roles);
    }

    /**
     * [pfnSaveUserRole desc]
     * @desc 保存用户的角色
     * @author limx
     */
    public function pfnSaveUserRoleAction()
    {
        $id = $this->request->get('uid');
        $role = $this->request->get('role');
        DB::begin();
        // 删除此人所有的角色
        $res = RbacUserRole::del($id);
        if ($res === false) {
            DB::rollback();
            return self::error("保存失败！");
        }
        $res = RbacUserRole::add($id, $role);
        if ($res === false) {
            DB::rollback();
            return self::error("保存失败！");
        }
        DB::commit();
        return self::success();
    }

}

