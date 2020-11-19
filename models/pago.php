<?php
    namespace models;

    class Pago {

        private $cod_aut;
        private $idCompra;
        private $fecha;
        private $total;
        private $idEmpresa;



        public function __construct($cod_aut='', $idCompra='', $fecha='', $total='', $idEmpresa='') {

            $this->cod_aut = $cod_aut;
            $this->idCompra = $idCompra;
            $this->fecha = $fecha;
            $this->total = $total;
            $this->idEmpresa = $idEmpresa;
        }


        public function getCodAut()
        {
            return $this->cod_aut;
        }

        public function getIdCompra()
        {
            return $this->idCompra;
        }

        public function getFechaPago()
        {
            return $this->fecha;
        }

        public function getTotalPago()
        {
            return $this->total;
        }

        public function getIdEmpresa()
        {
            return $this->idEmpresa;
        }


        public function setCodAut($cod_aut)
        {
            $this->cod_aut = $cod_aut;
        }

        public function setIdCompra($idCompra)
        {
            $this->idCompra = $idCompra;
        }

        public function setFechaPago($fecha)
        {
            $this->fecha = $fecha;
        }

        public function setTotalPago($total)
        {
            $this->total = $total;
        }

        public function setIdEmpresa($idEmpresa)
        {
            $this->idEmpresa = $idEmpresa;
        }
    }

    ?>