<?php
    namespace controllers;

    use dao\CineDao as CineDao;
    use models\Cine as Cine;

    class cineController {

        private $cineDao;

        public function __construct() {

            $this->cineDao = new CineDao();
        }        

        public function showAddView()
        {
            session_start();
            require_once(VIEWS_PATH . "add-cine.php");
        }

        public function showListView()
        {
            session_start();
            $cineList = [];
            unset($cineList);
            
            $cineList = $this->cineDao->getAll();

            require_once(VIEWS_PATH . "cine-list.php");
        }

        public function delete($name)
        {
            $cineList = [];
            unset($cineList);
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

        public function addCine($name, $capacity, $adress, $price) {

            $cine = new Cine($name, $capacity, $adress, $price);

            $this->cineDao->add($cine);

            $this->showAddView();
        }
    }
?>


