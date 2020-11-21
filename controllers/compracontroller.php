<?php

namespace controllers;

use dao\CompraDao as CompraDao;
use models\Compra as Compra;
use dao\FuncionDao as FuncionDao;
use models\Funcion as Funcion;
use models\Entrada as Entrada;
use dao\EntradaDao as EntradaDao;
use dao\SalaDao as SalaDao;
use models\Sala as Sala;
use models\User as User;
use models\Movie as Movie;
use dao\MovieDao as MovieDao;
use models\Cine as Cine;
use dao\CineDao as CineDao;
use controllers\HomeController as HomeController;

class compraController
{

    private $compraDao;
    private $funcionDao;
    private $entradaDao;
    private $salaDao;
    private $homeCon;
    private $movieDao;
    private $cineDao;

    public function __construct()
    {

        $this->compraDao = new CompraDao();
        $this->funcionDao = new FuncionDao();
        $this->entradaDao = new EntradaDao();
        $this->salaDao = new SalaDao();
        $this->homeCon = new HomeController();
        $this->movieDao = new MovieDao();
        $this->cineDao = new CineDao();
    }

    public function buyView($movie, $idFunc, $message = '')
    {
        session_start();

        $movieName = $movie;
        $idFuncion = $idFunc;

        $funcionList = $this->funcionDao->getAll();
        $salaList = $this->salaDao->getAll();

        require_once(VIEWS_PATH . 'compra.php');
    }

    public function confirmBuy($_movie, $_idFunc, $_total)
    {
        session_start();

        $user = new User();
        $user = $_SESSION['loggedUser'];
        $today = date("Y-n-d");

        $compra = new Compra();
        $compra->setFechaCompra($today);
        $compra->setUserCompra($user->getUser());
        $compra->setDescuento(0);
        $compra->setTotalCompra($_total);

        $entrada = new Entrada();
        $entrada->setFuncion($_idFunc);

        //$operation;

        try {
            $this->compraDao->add($compra);

            $entrada->setIdCompra($this->compraDao->getLatest());
            $operation = $this->entradaDao->add($entrada);
        } catch (\PDOException $ex) {
            $message = 'Error en la Base de Datos!';
            $this->buyView($_movie, $_idFunc, $message);
        }

        if ($operation) {
            $message = 'Compra registrada con éxito!';
            $this->homeCon->homeUser($message);
        }
    }

    public function checkSales($message = '')
    {
        session_start();

        try {
            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            $compraList = $this->compraDao->getAll();
            $entradaList = $this->entradaDao->getAllDesc();
            $movieList = $this->movieDao->getAll();
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'ventas.php');
        }


        require_once(VIEWS_PATH . 'ventas.php');
    }

    public function checkSalesByCinema($message = '')
    {
        session_start();

        try {
            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            $compraList = $this->compraDao->getAll();
            $entradaList = $this->entradaDao->getAllDesc();
            $movieList = $this->movieDao->getAll();
            $cineList = $this->cineDao->getAll();
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'ventas-cines.php');
        }

        require_once(VIEWS_PATH . 'ventas-cines.php');
    }

    public function checkSalesByMovie($message = '')
    {
        session_start();

        try {
            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            $compraList = $this->compraDao->getAll();
            $entradaList = $this->entradaDao->getAllDesc();
            $movieList = $this->movieDao->getAll();
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'ventas-peliculas.php');
        }

        require_once(VIEWS_PATH . 'ventas-peliculas.php');
    }

    public function checkSalesByShow($message = '')
    {
        session_start();

        try {
            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            $compraList = $this->compraDao->getAll();
            $entradaList = $this->entradaDao->getAllDesc();
            $movieList = $this->movieDao->getAll();
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'ventas-funciones.php');
        }

        require_once(VIEWS_PATH . 'ventas-funciones.php');
    }

    public function checkSalesByDate($message = '', $total='')
    {
        session_start();

        $max = date("Y-n-d");
        $min = $this->minDate();

        try {
            $funcionList = $this->funcionDao->getAll();
            $salaList = $this->salaDao->getAll();
            $compraList = $this->compraDao->getAll();
            $entradaList = $this->entradaDao->getAllDesc();
            $movieList = $this->movieDao->getAll();
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'ventas-fechas.php');
        }

        require_once(VIEWS_PATH . 'ventas-fechas.php');
    }

    public function verificarRangoFechas($fechaInicio, $fechaFinal)
    {
        $fechaInicio = strtotime($fechaInicio);
        $fechaFinal = strtotime($fechaFinal);
        $compraList = $this->compraDao->getAll();
        $total = 0;

        foreach ($compraList as $compra) 
        {
            $fechaNueva = strtotime($compra->getFechaCompra());
            if (($fechaNueva >= $fechaInicio) && ($fechaNueva <= $fechaFinal)) 
            {
                $total += $compra->getTotalCompra();
            }
        }
        $this->checkSalesByDate('', $total);
    }

    public function minDate() //Traigo la lista de compras y retorno la fecha mas antigua
    {
        try {
            $compraList = $this->compraDao->getAll();
            $dates = array();

            foreach ($compraList as $compra) {
                array_push($dates, $compra->getFechaCompra());
            }
            $min = min($dates);
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'ventas-fechas.php');
        }
        return $min;
    }

    public function ticketsByUser($message = '')
    {
        session_start();

        $usuario = new User();
        $usuario = $_SESSION['loggedUser'];
        $check = $this->compraDao->checkUserPurchase($usuario);

        try {
            $funcionList = $this->funcionDao->getAll();
            $compraList = $this->compraDao->getAll();
            $entradaList = $this->entradaDao->getAllDesc();
            $movieList = $this->movieDao->getAll();
        } catch (\Exception $ex) {
            $message = "Error en la BD!";
            require_once(VIEWS_PATH . 'compras-usuario.php');
        }


        if ($check == false) {
            $message = 'Usted no posee compras realizadas.';
        }

        require_once(VIEWS_PATH . 'compras-usuario.php');
    }
}
