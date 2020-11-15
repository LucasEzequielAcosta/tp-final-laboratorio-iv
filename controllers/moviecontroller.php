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

        public function showNowPlayingView()
        {  
            $genreList = $this->genreDao->update();
            $movieList = $this->movieDao->update();    
            
            require_once(VIEWS_PATH."movie-now-playing.php");
        }

        public function getMoviesByGenre()
        {
            if($_POST['genre'] != -1)
            {   
                $genreId = $_POST['genre'];
                $movieList = $this->movieDao->getMoviesByGenre($genreId);
                $genreList = $this->genreDao->update();
                
                if($movieList)
                {
                    require_once(VIEWS_PATH."movie-now-playing.php");
                }
                else
                {
                    
                    require_once(VIEWS_PATH."movie-now-playing.php");
                    echo "<strong><h2 class='nav navbar justify-content-center'>No hay Peliculas del genero " . $this->genreDao->getGenreById($_POST['genre']) ."</h2></strong>";
                }
            }
            else
            {
                $this->showNowPlayingView();
            }
        }
    }
