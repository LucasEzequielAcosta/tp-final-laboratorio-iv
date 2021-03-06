<?php
    namespace models;

    class Movie {

        private $title;        
        private $description;
        private $rating;
        private $poster;
        private $id;
        private $genres;
        private $runtime;

        

        public function __construct($title='', $description='', $rating='', $poster='', $id='', $runtime='', $genres= array()) {

            $this->title = $title;            
            $this->description = $description;
            $this->rating = $rating;
            $this->poster = $poster;
            $this->id = $id;
            $this->genres = $genres;
            $this->runtime = $runtime;

        }

        public function getTitle() {

            return $this->title;
        }       

        public function getDescription() {

            return $this->description;
        }

        public function getRating() {

            return $this->rating;
        }

        public function getPoster() {

            return $this->poster;
        }

        public function getId() {

            return $this->id;
        }

        public function getGenres() {

            return $this->genres;
        }

        public function getRuntime() {

            return $this->runtime;
        }

        public function setTitle($value) {

            $this->title = $value;
        }
        
        public function setDescription($value) {

            $this->description = $value;
        }

        public function setRating($value) {

            $this->rating = $value;
        }

        public function setPoster($value) {

            $this->poster = $value;
        }

        public function setId($value) {

            $this->id = $value;
        }

        public function setGenres($genres) {

            $this->genres = $genres;
        }

        public function setRuntime($value) {

            $this->runtime = $value;
        }
    }
?>