<?php namespace config;

    class Request {

        private $controller;
        private $method;
        private $parameters = array();
        
        public function __construct() {

            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $urlToArray = explode("/", $url);

            $urlArray = array_filter($urlToArray);

            

            if(empty($urlArray)) {
                $this->controller = 'Home';
            } else {
                $this->controller = ucwords(array_shift($urlArray));
            }

            if(empty($urlArray)) {
                $this->method = 'Index';
            } else {
                $this->method = array_shift($urlArray);
            }            

            $methodRequest = $this->getMethodRequest();

            if($methodRequest == "GET")
            {
                unset($_GET["url"]);

                if(!empty($_GET))
                {                    
                    foreach($_GET as $key => $value)                    
                        array_push($this->parameters, $value);
                }
                else
                    $this->parameters = $urlArray;
            }
            elseif ($_POST)
                $this->parameters = $_POST;
            
            if($_FILES)
            {
                unset($this->parameters["button"]);
                
                foreach($_FILES as $file)
                {
                    array_push($this->parameters, $file);
                }
            }
        }

        
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
        public static function getMethodRequest()
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        /**
        * Devuelve el controller
        * 
        * @return String
        */
        public function getController() {
            return $this->controller;
        }

        /**
        * Devuelve el método 
        * 
        * @return String
        */
        public function getMethod() {
            return $this->method;
        }
        
        /**
        * Devuelve los atributos
        * 
        * @return Array
        */
        public function getParameters() {
            return $this->parameters;
        }
    }