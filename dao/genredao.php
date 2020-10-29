<?php
    namespace dao;

    use models\Genre as Genre;

    class GenreDao
    {
        private $genreList = array();
        private $genresUrl;
        private $apiKey;

        function __construct()
        {
            $this->genresUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key=";
            $this->apiKey = "c058df23ba034ee1884bbf9cb41ffd30";
        }

        public function getGenres() 
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey);

            $genresArray = json_decode($json, true);

            return $genresArray['genres'];
        }

        /**
         * Trae los generos de la API
         *
         * @param [models\Genre] $genreId
         */
        public function getGenreById($genreId) 
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

        public function getAll()
        {
            $this->retrieveData();

            return $this->genreList;
        }

        public function verify(Genre $genre)
        {
            $response = true;
            foreach($this->genreList as $_genre)
            {
                if($_genre->getGenreId() != $genre->getGenreId())
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

        public function add(Genre $genre)
        {
            $this->retrieveData();

            if($this->verify($genre))
            {
                array_push($this->genreList, $genre);
            }
            $this->saveData();
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->genreList as $genre)
            {
                $valuesArray["genre"] = $genre->getGenre();
                $valuesArray["id"] = $genre->getGenreId();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/genres.json', $jsonContent);
        }

        private function retrieveData()
        {
            $this->genreList = array();

            if(file_exists('data/genres.json'))
            {
                $jsonContent = file_get_contents('data/genres.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $genre = new genre();
                    $genre->setGenre($valuesArray["genre"]);
                    $genre->setGenreId($valuesArray["id"]);

                    array_push($this->genreList, $genre);
                }
            }
        }
    }
?>