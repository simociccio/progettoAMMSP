<?php
include_once basename(__DIR__) . '/../view/descrizionePagina.php';
include_once basename(__DIR__) . '/../model/elencoFilm.php';
include_once basename(__DIR__) . '/../model/VideotecaUser.php';
include_once basename(__DIR__) . '/../model/VideotecaFilms.php';
include_once basename(__DIR__) . '/../model/utenti.php';
include_once basename(__DIR__) . '/../Impostazioni.php';

class BaseController {
    /**
     * Costruttore
     */
    public function __construct() {
        
    }


    public function invoke($subpage){
        $datiPagina = new PageDescriptor();
        
        if(isset($_SESSION["user"]) && $subpage != "logout"){
            $utente = VideotecaUser::getUserEntityFromDB($_SESSION["user"]);
            $datiPagina->setIsLogged(true);
            $datiPagina->setRole($utente->getRole());
            $datiPagina->setNomeCompleto($utente->getNomeCompleto());
            
        }
        
        
        
    	switch ($subpage) {
            case 'logout':
                // remove all session variables
                session_unset(); 
                // destroy the session 
                session_destroy();
                $datiPagina->setTitolo(Impostazioni::$nomePortale);
                $datiPagina->setSubView("base/login.php");
                break;
            
            case 'login':
                if(isset($_REQUEST["cmd"])) {
                    //l'utente sta tentando di loggare
                    $userInserito = $_REQUEST["user"];
                    $passInserito = $_REQUEST["password"];

                    if (VideotecaUser::getUserFromDB($userInserito, $passInserito)) {
                        $_SESSION["user"] = $userInserito;
                    } else {
                        $datiPagina->setErrorMessage("Utente o password errati, riprova :)");
                        $datiPagina->setTitolo(Impostazioni::$nomePortale);
                        $datiPagina->setSubView("base/login.php");
                    }
                }


                if(isset($_SESSION["user"])) {// la sessione è settata
                    $utente = VideotecaUser::getUserEntityFromDB($_SESSION["user"]);
                    $datiPagina->setIsLogged(true);
                    $datiPagina->setRole($utente->getRole());
                    $datiPagina->setNomeCompleto($utente->getNomeCompleto());
                    if($utente->getRole() == 0) {
                        $films = VideotecaFilms::getAllFilms();
                        $datiPagina->setSubView("base/base.php");
                    } else {
                        $datiPagina->setSubView("amministratore/anagrafica.php");
                    }
                }

                else if(!isset($_REQUEST["cmd"])){
                    $datiPagina->setTitolo(Impostazioni::$nomePortale);
                    $datiPagina->setErrorMessage("Inserisci i tuoi dati:");
                    $datiPagina->setSubView("base/login.php");
                    }


                break;

            case 'listaFilm':

                $datiPagina->setTitolo("lista di tutti i film");
                
                $asd = new elencoFilm();
                $films = $asd->getFilms();

                $datiPagina->setSubView("film/listaFilm.php");
            break;

            case 'acquisto':
                $datiPagina->setTitolo("acquisto effetuato");
                $datiPagina->setSubView("film/acquisto.php");

                break;

            case 'anagrafica':
                $datiPagina->setTitolo("pannello controllo");
                $datiPagina->setSubView("amministratore/anagrafica.php");

                break;
    		
    		default:
	    		$datiPagina->setTitolo("index home");
	    		$datiPagina->setSubView("base/index.php");
    			break;
    	}
        require basename(__DIR__) . '/../view/master.php';

    }

    public function login($u,$p){

    }
}
?>