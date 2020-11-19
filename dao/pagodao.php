<?php
    namespace dao;

    use \Exception as Exception;
    use dao\Connection as Connection;
    use models\Pago as Pago;

    class PagoDao
    {
        private $connection;
        private $tableName = 'pagos';

        public function add(Pago $pago)
        {
            try {

                $query = "INSERT INTO " . $this->tableName . " (fecha, total, idCompra, idEmpresa) VALUES (:fecha, :total, :idCompra, :idEmpresa);";

                $parameters['fecha'] = $pago->getFechaPago();
                $parameters['total'] = $pago->getTotalPago();
                $parameters['idCompra'] = $pago->getIdCompra();
                $parameters['idEmpresa'] = $pago->getIdEmpresa();

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
            try{

                $pagoList = array();

                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $fila)
                {
                    $pago = new Pago();
                    $pago->setCodAut($fila['cod_aut']);
                    $pago->setIdCompra($fila['idCompra']);
                    $pago->setFechaPago($fila['fecha']);
                    $pago->setTotalPago($fila['total']);
                    $pago->setIdEmpresa($fila['idEmpresa']);

                    array_push($pagoList, $pago);
                }

                return $pagoList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }
    }