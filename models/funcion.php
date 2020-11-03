<?php 
    namespace models;

    class Funcion {

        private $idMovie;
        private $nombreSala;
        private $horario;
        private $idFuncion;

        public function __construct($idMovie='', $nombreSala='', $horario='', $idFuncion='')
        {
            $this->idFuncion = $idFuncion;
            $this->idMovie = $idMovie;
            $this->nombreSala = $nombreSala;
            $this->horario = $horario;
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
        
    }
?>