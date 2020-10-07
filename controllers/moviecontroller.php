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

        public function addMovie($tittle, $genre, $durantion, $description, $rating) {

            $movie = new Movie($tittle, $genre, $durantion, $description, $rating);

            $this->movieDao->add($movie);
        }
    }
?>