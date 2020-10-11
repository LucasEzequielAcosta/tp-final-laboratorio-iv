<?php
    namespace dao;

    use dao\IMovieDao as IMovieDao;
    use models\Movie as Movie;

    class MovieDao implements IMovieDao
    {
        private $movieList = array();

        public function add(Movie $movie)
        {
            $this->retrieveData();
            
            array_push($this->movieList, $movie);

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

                    array_push($this->movieList, $movie);
                }
            }
        }
    }
?>