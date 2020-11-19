<?php
    namespace models;

    class Entrada {

        private $nroEntrada;        
        private $idFuncion;
        private $idCompra;

        public function __construct($idCompra='', $nroEntrada='', $idFuncion='') {

            $this->nroEntrada = $nroEntrada;           
            $this->idFuncion = $idFuncion;
            $this->idCompra = $idCompra;
        }


        public function getNumeroEntrada() {

            return $this->nroEntrada;
        }
        
        public function getIdCompra() {

            return $this->idCompra;
        }

        public function getFuncion() {

            return $this->idFuncion;
        }


        public function setNumeroEntrada($nroEntrada) {

            $this->nroEntrada = $nroEntrada;
        }
        
        public function setIdCompra($idCompra) {

            $this->idCompra = $idCompra;
        }

        public function setFuncion($idFuncion) {

            $this->idFuncion = $idFuncion;
        }
    }
?>