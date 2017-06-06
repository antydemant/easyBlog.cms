<?php

class View
{
    private $view_path = null;

    public function __construct($dir_path)
    {
        if(!empty($dir_path) && isset($dir_path)) $this->view_path =  $dir_path;
    }
}