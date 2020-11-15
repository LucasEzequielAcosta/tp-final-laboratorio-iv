<?php
    namespace controllers;

    use dao\FuncionDao as FuncionDao;
    use dao\MovieDao as MovieDao;
    use dao\GenreDao as GenreDao;

    class HomeController
    {
        private $funcionDao;
        private $movieDao;
        private $genreDao;

        public function index($message = "")
        {
            require_once(VIEWS_PATH.'nav.php');
            require_once(VIEWS_PATH.'login.php');
        }
        
        public function homeAdmin()
        {            
            require_once(VIEWS_PATH. 'cine-home.php');
        }

        public function homeUser()
        {   
            $this->funcionDao = new FuncionDao();
            $this->movieDao = new MovieDao;
            $this->genreDao = new GenreDao;
            $funcionList = $this->funcionDao->getAll();
            $movieList = $this->movieDao->getAll();
            $genreList = $this->genreDao->getAll();
            require_once(VIEWS_PATH. 'cartelera.php');
        }
    }
?>