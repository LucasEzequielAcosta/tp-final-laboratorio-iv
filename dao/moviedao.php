<?php
    namespace dao;

    use models\Movie as Movie;

    class MovieDao
    {
        private $movieList = array();
        private $nowPlayingUrl;
        private $apiKey;

        function __construct()
        {
            $this->nowPlayingUrl = "https://api.themoviedb.org/3/movie/now_playing?api_key=";
            $this->genresUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key=";
            $this->apiKey = "c058df23ba034ee1884bbf9cb41ffd30";
        }

        public function getNowPlayingMovies() 
        {
            $json = file_get_contents($this->nowPlayingUrl . $this->apiKey . "&language=es");

            $data = json_decode($json, true);

            $results = $data['results'];

            return $results;
        }

        public function verify(Movie $movie)
        {
            $response = true;
            foreach($this->movieList as $_movie)
            {
                if($_movie->getId() != $movie->getId())
                {
                    $response = true;
                }
                else
                {
                    return $response = false;
                }

            }
            return $response;
        }

        public function add(Movie $movie)
        {
            $this->retrieveData();

            if($this->verify($movie))
            {
                array_push($this->movieList, $movie);
            }
            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->movieList;
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->movieList as $movie)
            {
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["genre"] = $movie->getGenre();
                $valuesArray["description"] = $movie->getDescription();
                $valuesArray["rating"] = $movie->getRating();
                $valuesArray["poster"] = $movie->getPoster();
                $valuesArray["id"] = $movie->getId();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/movies.json', $jsonContent);
        }

        private function retrieveData()
        {
            $this->movieList = array();

            if(file_exists('data/movies.json'))
            {
                $jsonContent = file_get_contents('data/movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new movie();
                    $movie->setTitle($valuesArray["title"]);
                    $movie->setGenre($valuesArray["genre"]);
                    $movie->setDescription($valuesArray["description"]);
                    $movie->setRating($valuesArray["rating"]);
                    $movie->setPoster($valuesArray["poster"]);
                    $movie->setId($valuesArray["id"]);

                    array_push($this->movieList, $movie);
                }
            }
        }
    }
?>