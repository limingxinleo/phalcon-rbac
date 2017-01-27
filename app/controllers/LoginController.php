<?php

namespace MyApp\Controllers;

use MyApp\Models\RbacUser;
use MyApp\Traits\Init;

class LoginController extends \Phalcon\Mvc\Controller
{
    use Init;

    public function initialize()
    {
        // 查看是否已经存在管理员用户
        if (self::isFirstUse()) {
            // 进入初始化流程
            $dispatcher = di('dispatcher');
            return $dispatcher->forward([
                'namespace' => 'MyApp\Controllers',
                "controller" => "init",
                "action" => "index",
            ]);
        }
    }

    public function indexAction()
    {
        return $this->view->render('login', 'index');
    }

}

