<?php
    namespace controllers;

    use dao\CineDao as CineDao;
    use models\Cine as Cine;

    class cineController {

        private $cineDao;

        public function __construct() {

            $this->cineDao = new CineDao();
        }

        public function showHomeView($message='')
        {
            session_start();
            $message = $message;
            require_once(VIEWS_PATH . "cine-home.php");
        }

<<<<<<< Updated upstream
        public function showAddView()
=======
        public function showAddView($message='')
>>>>>>> Stashed changes
        {
            session_start();
            $message = $message;
            require_once(VIEWS_PATH . "add-cine.php");
        }

        public function showListView($message='')
        {
            session_start();
            $message = $message;            
            
            try {
                $cineList = $this->cineDao->getAll();
            
                if(!empty($cineList))
                {
                    $capacidad = $this->cineDao->getCapacity();
                }
            }

            catch(\Exception $ex) {
                $message = 'Error en la base de Datos!';
                $this->showHomeView($message);
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
            
            try {
                $this->cineDao->modify($cine, $idName);
            }

            catch(\Exception $ex)
            {
                $message = 'Error de la base de Datos al modificar cine!';                
                $this->showListView($message);                
            }

            usleep(550000);

            $this->showListView();
        }

<<<<<<< Updated upstream
        public function addCine($name, $adress) {

            $cine = new Cine($name, $adress);

            $this->cineDao->add($cine);

            $this->showAddView();
=======
        public function verify($name, $adress) //hacer este laburo en DAO
        {
            $message = '';
            $cineList = $this->cineDao->getAll();

            foreach($cineList as $cine)
            {
                if($cine->getName() == $name){
                    return $message = "Ya existe un cine con ese nombre!";
                }
                elseif ($cine->getAdress() == $adress){
                    return $message = "Ya existe un cine en esa direccion!";
                }
            }
            return $message;
        }

        public function addCine($name, $adress) {

            $message = $this->verify($name, $adress);

            try {
                if($message == '')
                {
                    $cine = new Cine($name, $adress);

                    $this->cineDao->add($cine);

                    $this->showAddView($message = "Cine agregado correctamente.");
                }
                else{
                    $this->showAddView($message);
                }
            }

            catch(\Exception $ex)
            {
                $message = 'Error de la base de Datos al cargar cine nuevo!';
                $this->showAddView($message);
            }
>>>>>>> Stashed changes
        }
    }
?>


