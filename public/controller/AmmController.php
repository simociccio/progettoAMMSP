<?php
include_once basename(__DIR__) . '/../view/descrizionePagina.php';
include_once basename(__DIR__) . '/../model/elencoFilm.php';
include_once basename(__DIR__) . '/../model/VideotecaUser.php';
class AmmController {
    public function invoke($subpage){
        $datiPagina = new PageDescriptor();
        switch ($subpage) {

            case 'insert_film':
                $datiPagina->setTitolo("insert page");
                $datiPagina->setSubView("amministratore/insert_film.php");
                break;

            default:
                $datiPagina->setTitolo("index home");
                $datiPagina->setSubView("base/index.php");
                break;
        }
        require basename(__DIR__) . '/../view/master.php';

    }
}