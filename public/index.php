<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


include_once 'controller/BaseController.php';
include_once 'controller/AmmController.php';

// Avviamo la sessione
session_start();

if(isset($_REQUEST["page"])){
   // if(!isset($_SESSION["user"]) && $_REQUEST["page"] != "form-login") exit("DEVI ESSERE LOGGATO");

    
$sp = $_REQUEST["subpage"];
	switch ($_REQUEST["page"]) {
            		case 'logout':
			$controller = new BaseController();
			$controller->invoke("logout");
			break;
		case 'login':
			$controller = new BaseController();
			$controller->invoke("login");
			break;

		case 'film':
			$controller = new BaseController();
			$controller->invoke("listaFilm");
			break;

		case 'acquisto':
			$controller = new BaseController();
			$controller->invoke("acquisto");
			break;
		
		case 'amministratore':
			$controller = new AmmController();
			$controller->invoke($sp);
			break;

		case 'anagrafica':
			$controller = new BaseController();
			$controller->invoke("anagrafica");
			break;

	}

} else {
        $controller = new BaseController();
		$controller->invoke("login");
        }

?>