<?php

class IndexController extends Config_Framework_BaseController
{
    public function indexAction()
    {
        $view = $this->loadView('index', 'index');
        $view->setTitle('Page Title');
        $view->render();
    }
}