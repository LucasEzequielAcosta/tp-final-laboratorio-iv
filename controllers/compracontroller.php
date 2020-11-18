<?php
    namespace controllers;

    use dao\CompraDao as CompraDao;
    use models\Compra as Compra;
    use dao\FuncionDao as FuncionDao;    
    use models\Funcion as Funcion;    
    use models\Entrada as Entrada;
    use dao\EntradaDao as EntradaDao;

    class compraController {

        private $compraDao;
        private $funcionDao;
        private $entradaDao;

        public function __construct() {

            $this->compraDao = new CompraDao();
            $this->funcionDao = new FuncionDao();
            $this->entradaDao = new EntradaDao();
        }

        public function buyView()
        {
            session_start();

            $funcionList = $this->funcionDao->getAll();
            
            require_once(VIEWS_PATH . 'compra.php');
        }
    }