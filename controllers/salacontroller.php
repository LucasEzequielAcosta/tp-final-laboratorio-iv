<?php
    namespace controllers;

    use dao\SalaDao as SalaDao;
    use dao\CineDao as CineDao;
    use models\Sala as Sala;
    use models\Cine as Cine;

    class salaController {

        private $salaDao;
        private $cineDao;

        public function __construct() {

            $this->salaDao = new SalaDao();
            $this->cineDao = new CineDao();
        }

        public function showSalaView()
        {
            session_start();

            $salaList = $this->salaDao->getAll();
            
            $cineList = $this->cineDao->getAll();

            require_once(VIEWS_PATH . "sala-list.php");
        }

        public function delete($name)
        {
            $salaList = $this->salaDao->getAll();
            $sala = new Sala();

            foreach ($salaList as $key)
            {
                if($key->getName() == $name)
                {
                    $sala = $key;
                }
            }

            $this->salaDao->delete($sala);

            $this->showSalaView();
        }

        public function modify($idName, $newName, $newCapacity, $newPrice)
        {
            $sala = new Sala();
            $sala->setName($newName);
            $sala->setCapacity($newCapacity);
            $sala->setPrice($newPrice);

            $this->salaDao->modify($sala, $idName);

            usleep(550000);

            $this->showSalaView();
        }

        public function add($cineName, $nombre, $capacidad, $precio)
        {
            $sala = new Sala($nombre, $precio, $capacidad, $cineName);

            $this->salaDao->add($sala);

            usleep(550000);

            $this->showSalaView();
        }
    }