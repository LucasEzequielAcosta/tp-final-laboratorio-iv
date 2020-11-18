<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Entrada as Entrada;

    class EntradaDao {

        private $connection;
        private $tableName = 'entradas';

        private function add(Entrada $entrada)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (numeroEntrada, idFuncion, idCompra) VALUES (:numeroEntrada, :idFuncion, :idCompra);";

                $parameters['numeroEntrada'] = $entrada->getNumeroEntrada();
                $parameters['idFuncion'] = $entrada->getFuncion();
                $parameters['idCompra'] = $entrada->getIdCompra();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Excpetion $ex)
            {
                throw $ex;
            }
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
    }