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

        //Trae de la API las peliculas que estan en cartelera y las retorna
        public function getNowPlayingMoviesFromAPI() 
        {
            $json = file_get_contents($this->nowPlayingUrl . $this->apiKey . "&language=es");

            $data = json_decode($json, true);

            $results = $data['results'];

            return $results;
        }

        //Crea un objeto Movie a partir de lo que llega de la API
        public function createMoviesFromAPI($valuesArray)
        {
            $movie = new Movie();

            $movie->setTitle($valuesArray['original_title']);
            $movie->setDescription($valuesArray['overview']);
            $movie->setRating($valuesArray['vote_average']);
            $movie->setPoster('https://image.tmdb.org/t/p/w500' . $valuesArray['poster_path']);
            $movie->setId($valuesArray['id']);
            $movie->setGenres($valuesArray['genre_ids']);                

            return $movie;
        }

        //Inserta en la DB las peliculas traidas de la API
        private function insertFromApiToDb() 
        {
            $movies = $this->getNowPlayingMoviesFromAPI();
            
            foreach($movies as $value)
            {
                $movie = $this->createMoviesFromApi($value);
                $this->add($movie);

            }
        }

        //Retorna un arreglo de objetos Movie
        private function getMovieObjects()
        {
            $movies = $this->getNowPlayingMoviesFromAPI();

            foreach($movies as $movie){
                $resultMovies[] = $this->createMoviesFromApi($movie);
            }
            return $resultMovies;
        }

        //Hace un update en la tabla de peliculas
        public function update()
        {
            if($this->getAll())
            {
                $movies = $this->getMovieObjects();
                foreach($movies as $movie)
                {       
                    if(!$this->exists($movie->getId()))
                    {
                        $this->add($movie);
                    }
                }
            }
            else
            {
                $this->insertFromApiToDb();
            }
            return $this->getAll();
        }

        //Verifica mediante el ID si existe una pelicula en la BD y retorna true o false
        private function exists($id)
        {
            $movies = $this->getAll();
            $response = false;

            foreach($movies as $movie)
            {
                if($movie->getId() == $id)
                {
                    $response = true;
                }
            }
            return $response;
        }

        //Hace un insert en la tabla de peliculas
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

        //retorna todas la peliculas de la tabla mediante un select
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

        //retorna todos los registros de la tabla mxg
        public function getMoviesXgenero()
        {
            try
            {
                $query = "SELECT * FROM mxg;"; 
                $this->connection = Connection::GetInstance();
                $resulSet = $this->connection->Execute($query);

                return $resulSet;
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        //Hace un insert en la tabla mxg
        public function insertMovieGenres()
        {
            try
            {
                $movieList = $this->getMovieObjects();                
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
            }catch (Exception $ex)
            {
                throw $ex;
            }
        }


        //retorna las peliculas de un determinado id de genero
        public function getMoviesByGenre($id)
        {
            try{
                if($this->getMoviesXgenero())
                {
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
                else{
                    $this->insertMovieGenres();
                    $this->getMoviesByGenre($id);
                }
            }catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getMovieById($id)
        {
            $movies = $this->getAll();

            foreach($movies as $movie)
            {
                $movie->getTitle();
                if($movie->getId() == $id)
                {
                    return $movie->getTitle();
                }
            }
        }

    }
