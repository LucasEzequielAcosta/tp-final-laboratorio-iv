<?php
    namespace controllers;

    use dao\FuncionDao as FuncionDao;
    use dao\SalaDao as SalaDao;
    use dao\MovieDao as MovieDao;
    use models\Funcion as Funcion;
    use models\Sala as Sala;
    use models\Movie as Movie;

    class funcionController {

        private $funcionDao;
        private $salaDao;
        private $movieDao;

        public function __construct() {

            $this->funcionDao = new FuncionDao();
            $this->salaDao = new SalaDao();
            $this->movieDao = new MovieDao();
        }

        public function showFunctionView()
        {
            session_start();

            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            $movieList = $this->movieDao->getAll();

            require_once(VIEWS_PATH . 'funcion-list.php');
        }

        public function delete($idFuncion)
        {
            $funcionList = $this->funcionDao->getAll();
            $funcion = new Funcion();

            foreach ($funcionList as $key)
            {
                if($key->getIdFuncion() == $idFuncion)
                {
                    $funcion = $key;
                }
            }

            $this->funcionDao->delete($funcion);

            $this->showFunctionView();
        }

        public function modify($idFuncion, $sala, $pelicula, $fecha)
        {
            $funcion = new Funcion();
            $funcion->setIdFuncion($idFuncion);
            $funcion->setNombreSala($sala);
            $funcion->setIdMovie($pelicula);
            $funcion->setHorario($fecha);

            $this->funcionDao->modify($funcion);

            usleep(550000);

            $this->showFunctionView();
        }

        
    }