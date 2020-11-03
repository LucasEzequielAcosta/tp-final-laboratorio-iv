<?php
    namespace models;

    class Movie {

        private $title;
        private $genre;
        private $description;
        private $rating;
        private $poster;
        private $id;
        private $genres;

        public function __construct($title='', $genre='', $description='', $rating='', $poster='', $id='') {
=======
        public function __construct($title='', $description='', $rating='', $poster='', $id='', $genres= array()) {
>>>>>>> Stashed changes

            $this->title = $title;
            $this->genre = $genre;
            $this->description = $description;
            $this->rating = $rating;
            $this->poster = $poster;
            $this->id = $id;
            $this->genres = $genres;

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

        public function getPoster() {

            return $this->poster;
        }

        public function getId() {

            return $this->id;
        }

        public function getGenres() {

            return $this->genres;
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

        public function setPoster($value) {

            $this->poster = $value;
        }

        public function setId($value) {

            $this->id = $value;
        }

        public function setGenres($genres) {

            $this->genres = $genres;
        }
    }
?>