<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Sala as Sala;

    class SalaDao
    {
        private $connection;
        private $tableName = "salas";

        public function getSala($sala)
        {
            $query = 'SELECT * FROM ' . $this->tableName . ' WHERE (nombreSala="' . $sala . '");';
            
            try {
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            }

            catch (\PDOException $ex)
            {
                throw $ex;
            }

            $salita= new Sala($resultSet[0]['nombreSala'], $resultSet[0]['precioSala'], $resultSet[0]['capacidadSala'], $resultSet[0]['nombreCine']);

            return $salita;
        }

        public function getAll()
        {
            try
            {
                $salaList = array();

                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {                    
                    $sala = new Sala();
                    $sala->setName($fila["nombreSala"]);
                    $sala->setPrice($fila["precioSala"]);
                    $sala->setCapacity($fila["capacidadSala"]);
                    $sala->setCine($fila["nombreCine"]);                    

                    array_push($salaList, $sala);
                }

                return $salaList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(Sala $sala, $idName)
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET nombreSala=:name, precioSala=:price, capacidadSala=:capacity WHERE nombreSala=:id;";

                $parameters["name"] = $sala->getName();
                $parameters["price"] = $sala->getPrice();
                $parameters["capacity"] = $sala->getCapacity();                
                $parameters["id"] = $idName;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete(Sala $sala)
        {
            try
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE (nombreSala='" . $sala->getName() . "');";

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function add(Sala $sala)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (nombreSala, precioSala, capacidadSala, nombreCine) VALUES (:name, :precio, :capacidad, :cine);";

                $parameters["name"] = $sala->getName();
                $parameters["precio"] = $sala->getPrice();
                $parameters["capacidad"] = $sala->getCapacity();
                $parameters["cine"] = $sala->getCine();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }
    }


?>