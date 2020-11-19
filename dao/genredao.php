<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Genre as Genre;

    class GenreDao
    {
        private $tableName = "generos";
        private $genresUrl;
        private $apiKey;

        public function __construct()
        {
            $this->genresUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key=";
            $this->apiKey = "c058df23ba034ee1884bbf9cb41ffd30";
        }

        //Trae de la API todos los generos
        private function getGenresFromAPI() 
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey . "&language=es");

            $genresArray = json_decode($json, true);

            return $genresArray['genres'];
        }

        //Crea un objeto Genre a partir de lo que llega de la API
        private function createFromApi($valuesArray)
        {
            $genre = new Genre();
            $genre->setGenreId($valuesArray["id"]);
            $genre->setGenre($valuesArray["name"]);
            return $genre;
        }

        //Inserta en la DB los generos traidos de la API
        private function insertFromApiToDb() 
        {
            $genres = $this->getGenresFromAPI();
            
            foreach($genres as $value)
            {
                $genre = $this->createFromApi($value);
                $this->add($genre);
            }
        }

        //Retorna un arreglo de objetos Genre
        private function getGenreObjects()
        {
            $genres = $this->getGenresFromAPI();

            foreach($genres as $genre){
                $resultGenres[] = $this->createFromApi($genre);
            }
            return $resultGenres;
        }

        //Hace un update en la tabla de generos
        public function update()
        {
            if($this->getAll())
            {
                $genres = $this->getGenreObjects();
                foreach($genres as $genre)
                {
                    if(!$this->exists($genre->getGenreId()))
                    {
                        $this->add($genre);
                    }
                }
            }
            else
            {
                $this->insertFromApiToDb();
            }
            return $this->getAll();
        }

        //Verifica mediante el ID si existe un genero en la BD y retorna true o false
        private function exists($id)
        {
            $genres = $this->getAll();
            $response = false;

            foreach($genres as $genre)
            {
                if($genre->getGenreId() == $id)
                {
                    $response = true;
                }
            }
            return $response;
        }

        //Guarda los generos en la BD
        private function add(Genre $genre)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (idGenero, genero) VALUES (:idGenero, :genero);";

                $parameters["idGenero"] = $genre->getGenreId();
                $parameters["genero"] = $genre->getGenre();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }
        
        //retorna todos los generos de la tabla mediante un select
        public function getAll()
        {
            try
            {
                $genreList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $genre = new genre();
                    $genre->setGenre($fila["genero"]);
                    $genre->setGenreId($fila["idGenero"]);

                    array_push($genreList, $genre);
                }

                return $genreList;                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        //Retorna un genero buscado mediante su id
        public function getGenreById($id)  
        {
            try
            {
                $query = "SELECT * FROM " . $this->tableName . " WHERE  (idGenero ='" . $id ."');";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $genre = new genre();
                $genre->setGenre($resultSet[0]["genero"]);
                $genre->setGenreId($resultSet[0]["idGenero"]);

                return $genre->getGenre();                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

    }
