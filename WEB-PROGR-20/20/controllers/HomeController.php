<?php
class HomeController 
{
    public function index()
    {
        $title = 'Головна';
        $template = 'index.php';
        include "views/layout.php";
    }
}
