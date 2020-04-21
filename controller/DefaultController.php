<?php

class DefaultController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function accionDefault()
    {
        $this->view->show('indexView.php');
    }
}
