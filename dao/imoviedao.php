<?php
    namespace dao;

    use models\Movie as Movie;

    interface IMovieDao
    {
        function Add(Movie $movie);
        function GetAll();
    }
?>