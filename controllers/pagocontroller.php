<?php

    namespace controllers;

    use models\Pago as Pago;
    use dao\PagoDao as PagoDao;
    use controllers\CompraController as CompraController;
    use controllers\HomeController as HomeController;

    class pagoController {

        private $pagoDao;
        private $payCon;
        private $homeCon;

        public function __construct()
        {
            $this->pagoDao = new PagoDao();
            $this->payCon = new CompraController();
            $this->homeCon = new HomeController();
        }
    


        public function makePayment($userMail, $userName, $cardNum, $ccv, $prov, $_movieName, $_idFunc, $_total, $_cantidadEntradas, $message='')
        {
            session_start();

            try{
                $idCompra = $this->payCon->confirmBuy($_movieName, $_idFunc, $_total, $_cantidadEntradas);

                $pago = new Pago();
                $pago->setIdCompra($idCompra);
                $pago->setTotalPago($_total);
                $pago->setFechaPago(date("Y-n-d"));
                switch ($prov) {
                    case 'visa':
                        $pago->setIdEmpresa(1);
                        break;
                    
                    case 'master':
                        $pago->setIdEmpresa(2);
                        break;
                }
                $this->pagoDao->add($pago);                
            }

            catch(\Exception $ex)
            {
                $message= "Error en la BD!";
                $this->homeCon->homeUser($message);
            }

            $message= 'Compra realizada exitosamente!';
            $this->homeCon->homeUser($message);
            
        }
    }