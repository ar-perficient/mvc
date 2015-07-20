<?php

class IndexController extends BaseController
{
    public function indexAction()
    {
        $view = $this->loadView('index', 'index');
        $view->setTitle('test');
        $view->render();
    }
}