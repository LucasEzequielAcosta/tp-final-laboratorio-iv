<?php

	/**
	 * Mostrar errores de PHP
	 */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	/**
	 * Archivos necesarios de inicio
	 */
	require "config/autoload.php";
	require "config/config.php";

	/**
	 * Alias
	 */

	use config\Autoload as Autoload;
	use config\Router as Router;
	use config\Request as Request;

	/**
	 * Flujo de ejecución
	 */
	Autoload::start();

	//session_start();

	require_once(VIEWS_PATH."header.php");

	$request = new Request();

	Router::route($request);

	require_once(VIEWS_PATH."footer.php");

?>
