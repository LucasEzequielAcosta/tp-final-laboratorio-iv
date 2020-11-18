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

        public function showAddView($mesage='')
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

        public function verify($name, $adress)
        {
            $mesage = '';
            $cineList = $this->cineDao->getAll();

            foreach($cineList as $cine)
            {
                if($cine->getName() == $name){
                    return $mesage = "Ya existe un cine con ese nombre";
                }
                elseif ($cine->getAdress() == $adress){
                    return $mesage = "Ya existe un cine en esa direccion";
                }
            }
            return $mesage;
        }

        public function addCine($name, $adress) {

            $mesage = $this->verify($name, $adress);

            if($mesage == '')
            {
                $cine = new Cine($name, $adress);

                $this->cineDao->add($cine);

                $this->showAddView($mesage = "cine agregado correctamente");
            }
            else{
                $this->showAddView($mesage);
            }
        }
    }
?>


