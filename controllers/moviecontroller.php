<?php
    namespace controllers;

    use dao\GenreDao as GenreDao;
    use controllers\GenreController as GenreController;
    use models\Movie as Movie;
    use dao\MovieDao as MovieDao;

    class MovieController {

        private $movieDao;
        private $genreDao;
        private $genreController;

        public function __construct()
        {
            $this->movieDao = new MovieDao();
            $this->genreDao = new GenreDao();
            $this->genreController = new GenreController();
        }

        public function showNowPlayingView()
        {  
            $movieList = $this->movieDao->getAll();
            $genreList = $this->genreController->addGenres();

            if($movieList)
            {
                require_once(VIEWS_PATH."movie-now-playing.php");
            }
            else
            {
                $this->addNowPlayingMovies();
            }
        }

        public function addNowPlayingMovies()
        {
            $results = $this->movieDao->getNowPlayingMovies();

            for($i=0; $i<19; $i++)
            {
                $title = $results[$i]['original_title'];
                $genreId = $results[$i]['genre_ids'];
                $description = $results[$i]['overview'];
                $rating = $results[$i]['vote_average'];
                $poster = $results[$i]['poster_path'];
                $id = $results[$i]['id'];

                $movie = new Movie();
                
                $movie->setTitle($title);
                $movie->setGenre(implode(", ", $this->genreDao->getGenreById($genreId)));
                $movie->setDescription($description);
                $movie->setRating($rating);
                $movie->setPoster("https://image.tmdb.org/t/p/w500" . $poster);
                $movie->setId($id);

                $this->movieDao->add($movie);
            }
            $this->showNowPlayingView();
        }
    }
