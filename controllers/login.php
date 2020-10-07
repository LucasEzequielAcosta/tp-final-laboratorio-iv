<?php

namespace controllers;

class Login {

    public function init() {

        echo 'Estoy en init';

        include ROOT . '/views/login.php';

    }

}