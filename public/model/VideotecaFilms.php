<?php
include_once 'db.php';
include_once 'film.php';

class VideotecaFilms {

    private static $singleton;

    private function __constructor() {

    }

    public static function getInstance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new VideotecaFilms();
        }

        return self::$singleton;
    }

    public function getAllFilms(){
        $mysqli = Db::getInstance()->connectDb();
        if ($stmt = $mysqli->prepare("SELECT id,titolo,autore,trama,prezzo,durata,quantita FROM film")){;//" WHERE user = ? AND password = ?")) {

            // Linkiamo i parametri con i placeholder (?)
            //$stmt->bind_param("ss", $_u, $_p);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $id = NULL;
            $titolo = NULL;
            $autore = NULL;
            $trama = NULL;
            $prezzo = NULL;
            $durata = NULL;
            $quantita = NULL;

            if (!$stmt->bind_result($id,$titolo,$autore,$trama,$prezzo,$durata,$quantita)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            while ($stmt->fetch()) {
                $film = new Film($id,$titolo,$autore,$trama,$prezzo,$durata,$quantita);
                $films[] = $film;
            }


        }
        return $films;
    }

    public function getFilmByID($_id){
        $mysqli = Db::getInstance()->connectDb();
        if ($stmt = $mysqli->prepare("SELECT id,titolo,autore,trama,prezzo,durata,quantita FROM film WHERE id = ?")){;//" WHERE user = ? AND password = ?")) {

            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("s", $_id);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $id = NULL;
            $titolo = NULL;
            $autore = NULL;
            $trama = NULL;
            $prezzo = NULL;
            $durata = NULL;
            $quantita = NULL;

            if (!$stmt->bind_result($id,$titolo,$autore,$trama,$prezzo,$durata,$quantita)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            while ($stmt->fetch()) {
                $film = new Film($id,$titolo,$autore,$trama,$prezzo,$durata,$quantita);
                $films[] = $film;
            }


        }
        return $films;
    }

    public function insertFilmByInstance($film){

        $mysqli = Db::getInstance()->connectDb();

        if ($stmt = $mysqli->prepare("INSERT INTO `videoteca`.`film` (`id`, `titolo`, `autore`, `durata`, `trama`, `prezzo`, `quantita`) VALUES (NULL, ?, ?, ?, ?, ?, ?)")){

            $titolo = $film->getTitolo();
            $autore = $film->getAutore();
            $trama = $film->getTrama();
            $prezzo = $film->getPrezzo();
            $durata = $film->getDurata();
            $quantita = $film->getQuantita();

            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("ssdsdi", $titolo,$autore,$durata,$trama,$prezzo,$quantita);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                return false;
            }

            $stmt->close();
            return true;


        }


    }
}