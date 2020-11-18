<?php
    namespace models;

    class Compra {

        private $idCompra;
        private $entradas;
        private $descuento;
        private $fecha;
        private $total;
        private $user;



        public function __construct($user='', $idCompra='', $entradas=array(), $descuento='', $fecha='', $total='') {

            $this->user = $user;
            $this->idCompra = $idCompra;
            $this->entradas = $entradas;
            $this->descuento = $descuento;
            $this->fecha = $fecha;
            $this->total = $total;
        }


        public function getIdCompra()
        {
            return $this->idCompra;
        }

        public function getEntradas()
        {
            return $this->entradas;
        }

        public function getDescuento()
        {
            return $this->descuento;
        }

        public function getFechaCompra()
        {
            return $this->fecha;
        }

        public function getTotalCompra()
        {
            return $this->total;
        }

        public function getUserCompra()
        {
            return $this->user;
        }


        public function setUserCompra($user)
        {
            $this->user = $user;
        }

        public function setIdCompra($idCompra)
        {
            $this->idCompra = $idCompra;
        }

        public function setEntradas($entradas)
        {
            $this->entradas = $entradas;
        }

        public function setDescuento($descuento)
        {
            $this->descuento = $descuento;
        }

        public function setFechaCompra($fecha)
        {
            $this->fecha = $fecha;
        }

        public function setTotalCompra($total)
        {
            $this->total = $total;
        }
    }
?>