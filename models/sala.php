<?php
    namespace models;

    class Sala {

        private $nombre;        
        private $precio;
        private $capacidad;
        private $cine;


        public function __construct($nombre='', $precio='', $capacidad='', $cine='') {

            $this->nombre = $nombre;            
            $this->precio = $precio; 
            $this->capacidad = $capacidad;
            $this->cine = $cine;
        }


        public function getName() {

            return $this->nombre;
        }        

        public function getPrice() {

            return $this->precio;
        }

        public function getCapacity() {

            return $this->capacidad;
        }

        public function getCine() {

            return $this->cine;
        }

        
        public function setName($value) {

            $this->nombre = $value;
        }        

        public function setPrice($value) {

            $this->precio = $value;
        }

        public function setCapacity($value) {

            $this->capacidad = $value;
        }

        public function setCine($value) {

            $this->cine = $value;
        }
    }
?>