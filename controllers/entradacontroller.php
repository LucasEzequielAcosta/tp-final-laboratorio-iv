<?php
    namespace controllers;

    use dao\EntradaDao as EntradaDao;
    use models\Entrada as Entrada;

    class entradaController {

        private $entradaDao;

        public function __construct() {

            $this->entradaDao = new EntradaDao();
        }

        
    }