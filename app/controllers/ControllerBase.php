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
            return $this->response->redirect("/login/index");
        }
    }
}
