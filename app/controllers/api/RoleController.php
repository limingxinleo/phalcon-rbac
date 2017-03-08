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

    public function pfnSaveAction($role_id = 0)
    {
        $name = $this->request->get('role');
        $desc = $this->request->get('desc');
        $permission = $this->request->get('permission');
        if (is_numeric($role_id) && $role_id > 0) {
            $role = RbacRole::findFirst($role_id);
            if (empty($role)) {
                return self::error("角色不存在！");
            }
        } else {
            $role = new RbacRole();
        }
        $role->name = $name;
        $role->desc = $desc;
        if ($role->save() === false) {
            return self::error("角色保存失败！");
        }
        $role_id = $role->id;
        if (count($permission) > 0) {
            $res = RbacPermission::addByRoleId($role_id, $permission);
            if ($res === false) {
                return self::error("权限保存失败！");
            }
        }
        // 清除缓存

        return self::success([$role->id]);
    }

}

