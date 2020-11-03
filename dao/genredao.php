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

<<<<<<< Updated upstream
        public function verify(Genre $genre)
        {
            $genreList = array();
            $response = true;
            foreach($genreList as $_genre)
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

=======
        

        //Guarda los generos en la BD
>>>>>>> Stashed changes
        public function add(Genre $genre)
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
<<<<<<< Updated upstream
    }
=======
    



        public function getGenresFromAPI() 
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey);

            $genresArray = json_decode($json, true);

            return $genresArray['genres'];
        }

        public function insertFromApiToDb() 
        {
            $json = file_get_contents($this->genresUrl . $this->apiKey);
            $arrayToDecode = ($json) ? json_decode($json,true) : array();
            
            foreach($arrayToDecode['genres'] as $value):
                $genre = $this->createFromApi($value);
                $this->add($genre);
            endforeach;	
        }

        public function createFromApi($valuesArray)
        {
            $genre = new Genre();
            $genre->setGenreId($valuesArray["id"]); 
            $genre->setGenre($valuesArray["name"]);
            return $genre;
        }
    }

>>>>>>> Stashed changes
?>