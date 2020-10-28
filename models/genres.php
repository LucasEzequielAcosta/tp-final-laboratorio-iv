<?php
    namespace models;

    class Genre {

        private $genre;
        private $id;

        function __construct($genre='')
        {
            $this->genre = $genre;
        }

        function getGenre() {
            return $this->genre;
        }

        function getGenreId() {
            return $this->id;
        }

        function setGenre($value){
            $this->genre = $value;
        }

        function setGenreId($value){
            $this->id = $value;
        }
}