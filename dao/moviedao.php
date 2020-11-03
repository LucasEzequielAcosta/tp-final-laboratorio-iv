<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Movie as Movie;

    class MovieDao
    {
        private $tableName = "movies";        
        private $nowPlayingUrl;
        private $apiKey;
        private $connection;

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

        public function createMoviesFromJson()
        {
            $movieList = array();
            $JSON = $this->getNowPlayingMovies();

            for($i=0; $i<19; $i++)
            {
                $movie = new Movie();

                $movie->setTitle($JSON[$i]['original_title']);
                $movie->setDescription($JSON[$i]['overview']);
                $movie->setRating($JSON[$i]['vote_average']);
                $movie->setPoster('https://image.tmdb.org/t/p/w500' . $JSON[$i]['poster_path']);
                $movie->setId($JSON[$i]['id']);
                $movie->setGenres($JSON[$i]['genre_ids']);                

                array_push($movieList, $movie);
            }

            return $movieList;
        }

        public function verify(Movie $movie)
        {
            $movieList = array();
            $response = true;
            foreach($movieList as $_movie)
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

        public function insertMovieGenres()
        {
            try
            {
                $movieList = $this->createMoviesFromJson();                
                foreach($movieList as $movie)
                {
                    $genres = $movie->getGenres();

                    foreach($genres as $genre)
                    {
                        $query = "INSERT INTO mxg (idMovie, idGenero) VALUES (:idMovie, :idGenero);";

                        $parameters['idMovie'] = $movie->getId();
                        $parameters['idGenero'] = $genre;

                        $this->connection = Connection::GetInstance();

                        $this->connection->ExecuteNonQuery($query, $parameters);
                    }
                }

                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
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
                $movieList = array();
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
                    $movie->setPoster($fila["poster"]);

                    array_push($movieList, $movie);
                }

                return $movieList;                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByGenre($id)
        {
            try{

            
                $query = "SELECT m.*, g.genero FROM movies m LEFT JOIN mxg mg ON m.idMovie = mg.idMovie LEFT JOIN generos g ON mg.idGenero = g.idGenero WHERE g.idGenero = $id";
                $movieList = array();
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                    {
                        $movie = new movie();
                        $movie->setId($fila["idMovie"]);
                        $movie->setTitle($fila["titulo"]);
                        $movie->setDescription($fila["descripcion"]);
                        $movie->setRating($fila["rating"]);
                        $movie->setPoster($fila["poster"]);

                        array_push($movieList, $movie);
                    }

                    return $movieList;               
            }
            catch (Exception $ex)
            {
                throw $ex;
            }


        }
    }
?>