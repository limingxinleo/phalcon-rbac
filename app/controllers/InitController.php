<?php

namespace MyApp\Controllers;

class InitController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        return $this->view->render('init', 'index');
    }

}

