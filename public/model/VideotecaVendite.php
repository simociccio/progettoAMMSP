<?php
include_once 'db.php';
include_once 'film.php';
include_once 'acquisto.php';

class VideotecaVendite {

    private static $singleton;

    private function __constructor() {

    }

    public static function getInstance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new VideotecaVendite();
        }

        return self::$singleton;
    }


    public function acquisto($idU,$idF){
        $mysqli = Db::getInstance()->connectDb();

        // Disabilito l'autocommit
        $mysqli->autocommit(FALSE);

        // Controllo che il film sia disponibile
        $query = "SELECT quantita FROM film WHERE id = '$idF'";
        $result = $mysqli->query($query);
        if($row = $result->fetch_row()){
            if($row[0] > 0){
                $queryAggiornaQuantita = "UPDATE film SET quantita = quantita - 1 WHERE id = '$idF';";
                $ts = date('Y-m-d H:i:s');
                $queryInserisciAcquisto = "INSERT INTO `videoteca`.`vendite` (`id`, `idUtente`, `idFilm`, `timestamp`) VALUES (NULL, '$idU', '$idF', '$ts');";
                $result = $mysqli->query($queryAggiornaQuantita);
                $result = $mysqli->query($queryInserisciAcquisto);
            }
            else
            {
                echo "non è disponibile il film";
                return false;
            }


        }
        else
        {
            echo "non esiste il film";
            return false;
        }


        // Se tutto va bene committo
        echo "--breakpoint";
        if (!$mysqli->commit()) {
            print("Transaction commit failed\n");
            exit();
        }
        return true;
    }

    public function getAcquistiByUserID($idU){
        $mysqli = Db::getInstance()->connectDb();

        if ($stmt = $mysqli->prepare("SELECT vendite.id,vendite.idUtente,vendite.idFilm,vendite.timestamp,film.titolo FROM vendite,film WHERE idUtente = ? AND vendite.idFilm = film.id")){;

            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("s", $idU);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $id = NULL;
            $idUser = NULL;
            $idFilm = NULL;
            $timestamp = NULL;
            $titolo = NULL;

            if (!$stmt->bind_result($id,$idUser,$idFilm,$timestamp,$titolo)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            while ($stmt->fetch()) {
                $acquisto = new Acquisto($id,$idUser,$idFilm,$timestamp,$titolo);
                $acquisti[] = $acquisto;
            }
        }
        if(isset($acquisti) )
        return $acquisti; else return null;
    }

    public function getAllAcquisti(){
        $mysqli = Db::getInstance()->connectDb();

        if ($stmt = $mysqli->prepare("SELECT vendite.id,vendite.idUtente,vendite.idFilm,vendite.timestamp,film.titolo,utenti.nome FROM vendite,film,utenti WHERE vendite.idFilm = film.id AND vendite.idUtente = utenti.id")){;

            // Linkiamo i parametri con i placeholder (?)
            //$stmt->bind_param("s", $idU);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $id = NULL;
            $idUser = NULL;
            $idFilm = NULL;
            $timestamp = NULL;
            $titolo = NULL;
            $acquirente = NULL;

            if (!$stmt->bind_result($id,$idUser,$idFilm,$timestamp,$titolo,$acquirente)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            while ($stmt->fetch()) {
                $acquisto = new Acquisto($id,$idUser,$idFilm,$timestamp,$titolo);
                $acquisto->setNomeAcquirente($acquirente);
                $acquisti[] = $acquisto;
            }
        }
        if(isset($acquisti) )
            return $acquisti; else return null;
    }
}