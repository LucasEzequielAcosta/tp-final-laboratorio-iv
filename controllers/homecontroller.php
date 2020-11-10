<?php
    namespace controllers;

    class HomeController
    {
        public function index($message = "")
        {
            require_once(VIEWS_PATH.'nav.php');
            require_once(VIEWS_PATH.'login.php');
        }
        
        public function home()
        {            
            require_once(ROOT. "views/home.php");
        }
    }
?>