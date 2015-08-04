<?php

class IndexController extends Config_Framework_BaseController
{
    public function indexAction()
    {
        $view = $this->loadView('index', 'index');
        $view->set('title', 'Page Title');
        $view->render();
    }
}