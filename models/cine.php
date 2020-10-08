<?php
    namespace models;

    class Cine {

        private $name;
        private $capacity;
        private $adress;
        private $price;

        public function __construct($name='', $capacity='', $adress='', $price='') {

            $this->name = $name;
            $this->capacity = $capacity;
            $this->adress = $adress;
            $this->price = $price;
        }

        public function getName() {

            return $this->name;
        }

        public function getCapacity() {

            return $this->capacity;
        }

        public function getAdress() {

            return $this->adress;
        }

        public function getPrice() {

            return $this->price;
        }

        public function setName($value) {

            $this->name = $value;
        }

        public function setCapacity($value) {

            $this->capacity = $value;
        }

        public function setAdress($value) {

            $this->adress = $value;
        }

        public function setPrice($value) {

            $this->price = $value;
        }

    }
?>
