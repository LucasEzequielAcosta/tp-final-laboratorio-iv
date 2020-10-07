<?php
    namespace models;

    class Movie {

        private $tittle;
        private $genre;
        private $duration;
        private $description;
        private $rating;

        public function __contruct($tittle='', $genre='', $durantion='', $description='', $rating='') {

            $this->tittle = $tittle;
            $this->genre = $genre;
            $this->duration = $durantion;
            $this->description = $description;
            $this->rating = $rating;
        }

        public function getTittle() {

            return $this->tittle;
        }

        public function getGenre() {

            return $this->genre;
        }

        public function getDuration() {

            return $this->duration;
        }

        public function getDescrition() {

            return $this->description;
        }

        public function getRating() {

            return $this->rating;
        }

        public function setTittle($value) {

            $this->tittle = $value;
        }

        public function setGenre($value) {

            $this->genre = $value;
        }

        public function setDuration($value) {

            $this->duration = $value;
        }

        public function setDescription($value) {

            $this->description = $value;
        }

        public function setRating($value) {

            $this->rating = $value;
        }
    }
?>