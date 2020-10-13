<?php
    namespace dao;

    use models\Cine as Cine;

    interface ICineDao
    {
        function Add(Cine $movie);
        function Delete($name);
        function GetAll();
    }
?>