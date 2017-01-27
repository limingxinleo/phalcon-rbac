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


}