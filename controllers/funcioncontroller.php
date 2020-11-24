<?php

namespace controllers;

use dao\FuncionDao as FuncionDao;
use dao\SalaDao as SalaDao;
use dao\MovieDao as MovieDao;
use dao\CineDao as CineDao;
use dao\GenreDao as GenreDao;
use models\Funcion as Funcion;

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

    public function showFunctionView($message = '')
    {
        session_start();

        $msj = $message;
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

    public function verifyDate($date, $idMovie, $nombreSala, $cine)
    {
        $message = '';
        $funcionList = $this->funcionDao->getAll(); //traigo las funciones ya cargadas

        foreach ($funcionList as $funcion) { //Recorro las funciones ya cargadas para comparar con los parametros que llegan
            if ($funcion->getFecha() == $date) { // Comparo si tienen la misma fecha
                if ($funcion->getIdMovie() == $idMovie) { //comparo si es la misma pelicula
                    if ($funcion->getCine() == $cine) { // comparo si es el mismo cine
                        if ($funcion->getNombreSala() != $nombreSala) { //verifico si es la misma sala
                            return $message  = "En un mismo dia, la misma pelicula no puede ser reproducida en más de una sala del mismo cine."; //si no es la misma sala retorno mensaje de error
                        }
                    } else {
                        return $message = "Una misma película solo puede ser proyectada en un único cine por día"; // si es distinto cine retorno mensaje de error
                    }
                }
            }
        }
        return $message;
    }

    public function higherHour($hour, $idMovie)
    {
        $movie = $this->movieDao->getMovieById($idMovie);
        $runtime = $movie->getRuntime();

        $horaMayor = strtotime('+0 hour', strtotime($hour));
        $horaMayor = strtotime('+15 minute', $horaMayor);
        $horaMayor = strtotime('+'.$runtime. ' minute', $horaMayor);
        $horaMayor = date('H:i:s', $horaMayor);
        
        

        return $horaMayor;
    }

    public function lowerHour($hour, $idMovie)
    {
        $movie = $this->movieDao->getMovieById($idMovie);
        $runtime = $movie->getRuntime();

        $horaMenor = strtotime('+0 hour', strtotime($hour));
        $horaMenor = strtotime('-15 minute', $horaMenor);
        $horaMenor = strtotime('-'.$runtime. ' minute', $horaMenor);
        $horaMenor = date('H:i:s', $horaMenor);

        

        return $horaMenor;
    }

    public function sumarRuntime($hour, $idMovie)
    {
        $movie = $this->movieDao->getMovieById($idMovie);
        $runtime = $movie->getRuntime();

        $horario = strtotime('+0 hour', strtotime($hour));
        $horario = strtotime('+'.$runtime. ' minute', $horario);
        $horario = date('H:i:s', $horario);


        
        return $horario;
    }

    public function getHorarioFinal($funcion)
    {
        $movie = $this->movieDao->getMovieById($funcion->getIdMovie());
        $runtime = $movie->getRuntime();

        $horarioFinal = strtotime('+0 hour', strtotime($funcion->getHorario()));
        $horarioFinal = strtotime('+'.$runtime. ' minute', $horarioFinal);
        $horarioFinal = date('H:i:s', $horarioFinal);

        return $horarioFinal;
    }

    public function verifyTime($time, $date, $nombreSala, $cine, $idMovie)
    {
        $message = '';
        $funcionList = $this->funcionDao->getAll();

        $time = $this->sumarRuntime($time, $idMovie);

        foreach ($funcionList as $funcion) {
            if ($funcion->getFecha() == $date) {
                if ($funcion->getCine() == $cine) {
                    if ($funcion->getNombreSala() == $nombreSala) {
                        $horarioFinal = $this->getHorarioFinal($funcion);
                        
                        if ($horarioFinal < $time) {
                            if ($this->higherHour($horarioFinal, $funcion->getIdMovie()) > $time) {
                                return $message = "La funcion debe empezar 15 minutos despues de las demas funciones de esta sala";
                            }
                        } else {
                            if ($this->lowerHour($horarioFinal, $funcion->getIdMovie()) < $time) {
                                return $message = "La funcion debe empezar 15 minutos despues de las demas funciones de esta sala";
                            }
                        }
                    }
                }
            }
        }
        return $message;
    }

    public function addMovieShow($date, $time, $idMovie, $cine, $nombreSala)
    {
        $message = $this->verifyDate($date, $idMovie, $nombreSala, $cine) . "" . $this->verifyTime($time, $date, $nombreSala, $cine, $idMovie);
        if ($message == '') {
            $funcion = new Funcion($nombreSala, $idMovie, $time, $date, $cine);
            $this->funcionDao->add($funcion);
            $message = "Agregado correctamente";
            $this->showFunctionView($message);
        } else {
            $this->showFunctionView($message);
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
                
                $message='';
                require_once(VIEWS_PATH . "cartelera.php");
            } else {
                $message= 'No hay Peliculas del genero ' . $this->genreDao->getGenreById($genreId);
                require_once(VIEWS_PATH . "cartelera.php");                
            }
        } else {
            $message='';
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
            $message='';
            require_once(VIEWS_PATH . "cartelera.php");
        } else {
            $message= 'No hay funciones en la fecha ' . $date;
            require_once(VIEWS_PATH . "cartelera.php");
        }
    }
}
