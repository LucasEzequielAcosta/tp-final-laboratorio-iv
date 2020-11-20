<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Entrada as Entrada;

    class EntradaDao {

        private $connection;
        private $tableName = 'entradas';

        public function add(Entrada $entrada)
        {
            $operation= false;

            try
            {
                $query = "INSERT INTO " . $this->tableName . " (idFuncion, idCompra) VALUES (:idFuncion, :idCompra);";
                
                $parameters['idFuncion'] = $entrada->getFuncion();
                $parameters['idCompra'] = $entrada->getIdCompra();

                $this->connection = Connection::GetInstance();
                $operation= $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Excpetion $ex)
            {
                throw $ex;
            }

            return $operation;
        }

        public function getAll()
        {
            try{

                $entradaList = array();

                $query = "SELECT * FROM " .$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $entrada = new Entrada();
                    $entrada->setNumeroEntrada($fila['numeroEntrada']);
                    $entrada->setIdCompra($fila['idCompra']);
                    $entrada->setFuncion($fila['idFuncion']);

                    array_push($entradaList, $entrada);
                }

                return $entradaList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllDesc()
        {
            try{

                $entradaList = array();

                $query = "SELECT * FROM " .$this->tableName . " ORDER BY 'numeroEntrada' DESC;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $entrada = new Entrada();
                    $entrada->setNumeroEntrada($fila['numeroEntrada']);
                    $entrada->setIdCompra($fila['idCompra']);
                    $entrada->setFuncion($fila['idFuncion']);

                    array_push($entradaList, $entrada);
                }

                return $entradaList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }
    }