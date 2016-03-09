<?php

class IndexController extends Config_Framework_BaseController
{
    public function indexAction()
    {
        $this->loadView('index', 'index');
        $this->view->set('title', 'Welcome');
        $this->view->set('name', 'Ashish');
        $this->view->render();
    }
}