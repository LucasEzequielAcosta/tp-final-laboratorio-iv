<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Cine as Cine;

    class CineDao
    {
        private $connection;
        private $tableName = "cines";

        public function delete(Cine $cine)
        {
            try
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE (name='" . $cine->getName() . "') AND (adress='" . $cine->getAdress() . "');";

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getCapacity()
        {
            try
            {
                $cineList = $this->getAll();                               
                
                foreach ($cineList as $cine)
                {
                    $query = 'SELECT SUM(capacidadSala) as capacidad FROM salas WHERE nombreCine ="' . $cine->getName() . '";';
                    $this->connection = Connection::GetInstance();
                    $result = $this->connection->Execute($query);                    
                    $capacityArray[$cine->getName()] = $result[0]['capacidad'];                    
                }

                
                return $capacityArray;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(Cine $cine, $idName)
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET name=:name, adress=:adress WHERE name=:id;";

                $parameters["name"] = $cine->getName();                
                $parameters["adress"] = $cine->getAdress();                
                $parameters["id"] = $idName;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function add(Cine $cine)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (name, adress) VALUES (:name, :adress);";

                $parameters["name"] = $cine->getName();                
                $parameters["adress"] = $cine->getAdress();                

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
                $cineList = array();

                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $cine = new Cine();
                    $cine->setName($fila["name"]);                    
                    $cine->setAdress($fila["adress"]);                    

                    array_push($cineList, $cine);
                }

                return $cineList;                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }

        }              
    }
?>