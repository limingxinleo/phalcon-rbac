<?php

namespace MyApp\Controllers;

use MyApp\Traits\System\Response;
use MyApp\Traits\Init;

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
        $res = self::saveAdmin();

        return self::success();
    }

}

