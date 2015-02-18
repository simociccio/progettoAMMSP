<?php
include_once 'db.php';
include_once 'film.php';

class VideotecaFilms {

    private static $singleton;

    private function __constructor() {

    }

    /**
     * Restiuisce un singleton per creare utenti
     * @return \UserFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new VideotecaUser();
        }

        return self::$singleton;
    }

    public static function getAllFilms(){
        $mysqli = Db::getInstance()->connectDb();
        if ($stmt = $mysqli->prepare("SELECT titolo,autore,trama,prezzo,durata FROM film")){;//" WHERE user = ? AND password = ?")) {

            // Linkiamo i parametri con i placeholder (?)
            //$stmt->bind_param("ss", $_u, $_p);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $titolo = NULL;
            $autore = NULL;
            $trama = NULL;
            $prezzo = NULL;
            $durata = NULL;

            if (!$stmt->bind_result($titolo,$autore,$trama,$prezzo,$durata)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            while ($stmt->fetch()) {
                $film = new Film($titolo,$autore,$trama,$prezzo,$durata);
                $films[] = $film;
            }


        }
        return $films;
    }
}