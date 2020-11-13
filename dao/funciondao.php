<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection  as Connection;
    use models\Funcion as Funcion;

    class FuncionDao {

        private $connection;
        private $tableName = "funciones";

        public function getAll()
        {
            try
            {
                $funcionList = array();

                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $funcion = new Funcion();
                    $funcion->setIdMovie($fila['idMovie']);
                    $funcion->setIdFuncion($fila['idFuncion']);
                    $funcion->setHorario($fila['horario']);
                    $funcion->setFecha($fila['fecha']);
                    $funcion->setNombreSala($fila['nombreSala']);

                    array_push($funcionList, $funcion);
                }

                return $funcionList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(Funcion $funcion)
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET idMovie=:idMovie, horario=:horario, fecha=:fecha, nombreSala=:nombreSala WHERE idFuncion=:idFuncion;";

                $parameters['idMovie'] = $funcion->getIdMovie();
                $parameters['horario'] = $funcion->getHorario();
                $parameters['fecha'] = $funcion->getFecha();
                $parameters['nombreSala'] = $funcion->getNombreSala();
                $parameters['idFuncion'] = $funcion->getIdFuncion();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete(Funcion $funcion)
        {
            try
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE (idFuncion='" . $funcion->getIdFuncion() . "');";

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function add(Funcion $funcion)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (idMovie, horario, fecha, nombreSala) VALUES (:idMovie, :horario, :fecha, :nombreSala);";

                $parameters['idMovie'] = $funcion->getIdMovie();
                $parameters['horario'] = $funcion->getHorario();
                $parameters['fecha'] = $funcion->getFecha();
                $parameters['nombreSala'] = $funcion->getNombreSala();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }



    }