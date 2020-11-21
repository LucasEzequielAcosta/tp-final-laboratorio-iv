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
    use models\Movie as Movie;
    use dao\MovieDao as MovieDao;
    use models\Cine as Cine;
    use dao\CineDao as CineDao;
    use controllers\HomeController as HomeController;   

    class compraController {

        private $compraDao;
        private $funcionDao;
        private $entradaDao;
        private $salaDao;
        private $homeCon;
        private $movieDao;
        private $cineDao;

        public function __construct() {

            $this->compraDao = new CompraDao();
            $this->funcionDao = new FuncionDao();
            $this->entradaDao = new EntradaDao(); 
            $this->salaDao = new SalaDao();
            $this->homeCon = new HomeController();
            $this->movieDao = new MovieDao();
            $this->cineDao = new CineDao();
        }

        public function buyView($movie, $cantEntradas, $idFunc, $_message='')
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            
            $cap = $this->checkCapacity($idFunc, $cantEntradas);

            if($cap == 'ok')
            {
                $message = $_message;
                $movieName = $movie;
                $idFuncion = $idFunc;
                $cantidad = $cantEntradas;

                try{
                    $funcionList = $this->funcionDao->getAll();
                    $salaList = $this->salaDao->getAll();
                }

                catch (\Exception $ex)
                {
                    $message= 'Error en la Base de Datos!';
                    require_once(VIEWS_PATH . 'compra.php');
                }
                    
                require_once(VIEWS_PATH . 'compra.php');
            }

            elseif($cap == 'capped')
            {
                $message= 'No hay más asientos disponibles en esta funcion!';
                $this->homeCon->homeUser($message);
            }

            else
            {
                $message= 'No hay tantos asientos disponibles en esta funcion! Asientos disponibles: ' . $cap;
                $this->homeCon->homeUser($message);
            }


        }

        public function checkCapacity($_idFunc, $_cantEntradas)
        {
            $operation = 0;

            try{
                $funcionList = $this->funcionDao->getAll();
                $salaList = $this->salaDao->getAll();
                $entradaList = $this->entradaDao->getAll();
            }

            catch (\Exception $ex)
            {
                $message= 'Error en la Base de Datos!';
                require_once(VIEWS_PATH . 'compra.php');
            }

            $salaCap = 0;
            foreach($funcionList as $funcion)
            {
                if($funcion->getIdFuncion() == $_idFunc)
                {
                    foreach($salaList as $sala)
                    {
                        if($funcion->getNombreSala() == $sala->getName())
                        {
                            $salaCap = (int)$sala->getCapacity();                            
                            break;
                        }
                    }
                }
            }

            $currentCap = 0;
            foreach($entradaList as $entrada)
            {
                if($entrada->getFuncion() == $_idFunc)
                {
                    ++$currentCap;                      
                }
            }            
                        
            
            if($currentCap == $salaCap)
            { 
                $operation = 'capped';
                return $operation;
            }
            
            elseif(($currentCap + $_cantEntradas) > $salaCap)
            {
                $operation = $salaCap - $currentCap;                
                return $operation;
            }

            else
            {
                $operation = 'ok';
                return $operation;
            }
            
        }

        public function confirmBuy($_movie, $_idFunc, $_total, $_cantEntradas)
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

            $entrada = New Entrada();
            $entrada->setFuncion($_idFunc);
                
            $operation = false;

            try {
                $this->compraDao->add($compra);

                for ($i=1; $i <= $_cantEntradas ; $i++)
                { 
                    $entrada->setIdCompra($this->compraDao->getLatest());
                    $operation = $this->entradaDao->add($entrada);
                }                    
            }

            catch (\Exception $ex)
            {
                $message= 'Error en la Base de Datos!';
                $this->buyView($_movie, $_idFunc, $message);
            }
                
            if($operation)
            {
                $message= 'Compra registrada con éxito!';
                $this->homeCon->homeUser($message);
            }
        }

        public function checkSales($message='')
        {
            session_start();

            try{
                $funcionList = $this->funcionDao->getAll();
                $salaList = $this->salaDao->getAll();
                $compraList = $this->compraDao->getAll();
                $entradaList = $this->entradaDao->getAllDesc();
                $movieList = $this->movieDao->getAll();
            }            

            catch(\Exception $ex)
            {
                $message= "Error en la BD!";
                require_once(VIEWS_PATH . 'ventas.php');
            }            
            
            
            require_once(VIEWS_PATH . 'ventas.php');
        }

        public function checkSalesByCinema($message='')
        {
            session_start();

            try{
                $funcionList = $this->funcionDao->getAll();
                $salaList = $this->salaDao->getAll();
                $compraList = $this->compraDao->getAll();
                $entradaList = $this->entradaDao->getAllDesc();
                $movieList = $this->movieDao->getAll();
                $cineList = $this->cineDao->getAll();
            }

            catch(\Exception $ex)
            {
                $message= "Error en la BD!";
                require_once(VIEWS_PATH . 'ventas-cines.php');
            }            
            
            require_once(VIEWS_PATH . 'ventas-cines.php');
        }

        public function checkSalesByMovie($message='')
        {
            session_start();

            try{
                $funcionList = $this->funcionDao->getAll();
                $salaList = $this->salaDao->getAll();
                $compraList = $this->compraDao->getAll();
                $entradaList = $this->entradaDao->getAllDesc();
                $movieList = $this->movieDao->getAll();
            }

            catch(\Exception $ex)
            {
                $message= "Error en la BD!";
                require_once(VIEWS_PATH . 'ventas-peliculas.php');
            }

            require_once(VIEWS_PATH . 'ventas-peliculas.php');
        }

        public function checkSalesByShow($message='')
        {
            session_start();

            try{
                $funcionList = $this->funcionDao->getAll();
                $salaList = $this->salaDao->getAll();
                $compraList = $this->compraDao->getAll();
                $entradaList = $this->entradaDao->getAllDesc();
                $movieList = $this->movieDao->getAll();
            }

            catch(\Exception $ex)
            {
                $message= "Error en la BD!";
                require_once(VIEWS_PATH . 'ventas-funciones.php');
            }

            require_once(VIEWS_PATH . 'ventas-funciones.php');
        }

        public function ticketsByUser($message='')
        {
            session_start();            

            $usuario = New User();
            $usuario = $_SESSION['loggedUser'];
            $check = $this->compraDao->checkUserPurchase($usuario);
            
                try{
                    $funcionList = $this->funcionDao->getAll();                
                    $compraList = $this->compraDao->getAll();
                    $entradaList = $this->entradaDao->getAllDesc();
                    $movieList = $this->movieDao->getAll();
                }

                catch(\Exception $ex)
                {
                    $message= "Error en la BD!";
                    require_once(VIEWS_PATH . 'compras-usuario.php');
                }
            

            if($check == false)
            {
                $message = 'Usted no posee compras realizadas.';                
            }

            require_once(VIEWS_PATH . 'compras-usuario.php');
        }
    }