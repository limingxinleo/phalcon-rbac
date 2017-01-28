<?php

namespace MyApp\Controllers;

use Phalcon\Mvc\Controller;
use MyApp\Traits\System\Response;
use MyApp\Traits\Init;

class ControllerBase extends Controller
{
    use Response, Init;
    protected $user = [];

    public function initialize()
    {
        $user = self::getUserCache();
        if ($user === false) {
            if ($this->request->isPost()) {
                return self::error("登录超时！");
            }
            return $this->response->redirect("/login/index");
        }
    }
}
