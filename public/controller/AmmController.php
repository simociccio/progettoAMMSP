<?php
include_once basename(__DIR__) . '/../view/descrizionePagina.php';
include_once basename(__DIR__) . '/../model/elencoFilm.php';
include_once basename(__DIR__) . '/../model/VideotecaUser.php';

class AmmController {
    public function invoke($subpage){
        $datiPagina = new PageDescriptor();

        if(isset($_SESSION["user"])){
            $utente = VideotecaUser::getInstance()->getUserEntityFromDB($_SESSION["user"]);
            if($utente->getRole()==0) exit ("403");
            $datiPagina->setIsLogged(true);
            $datiPagina->setRole($utente->getRole());
            $datiPagina->setNomeCompleto($utente->getNomeCompleto());
        }


        switch ($subpage) {
            case 'ordini':
                $datiPagina->setTitolo(Impostazioni::$nomePortale);
                if($acquisti = VideotecaVendite::getInstance()->getAllAcquisti()) {
                    $datiPagina->setSubView("film/acquisti.php");
                }
                else{
                    $datiPagina->setErrorMessage("Non sono presenti ordini!");
                    $datiPagina->setSubView("base/empty.php");
                }
                $datiPagina->setSubView("amministratore/ordini.php");
                break;

            case 'catalogo':
                if(isset($_REQUEST["cmd"])){
                    $film = new Film(NULL,$_REQUEST["titolo"],$_REQUEST["autore"],$_REQUEST["trama"],$_REQUEST["prezzo"],$_REQUEST["durata"],$_REQUEST["quantita"]);
                    VideotecaFilms::getInstance()->insertFilmByInstance($film);
                }
                $datiPagina->setTitolo(Impostazioni::$nomePortale);
                $films = VideotecaFilms::getInstance()->getAllFilms();
                $datiPagina->setSubView("amministratore/catalogo.php");
                break;

            case 'ajax':
                $vendite = VideotecaVendite::getInstance()->getAllAcquisti();
                foreach($vendite as $vendita)
                {
                    $_for_json["titolo"] = $vendita->getTitolo();
                    $_for_json["acquirente"] = $vendita->getNomeAcquirente();
                    $_for_json["timestamp"] = $vendita->getTs();
                    $json_array[] = $_for_json;
                }
                echo json_encode($json_array);
                break;

        }
        if($subpage != "ajax") {
            require basename(__DIR__) . '/../view/master.php';
        }

    }
}