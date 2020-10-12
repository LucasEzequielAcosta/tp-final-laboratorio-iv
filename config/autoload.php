<?php namespace config;

    class Autoload {

        public static function start() {

            spl_autoload_register(function($classPath) {

                $pathBarrasInvertidas = str_replace("\\", "/", $classPath);
                
                $classFile = strtolower(ROOT . $pathBarrasInvertidas . ".php");

                include_once($classFile);
            });
        }
    }
?>