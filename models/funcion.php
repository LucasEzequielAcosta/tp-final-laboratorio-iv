<?php 
    namespace models;

    class Funcion {

        private $idMovie;
        private $nombreSala;
        private $horario;
        private $fecha;
        private $idFuncion;
        private $cine;

        public function __construct($nombreSala='', $idMovie='', $horario='', $fecha='', $cine='')
        {
            $this->idMovie = $idMovie;
            $this->nombreSala = $nombreSala;
            $this->horario = $horario;
            $this->fecha = $fecha;
            $this->cine = $cine;
        }

        public function getIdMovie()
        {
            return $this->idMovie;
        }

        public function getNombreSala()
        {
            return $this->nombreSala;
        }

        public function getHorario()
        {
            return $this->horario;
        }

        public function getIdFuncion()
        {
            return $this->idFuncion;
        }

        public function getFecha()
        {
            return $this->fecha;
        }

        public function getCine()
        {
            return $this->cine;
        }

        public function setIdMovie($idMovie)
        {
            $this->idMovie = $idMovie;
        }

        public function setNombreSala($nombreSala)
        {
            $this->nombreSala = $nombreSala;
        }

        public function setHorario($horario)
        {
            $this->horario = $horario;
        }

        public function setIdFuncion($idFuncion)
        {
            $this->idFuncion = $idFuncion;
        }

        public function setFecha($fecha)
        {
            $this->fecha = $fecha;
        }

        public function setCine($cine)
        {
            $this->cine = $cine;
        }
        
    }
?>