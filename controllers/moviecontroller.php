<?php
    namespace controllers;

    use dao\GenreDao as GenreDao;
    use dao\MovieDao as MovieDao;

    class MovieController {

        private $movieDao;
        private $genreDao;

        public function __construct()
        {
            $this->movieDao = new MovieDao();
            $this->genreDao = new GenreDao();
        }

        public function showNowPlayingView($genreId='')
        {  
            $genreList = $this->genreDao->update();
            $movieList = $this->movieDao->update();    
            $message='';
            require_once(VIEWS_PATH."movie-now-playing.php");
        }

        public function getMoviesByGenre($genreId)
        {
            if($genreId != -1)
            {   
                $movieList = $this->movieDao->getMoviesByGenre($genreId);
                $genreList = $this->genreDao->update();
                
                if($movieList)
                {
                    $message='';
                    require_once(VIEWS_PATH."movie-now-playing.php");
                }
                else
                {
                    $message='No hay Peliculas del genero ' . $this->genreDao->getGenreById($genreId);
                    require_once(VIEWS_PATH."movie-now-playing.php");
                }
            }
            else
            {
                $this->showNowPlayingView($genreId);
            }
        }
    }
