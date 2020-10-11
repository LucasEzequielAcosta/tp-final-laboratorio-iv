<?php
    namespace controllers;

    use models\Movie as Movie;
    use dao\MovieDao as MovieDao;

    class MovieController {

        private $movieDao;
        private $url;
        private $apiKey;

        public function __construct()
        {
            $this->movieDao = new MovieDao();
            $this->url = "https://api.themoviedb.org/3/movie/now_playing?api_key=";
            $this->apiKey = "c058df23ba034ee1884bbf9cb41ffd30";
        }

        public function showNowPlayingView()
        {
            $movieList = $this->movieDao->getAll();


            require_once(VIEWS_PATH."movie-now-playing.php");
        }

        public function getNowPlayingMovies() 
        {
            $json = file_get_contents($this->url . $this->apiKey);

            $data = json_decode($json, true);

            $results = $data['results'];

            return $results;
        }

        public function addNowPlayingMovies()
        {
            $results = $this->getNowPlayingMovies();

            
            $title = $results[0]['original_title'];
            $genre = implode( ", ", $results[0]['genre_ids']);
            $description = $results[0]['overview'];
            $rating = $results[0]['vote_average'];

            $movie = new Movie();

            $movie->setTitle($title);
            $movie->setGenre($genre);
            $movie->setDescription($description);
            $movie->setRating($rating);

            $this->movieDao->add($movie);

            $this->showNowPlayingView();
        }
    }
?>