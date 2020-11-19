<?php
    namespace models;

    class CuentaCredito {

        private $idEmpresa;
        private $nombreEmpresa;

        public function __construct($idEmpresa='', $nombreEmpresa='')
        {
            $this->idEmpresa = $idEmpresa;
            $this->nombreEmpresa = $nombreEmpresa;
        }



        public function getIdEmpresa()
        {
            return $this->idEmpresa;
        }

        public function getNombre()
        {
            return $this->nombreEmpresa;
        }


        public function setIdEmpresa($idEmpresa)
        {
            $this->idEmpresa = $idEmpresa;
        }

        public function setNombre($nombreEmpresa)
        {
            $this->nombreEmpresa = $nombreEmpresa;
        }
    }