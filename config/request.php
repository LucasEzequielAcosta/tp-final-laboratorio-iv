<?php namespace config;

    class Request {

        private $controlador;
        private $metodo;
        private $parametros;
        
        public function __construct() {

            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $urlToArray = explode("/", $url);

            $ArregloUrl = array_filter($urlToArray);

            

            if(empty($ArregloUrl)) {
                $this->controlador = 'Login';
            } else {
                $this->controlador = array_shift($ArregloUrl);
            }

            if(empty($ArregloUrl)) {
                $this->metodo = 'init';
            } else {
                $this->metodo = array_shift($ArregloUrl);
            }            

            $metodoRequest = $this->getMetodoRequest();

            if($metodoRequest == 'GET') {
                if(!empty($ArregloUrl)) {
                    $this->parametros = $ArregloUrl;
                }
            } else {
                $this->parametros = $_POST;
            }

        }

        /**
         * 
         */
        public static function getInstance()
        {
            static $inst = null;
            if ($inst === null) {
                $inst = new Request();
            }
            return $inst;
        }



        /**
        * Devuelve el método HTTP
        * con el que se hizo el
        * Request
        * 
        * @return String
        */
        public static function getMetodoRequest()
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        /**
        * Devuelve el controlador
        * 
        * @return String
        */
        public function getControlador() {
            return $this->controlador;
        }

        /**
        * Devuelve el método 
        * 
        * @return String
        */
        public function getMetodo() {
            return $this->metodo;
        }
        
        /**
        * Devuelve los atributos
        * 
        * @return Array
        */
        public function getParametros() {
            return $this->parametros;
        }
    }