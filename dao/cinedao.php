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

        public function modify(Cine $cine, $idName)
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET name=:name, capacity=:capacity, adress=:adress, price=:price WHERE name=:id;";

                $parameters["name"] = $cine->getName();
                $parameters["capacity"] = $cine->getCapacity();
                $parameters["adress"] = $cine->getAdress();
                $parameters["price"] = $cine->getPrice();
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
                $query = "INSERT INTO " . $this->tableName . " (name, capacity, adress, price) VALUES (:name, :capacity, :adress, :price);";

                $parameters["name"] = $cine->getName();
                $parameters["capacity"] = $cine->getCapacity();
                $parameters["adress"] = $cine->getAdress();
                $parameters["price"] = $cine->getPrice();

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
                    $cine->setCapacity($fila["capacity"]);
                    $cine->setAdress($fila["adress"]);
                    $cine->setPrice($fila["price"]);

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