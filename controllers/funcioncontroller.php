<?php

namespace controllers;

use dao\FuncionDao as FuncionDao;
use dao\SalaDao as SalaDao;
use dao\MovieDao as MovieDao;
use dao\CineDao as CineDao;
use dao\GenreDao as GenreDao;
use models\Funcion as Funcion;
use models\Sala as Sala;
use models\Movie as Movie;

class funcionController
{

    private $funcionDao;
    private $salaDao;
    private $movieDao;
    private $cineDao;
    private $genreDao;

    public function __construct()
    {

        $this->funcionDao = new FuncionDao();
        $this->salaDao = new SalaDao();
        $this->movieDao = new MovieDao();
        $this->cineDao = new CineDao();
        $this->genreDao = new GenreDao();
    }

    public function showFunctionView($mesage='')
    {
        session_start();

        $funcionList = $this->funcionDao->getAll();
        $salaList = $this->salaDao->getAll();
        $movieList = $this->movieDao->getAll();

        require_once(VIEWS_PATH . 'admin-funcion.php');
    }

    public function delete($idFuncion)
    {
        $funcionList = $this->funcionDao->getAll();
        $funcion = new Funcion();

        foreach ($funcionList as $key) {
            if ($key->getIdFuncion() == $idFuncion) {
                $funcion = $key;
            }
        }

        $this->funcionDao->delete($funcion);

        $this->showFunctionView();
    }

    public function modify($idFuncion, $sala, $pelicula, $fecha)
    {
        $funcion = new Funcion();
        $funcion->setIdFuncion($idFuncion);
        $funcion->setNombreSala($sala);
        $funcion->setIdMovie($pelicula);
        $funcion->setHorario($fecha);

        $this->funcionDao->modify($funcion);

        usleep(550000);

        $this->showFunctionView();
    }

    public function createMovieShow($idMovie)
    {
        $salaList = $this->salaDao->getAll();
        $cineList = $this->cineDao->getAll();
        $title = $this->movieDao->getMovieById($idMovie);
        $today = date("Y-n-d");
        $max = date("Y-n-d", mktime(0, 0, 0, date("n"), date("d") + 20, date("Y")));

        require_once(VIEWS_PATH . 'create-movie-show.php');
    }

    public function verifyDate($date)
    {
        $response = true;
        $funcionList = $this->funcionDao->getAll();

        foreach($funcionList as $funcion)
        {
            if($date == $funcion->getFecha()){
                return $response  = false;
            }
        }
        return $response;
    }

    public function addMovieShow($date, $time, $idMovie, $cine, $nombreSala)
    {
        if($this->verifyDate($date))
        {
            $funcion = new Funcion($nombreSala, $idMovie, $time, $date, $cine);

            $this->funcionDao->add($funcion);

            $this->showFunctionView();
        }
        else
        {
            $mesage = "Ya existe una funcion de " .$this->movieDao->getMovieById($idMovie). " el $date";
            $this->showFunctionView($mesage);
        }

    }

    public function getFunctionsByGenre($genreId)
    {
        $today = date("Y-n-d");
        $max = date("Y-n-d", mktime(0, 0, 0, date("n"), date("d") + 20, date("Y")));
        session_start();
        $genreList = $this->genreDao->getAll();
        $funcionList = $this->funcionDao->getAll();
        if ($genreId != -1) {
            $funcionFiltered = array();
            $movieList = $this->movieDao->getMoviesByGenre($genreId);
            foreach ($movieList as $movie) {
                foreach ($funcionList as $funcion) {
                    if ($movie->getId() == $funcion->getIdMovie()) {
                        array_push($funcionFiltered, $funcion);
                    }
                }
            }
            $funcionList = $funcionFiltered;
            if ($funcionList) {
                require_once(VIEWS_PATH . "cartelera.php");
            } else {
                require_once(VIEWS_PATH . "cartelera.php");
                echo "<strong><h2 class='nav navbar justify-content-center'>No hay Peliculas del genero " . $this->genreDao->getGenreById($genreId) . "</h2></strong>";
            }
        } else {
            require_once(VIEWS_PATH . "cartelera.php");
        }
    }

    public function filterFunctionsByDate($date)
    {
        $today = date("Y-n-d");
        $max = date("Y-n-d", mktime(0, 0, 0, date("n"), date("d") + 20, date("Y")));
        session_start();
        $genreList = $this->genreDao->getAll();
        $funcionList = $this->funcionDao->getFunctionsByDate($date);

        if ($funcionList) {
            require_once(VIEWS_PATH . "cartelera.php");
        } else {
            require_once(VIEWS_PATH . "cartelera.php");
            echo "<strong><h2 class='nav navbar justify-content-center'>No hay funciones en la fecha " . $date . "</h2></strong>";
        }
    }
}
