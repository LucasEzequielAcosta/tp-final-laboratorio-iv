<?php
    namespace models;

    class User {

        private $user;
        private $password;
        private $type;

        public function __construct($user='', $password=''){
            
            $this->user = $user;
            $this->password = $password;
            $this->type = 'client';
            /*
            Por defecto todos los usuarios nuevos se crean como
            clientes, posteriormente un admin o superadmin puede
            modificar esto.
            */
        }

        public function getUser() {

            return $this->user;
        }

        public function setUser($value) {

            $this->user = $value;
        }

        public function getPassword() {

            return $this->password;
        }

        public function setPassword($value) {

            $this->password = $value;
        }

        public function getType() {

            return $this->type;
        }

        public function setType($value) {

            $this->type = $value;
        }
    }