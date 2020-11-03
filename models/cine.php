<?php
    namespace models;

    class Cine {

        private $name;        
        private $adress;


        public function __construct($name='', $adress='') {

            $this->name = $name;            
            $this->adress = $adress;            
        }


        public function getName() {

            return $this->name;
        }        

        public function getAdress() {

            return $this->adress;
        }

        
        public function setName($value) {

            $this->name = $value;
        }        

        public function setAdress($value) {

            $this->adress = $value;
        }
    }
?>
