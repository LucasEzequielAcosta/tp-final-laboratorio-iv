<?php
    namespace controllers;

    use models\Movie as Movie;
    use dao\MovieDao as MovieDao;

    class MovieController {

        private $movieDao;
        private $nowPlayingUrl;
        private $genresUrl;
        private $apiKey;

        public function __construct()
        {
            $this->movieDao = new MovieDao();
            $this->nowPlayingUrl = "https://api.themoviedb.org/3/movie/now_playing?api_key=";
            $this->genresUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key=";
            $this->apiKey = "c058df23ba034ee1884bbf9cb41ffd30";
        }

        public function showNowPlayingView()
        {
            
            $movieList = $this->movieDao->getAll();


            require_once(VIEWS_PATH."movie-now-playing.php");
        }

        public function getNowPlayingMovies() 
        {
            $json = file_get_contents($this->nowPlayingUrl . $this->apiKey);

            $data = json_decode($json, true);

            $results = $data['results'];

            return $results;
        }

        public function getGenres($genreId)
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey);

            $genresArray = json_decode($json, true);

            $genreNames = array();

            for($i=0; $i<18; $i++)
            {
                foreach($genreId as $value)
                {
                    if($genresArray['genres'][$i]['id'] == $value)
                    {
                        array_push($genreNames, $genresArray['genres'][$i]['name']);
                    }
                }
            }
            return $genreNames;
        }

        public function addNowPlayingMovies()
        {
            $results = $this->getNowPlayingMovies();

            for($i=0; $i<19; $i++)
            {
                $title = $results[$i]['original_title'];
                $genreId = $results[$i]['genre_ids'];
                $description = $results[$i]['overview'];
                $rating = $results[$i]['vote_average'];

                $movie = new Movie();

                $movie->setTitle($title);
                $movie->setGenre(implode(", ", $this->getGenres($genreId)));
                $movie->setDescription($description);
                $movie->setRating($rating);

                $this->movieDao->add($movie);
            }

            $this->showNowPlayingView();
        }
    }
?>