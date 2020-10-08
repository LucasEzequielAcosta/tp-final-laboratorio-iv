<?php
    namespace controllers;

    use models\Movie as Movie;
    use dao\MovieDao as MovieDao;

    class MovieController {

        private $movieDao;

        public function __construct()
        {
            $this->movieDao = new MovieDao();
        }

        public function showAddView()
        {
            require_once("../views/addcine.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function addMovie($tittle, $genre, $durantion, $description, $rating) {

            $movie = new Movie($tittle, $genre, $durantion, $description, $rating);

            $this->movieDao->add($movie);

            $this->showAddView();
        }
    }
?>