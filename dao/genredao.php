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

        private function getGenresFromAPI() 
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey);

            $genresArray = json_decode($json, true);

            return $genresArray['genres'];
        }

        private function createFromApi($valuesArray)
        {
            $genre = new Genre();
            $genre->setGenreId($valuesArray["id"]);
            $genre->setGenre($valuesArray["name"]);
            return $genre;
        }

        private function insertFromApiToDb() 
        {
            $genres = $this->getGenresFromAPI();
            
            foreach($genres as $value)
            {
                $genre = $this->createFromApi($value);
                $this->add($genre);
            }
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

        private function updateFromApi()
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey);
            $result = json_decode($json, true);
            $genres = $result['genres'];

            foreach($genres as $genre){
                $resultGenres[] = new Genre($genre['id'], $genre['name']);
            }
            return $resultGenres;
        }

        public function update()
        {
            if($this->getAll())
            {
                $genres = $this->updateFromApi();
                foreach($genres as $genre)
                {       
                    if(!$this->exists($genre->getGenreId()))
                    {
                        $this->add($genre);
                    }
                }
                return $this->getAll();
            }
            else
            {
                $this->insertFromApiToDb();
            }
        }

        private function exists($id)
        {
            $genres = $this->getAll();

            foreach($genres as $genre)
            {
                if($genre->getGenreId() == $id)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }

    }
