<?php
    namespace dao;

    use models\Cinema as Cinema;

    interface ICinemaDao
    {
        function Add(Cinema $movie);
        function GetAll();
    }
?>