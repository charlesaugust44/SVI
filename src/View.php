<?php

class View
{
    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function call($view, $context)
    {
        $controller = substr(get_class($context), 10);
        $data = $this->data;
        include_once "Web/View/" . $controller . "/" . $view . $controller . ".php";
    }

    public function addData($index, $data)
    {
        $this->data[$index] = $data;
    }
}