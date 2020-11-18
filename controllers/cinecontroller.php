<?php
    namespace controllers;

    use dao\CineDao as CineDao;
    use models\Cine as Cine;

    class cineController {

        private $cineDao;

        public function __construct() {

            $this->cineDao = new CineDao();
        }

        public function showHomeView()
        {
            session_start();
            require_once(VIEWS_PATH . "cine-home.php");
        }

        public function showAddView()
        {
            session_start();
            require_once(VIEWS_PATH . "add-cine.php");
        }

        public function showListView()
        {
            session_start();            
            
            $cineList = $this->cineDao->getAll();
            
            if(!empty($cineList))
            {
                $capacidad = $this->cineDao->getCapacity();
            }           
            

            require_once(VIEWS_PATH . "cine-list.php");
        }

        public function delete($name)
        {            
            $cineList = $this->cineDao->getAll();
            $cine = new Cine();
            foreach ($cineList as $key)
            {
                if($key->getName() == $name)
                {
                    $cine = $key;
                }
            }
            $this->cineDao->delete($cine);

            $this->showListView();
        }

        public function modify($idName, $newName, $newAdress)
        {            
            $cine = new Cine();
            $cine->setName($newName);            
            $cine->setAdress($newAdress);            

            $this->cineDao->modify($cine, $idName);

            usleep(550000);

            $this->showListView();
        }

        public function addCine($name, $adress) {

            $cine = new Cine($name, $adress);

            $this->cineDao->add($cine);

            $this->showAddView();
        }
    }
?>


