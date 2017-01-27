<?php

namespace MyApp\Controllers;

use MyApp\Traits\Init;
use MyApp\Traits\System\Response;

class LoginController extends \Phalcon\Mvc\Controller
{
    use Response, Init;

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

    /**
     * [pfnLoginAction desc]
     * @desc 登录
     * @author limx
     */
    public function pfnLoginAction()
    {
        $name = $this->request->get("name");
        $password = $this->request->get("password");
        $res = self::login($name, $password);
        return self::success([$res]);
    }

}

