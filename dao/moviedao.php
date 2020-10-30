<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Movie as Movie;

    class MovieDao
    {
        private $tableName = "movies";
        private $movieList = array();
        private $nowPlayingUrl;
        private $apiKey;

        function __construct()
        {
            $this->nowPlayingUrl = "https://api.themoviedb.org/3/movie/now_playing?api_key=";
            $this->moviesUrl = "https://api.themoviedb.org/3/movie/movie/list?api_key=";
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
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (idMovie, titulo, descripcion, rating, poster) VALUES (:idMovie, :titulo, :descripcion, :rating, :poster);";

                $parameters["idMovie"] = $movie->getId();
                $parameters["titulo"] = $movie->getTitle();
                $parameters["descripcion"] = $movie->getDescription();
                $parameters["rating"] = $movie->getRating();
                $parameters["poster"] = $movie->getPoster();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            try
            {
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $movie = new movie();
                    $movie->setId($fila["idMovie"]);
                    $movie->setTitle($fila["titulo"]);
                    $movie->setDescription($fila["descripcion"]);
                    $movie->setRating($fila["rating"]);
                    $movie->setPoster($file["poster"]);

                    array_push($this->movieList, $movie);
                }

                return $this->movieList;                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }       
    }
?>