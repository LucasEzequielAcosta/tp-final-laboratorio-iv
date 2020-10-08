<?php
    namespace controllers;

    class HomeController
    {
        public function index($message = "")
        {
            echo ROOT. "views/add-cine.php";
            require_once(ROOT. "views/add-cine.php");
        }        
    }
?>