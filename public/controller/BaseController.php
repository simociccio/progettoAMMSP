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
            $utente = VideotecaUser::getInstance()->getUserEntityFromDB($_SESSION["user"]);
            $datiPagina->setIsLogged(true);
            $datiPagina->setRole($utente->getRole());
            $datiPagina->setNomeCompleto($utente->getNomeCompleto());
        }
        
        
        
    	switch ($subpage) {
            case '404':
                $datiPagina->setTitolo(Impostazioni::$nomePortale);
                $datiPagina->setErrorMessage("404 non trovato");
                $datiPagina->setSubView("base/empty.php");
                break;
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

                    if (VideotecaUser::getInstance()->getUserFromDB($userInserito, $passInserito)) {
                        $_SESSION["user"] = $userInserito;
                    } else {
                        $datiPagina->setErrorMessage("Utente o password errati, riprova :)");
                        $datiPagina->setTitolo(Impostazioni::$nomePortale);
                        $datiPagina->setSubView("base/login.php");
                    }
                }


                if(isset($_SESSION["user"])) {// la sessione è settata
                    $utente = VideotecaUser::getInstance()->getUserEntityFromDB($_SESSION["user"]);
                    $datiPagina->setIsLogged(true);
                    $datiPagina->setRole($utente->getRole());
                    $datiPagina->setNomeCompleto($utente->getNomeCompleto());
                    if($utente->getRole() == 0) {
                        $datiPagina->setTitolo(Impostazioni::$nomePortale);
                        $films = VideotecaFilms::getInstance()->getAllFilms();
                        $datiPagina->setSubView("film/base.php");
                    } else {
                        $datiPagina->setTitolo(Impostazioni::$nomePortale);
                        $datiPagina->setSubView("amministratore/base.php");
                    }
                }

                else if(!isset($_REQUEST["cmd"])){
                    $datiPagina->setTitolo(Impostazioni::$nomePortale);
                    $datiPagina->setErrorMessage("Inserisci i tuoi dati:");
                    $datiPagina->setSubView("base/login.php");
                    }


                break;

            case 'acquisto':
                $datiPagina->setTitolo("acquisto effetuato");
                $datiPagina->setSubView("film/acquisto.php");
                break;
    	}
        require basename(__DIR__) . '/../view/master.php';

    }


}
?>