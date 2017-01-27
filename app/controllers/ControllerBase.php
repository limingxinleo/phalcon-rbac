<?php

namespace MyApp\Controllers;

use Phalcon\Mvc\Controller;
use MyApp\Traits\System\Response;
use MyApp\Traits\Init;

class ControllerBase extends Controller
{
    use Response, Init;

    public function initialize()
    {

    }
}
