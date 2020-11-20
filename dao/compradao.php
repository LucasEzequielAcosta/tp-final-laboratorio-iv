<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Compra as Compra;
    use models\User as User;

    class CompraDao {

        private $connection;
        private $tableName = 'compras';

        public function add(Compra $compra)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (descuento, fecha, total, user) VALUES (:descuento, :fecha, :total, :user);";

                $parameters['descuento'] = $compra->getDescuento();
                $parameters['fecha'] = $compra->getFechaCompra();
                $parameters['total'] = $compra->getTotalCompra();
                $parameters['user'] = $compra->getUserCompra();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getLatest()
        {
            $query = "SELECT * FROM " . $this->tableName . " ORDER BY idCompra DESC LIMIT 1;";

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
            }

            catch (\PDOException $ex)
            {
                throw $ex;
            }

            return $resultSet[0]['idCompra'];
        }

        public function checkUserPurchase(User $user) //Verifica si un usuario compro o no algo
        {
            $query = 'SELECT * FROM ' . $this->tableName . ' WHERE (user="' . $user->getUser() . '");';
            $response = false;

            try{
                $this->connection = Connection::GetInstance();
                $response = $this->connection->Execute($query);
            }

            catch (\PDOException $ex)
            {
                throw $ex;
            }

            if($response != false)
                return true;

            else
                return false;
        }

        public function getAll()
        {
            try{

                $compraList = array();

                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $compra = new Compra();
                    $compra->setUserCompra($fila['user']);
                    $compra->setIdCompra($fila['idCompra']);
                    $compra->setDescuento($fila['descuento']);
                    $compra->setFechaCompra($fila['fecha']);
                    $compra->setTotalCompra($fila['total']);

                    array_push($compraList, $compra);
                }

                return $compraList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllDesc()
        {
            try{

                $compraList = array();

                $query = "SELECT * FROM " . $this->tableName . ' ORDER BY "idCompra" DESC;';
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $compra = new Compra();
                    $compra->setUserCompra($fila['user']);
                    $compra->setIdCompra($fila['idCompra']);
                    $compra->setDescuento($fila['descuento']);
                    $compra->setFechaCompra($fila['fecha']);
                    $compra->setTotalCompra($fila['total']);

                    array_push($compraList, $compra);
                }

                return $compraList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

       
    }