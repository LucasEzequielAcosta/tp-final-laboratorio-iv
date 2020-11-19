<?php
    namespace controllers;

    use dao\CompraDao as CompraDao;
    use models\Compra as Compra;
    use dao\FuncionDao as FuncionDao;    
    use models\Funcion as Funcion;    
    use models\Entrada as Entrada;
    use dao\EntradaDao as EntradaDao;
    use dao\SalaDao as SalaDao;
    use models\Sala as Sala;
    use models\User as User;    

    class compraController {

        private $compraDao;
        private $funcionDao;
        private $entradaDao;
        private $salaDao;

        public function __construct() {

            $this->compraDao = new CompraDao();
            $this->funcionDao = new FuncionDao();
            $this->entradaDao = new EntradaDao();
            $this->salaDao = new SalaDao();
        }

        public function buyView($movie, $idFunc, $message='')
        {
            session_start();

            $movieName = $movie;
            $idFuncion = $idFunc;

            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            
            require_once(VIEWS_PATH . 'compra.php');
        }

        public function confirmBuy($_movie, $_idFunc, $_sala, $_total)
        {
            session_start();

            $user= new User();
            $user = $_SESSION['loggedUser'];
            $today = date("Y-n-d");

            $compra = New Compra();
            $compra->setFechaCompra($today);
            $compra->setUserCompra($user->getUser());
            $compra->setDescuento(0);
            $compra->setTotalCompra($_total);

            try {
                $sala= $this->salaDao->getSala($_sala);

                $funcion= $this->funcionDao->getFunction($_idFunc);

                $this->compraDao->add($compra);
            }

            catch (\PDOException $ex)
            {
                $message= 'Error en la Base de Datos!';
                $this->buyView($_movie, $_idFunc, $message);
            }

            $entrada = New Entrada();
            $entrada->setFuncion($_idFunc);
            
        }
    }