<?php
    namespace controllers;

    class HomeController
    {
        public function index($message = "")
        {
            require_once(ROOT. "views/index.php");
        }        
    }
?>