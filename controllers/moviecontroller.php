<?php
    namespace controllers;

    use dao\GenreDao as GenreDao;
    use models\Movie as Movie;
    use dao\MovieDao as MovieDao;

    class MovieController {

        private $movieDao;
        private $genreDao;

        public function __construct()
        {
            $this->movieDao = new MovieDao();
            $this->genreDao = new GenreDao();
        }

        public function showNowPlayingView()
        {  
            $genreList = $this->genreDao->update();
            $movieList = $this->movieDao->getAll();

            if($movieList)
            {
                require_once(VIEWS_PATH."movie-now-playing.php");
            }
            else
            {
                $this->addNowPlayingMovies();
            }
        }

        public function getByGenre()
        {
            if($_POST != -1)
            {   
                $genreId = $_POST['genre'];
                $movieList = $this->movieDao->getByGenre($genreId);
                
                if($movieList)
                {
                    require_once(VIEWS_PATH."movie-now-playing.php");
                }
            }
            else
            {
                $this->addNowPlayingMovies();
            }

        }

        public function addNowPlayingMovies()
        {
            //Trae de la API las peliculas que estan en cartelera y las guarda en $results
            $results = $this->movieDao->getNowPlayingMovies();

            //Recorre el arreglo de results y va guardando 
            for($i=0; $i<19; $i++)
            {
                $title = $results[$i]['original_title'];
                $description = $results[$i]['overview'];
                $rating = $results[$i]['vote_average'];
                $poster = $results[$i]['poster_path'];
                $id = $results[$i]['id'];

                $movie = new Movie();
                
                $movie->setTitle($title);
                $movie->setDescription($description);
                $movie->setRating($rating);
                $movie->setPoster("https://image.tmdb.org/t/p/w500" . $poster);
                $movie->setId($id);

                $this->movieDao->add($movie);
            }
            $this->showNowPlayingView();
        }
    }
