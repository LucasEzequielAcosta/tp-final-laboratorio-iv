<?php
    namespace models;

    class Movie {

        public $title;
        public $genre;
        public $description;
        public $rating;

        public function __construct($title='', $genre='', $description='', $rating='') {

            $this->title = $title;
            $this->genre = $genre;
            $this->description = $description;
            $this->rating = $rating;
        }

        public function getTitle() {

            return $this->title;
        }

        public function getGenre() {

            return $this->genre;
        }

        public function getDescription() {

            return $this->description;
        }

        public function getRating() {

            return $this->rating;
        }

        public function setTitle($value) {

            $this->title = $value;
        }

        public function setGenre($value) {

            $this->genre = $value;
        }

        public function setDescription($value) {

            $this->description = $value;
        }

        public function setRating($value) {

            $this->rating = $value;
        }
    }
?>