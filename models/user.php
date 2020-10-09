<?php
    namespace models;

    class User {

        private $user;
        private $passowrd;

        public function __construct($user, $passowrd){
            
            $this->user = $user;
            $this->passowrd = $passowrd;
        }

        public function getUser() {

            return $this->user;
        }

        public function setUser($value) {

            $this->user = $value;
        }

        public function getPassword() {

            return $this->passowrd;
        }

        public function setPassword($value) {

            $this->passowrd = $value;
        }
    }