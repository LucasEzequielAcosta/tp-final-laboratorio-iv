<?php
    namespace controllers;

    class HomeController
    {
        public function index($message = "")
        {
            require_once(ROOT. "views/index.php");
        }
        
        public function home()
        {            
            require_once(ROOT. "views/home.php");
        }
    }
?>