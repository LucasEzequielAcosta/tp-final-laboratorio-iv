<?php
    namespace dao;

    use dao\IMovieDao as IMovieDao;
    use models\Movie as Movie;

    class MovieDao implements IMovieDao
    {
        private $movieList = array();

        public function Add(Movie $movie)
        {
            $this->RetrieveData();
            
            array_push($this->movieList, $movie);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movieList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->movieList as $movie)
            {
                $valuesArray["tittle"] = $movie->getTittle();
                $valuesArray["genre"] = $movie->getGenre();
                $valuesArray["duration"] = $movie->getduration();
                $valuesArray["description"] = $movie->getDescription();
                $valuesArray["rating"] = $movie->getRating();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/movies.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->movieList = array();

            if(file_exists('data/movies.json'))
            {
                $jsonContent = file_get_contents('data/movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new movie();
                    $movie->setTittle($valuesArray["tittle"]);
                    $movie->setGenre($valuesArray["genre"]);
                    $movie->setDescription($valuesArray["description"]);
                    $movie->setRating($valuesArray["rating"]);
                    $movie->setDuration($valuesArray["duration"]);

                    array_push($this->movieList, $movie);
                }
            }
        }
    }
?>