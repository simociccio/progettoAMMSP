<?php
include_once basename(__DIR__) . '/../view/descrizionePagina.php';
include_once basename(__DIR__) . '/../model/elencoFilm.php';
include_once basename(__DIR__) . '/../model/VideotecaUser.php';
include_once basename(__DIR__) . '/../model/VideotecaVendite.php';

class UserController {
    public function invoke($subpage){

        if(!isset($_SESSION["user"])){
            exit("DEVI ESSERE LOGGATO");
        }

        $datiPagina = new PageDescriptor();
        $utente = VideotecaUser::getInstance()->getUserEntityFromDB($_SESSION["user"]);
        $datiPagina->setIsLogged(true);
        $datiPagina->setRole($utente->getRole());
        $datiPagina->setNomeCompleto($utente->getNomeCompleto());

        switch ($subpage) {

            case 'ordina':
                if(isset($_REQUEST["cmd"])) {
                    $idU = $utente->getID();
                    $idF = $_REQUEST["film"];
                   if(VideotecaVendite::getInstance()->acquisto($idU,$idF)){
                       $datiPagina->setTitolo(Impostazioni::$nomePortale);
                       $datiPagina->setErrorMessage("ACQUISTATO!");
                       $datiPagina->setSubView("base/empty.php");
                   }
                    else{
                        $datiPagina->setTitolo(Impostazioni::$nomePortale);
                        $datiPagina->setErrorMessage("ERRORE!");
                        $datiPagina->setSubView("base/empty.php");
                    }
                }
                else {
                    $datiPagina->setTitolo("Acquisto");

                    $datiPagina->setTitolo(Impostazioni::$nomePortale);
                    $films = VideotecaFilms::getInstance()->getFilmByID($_REQUEST["subpage"]);
                    $datiPagina->setSubView("film/acquisto.php");
                }
                break;

            case 'cronologia':
                $datiPagina->setTitolo(Impostazioni::$nomePortale);

                if($acquisti = VideotecaVendite::getInstance()->getAcquistiByUserID($utente->getID())) {
                    $datiPagina->setSubView("film/acquisti.php");
                }
                else{
                    $datiPagina->setErrorMessage("Non sono presenti film acquistati!");
                    $datiPagina->setSubView("base/empty.php");
                }
                break;
        }
        require basename(__DIR__) . '/../view/master.php';

    }
}
