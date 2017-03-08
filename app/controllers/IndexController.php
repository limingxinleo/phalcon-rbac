<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/11/8 Time: 11:18
// +----------------------------------------------------------------------
namespace MyApp\Controllers;

use MyApp\Models\RbacRole;
use MyApp\Models\RbacUser;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        return $this->view->render('index', 'index');
    }

    public function userInfoAction($id)
    {
        $user = self::getUserById($id);
        $roles = RbacRole::getRolesByUserId($id);
        $this->view->id = $id;
        $this->view->name = $user->name;
        $this->view->roles = $roles;
        return $this->view->render('index', 'user');
    }

    public function roleAction()
    {
        return $this->view->render('index', 'role');
    }

    public function roleInfoAction($id)
    {
        $role = RbacRole::findFirst($id);
        $this->view->role = $role;
        return $this->view->render('index', 'role_info');
    }

    /**
     * @desc 添加角色
     * @author limx
     */
    public function addRoleAction($role_id = 0)
    {
        $role = RbacRole::findFirst($role_id);
        $this->view->role = $role;
        $this->view->title = $role_id > 0 ? "角色编辑" : "角色新增";
        $this->view->role_id = $role_id;
        return $this->view->render('index', 'role_add');
    }

    public function permissionAction($pid = 0)
    {
        $parent = [];
        self::getPermissionParent($pid, $parent);
        krsort($parent);
        $this->view->pid = $pid;
        $this->view->parent = $parent;
        return $this->view->render('index', 'permission');
    }

    /**
     * [addPermissionAction desc]
     * @desc 增加权限
     * @author limx
     * @param $pid
     * @return mixed
     */
    public function addPermissionAction($pid)
    {
        $parent = [];
        self::getPermissionParent($pid, $parent);
        krsort($parent);
        $this->view->pid = $pid;
        $this->view->parent = $parent;
        return $this->view->render('index', 'permission_add');
    }


}