<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// Includo tutti i controller
include_once 'controller/BaseController.php';
include_once 'controller/AmmController.php';
include_once 'controller/UserController.php';

date_default_timezone_set('Europe/Rome');

// Avviamo la sessione
session_start();

if(isset($_REQUEST["page"])){
   if(!isset($_SESSION["user"]) && $_REQUEST["page"] != "login") exit("DEVI ESSERE LOGGATO");

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

        case 'ordina':
            $controller = new UserController();
            $controller->invoke("ordina");
            break;

        case 'cronologia':
            $controller = new UserController();
            $controller->invoke("cronologia");
            break;

        case 'ordini':
            $controller = new AmmController();
            $controller->invoke("ordini");
            break;

        case 'catalogo':
            $controller = new AmmController();
            $controller->invoke("catalogo");
            break;

        case 'ajax':
            $controller = new AmmController();
            $controller->invoke("ajax");
            break;

        default:
            $controller = new BaseController();
            $controller->invoke("404");
        break;

    }

} else {
        $controller = new BaseController();
		$controller->invoke("login");
        }
?>