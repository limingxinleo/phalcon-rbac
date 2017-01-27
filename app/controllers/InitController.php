<?php

namespace MyApp\Controllers;

use MyApp\Traits\System\Response;
use MyApp\Traits\Init;
use limx\phalcon\DB;

class InitController extends \Phalcon\Mvc\Controller
{
    use Response, Init;

    public function indexAction()
    {
        return $this->view->render('init', 'index');
    }

    public function pfnSaveAction()
    {
        $password = $this->request->get('password');
        $name = $this->request->get('name');

        DB::begin();
        $id = self::addUser($name, $password);
        if ($id === false) {
            DB::rollback();
            return self::error("管理员创建失败！");
        }
        $res = self::addUserRole($id, 1);
        if ($res === false) {
            DB::rollback();
            return self::error("初始化失败！");
        }
        DB::commit();
        return self::success();
    }

}

