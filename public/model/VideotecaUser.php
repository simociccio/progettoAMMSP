<?php
include_once 'db.php';
include_once 'utenti.php';


class VideotecaUser {

    private static $singleton;

    private function __constructor() {

    }

    public static function getInstance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new VideotecaUser();
        }

        return self::$singleton;
    }


	public function getUserFromDB($_u,$_p){

        $mysqli = Db::getInstance()->connectDb();

        if ($stmt = $mysqli->prepare("SELECT user,password FROM utenti WHERE user = ? AND password = ?")) {

            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("ss", $_u, $_p);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $risposta_u = NULL;
            $risposta_p = NULL;
            if (!$stmt->bind_result($risposta_u, $risposta_p)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            if($stmt->fetch()) {
                $stmt->close(); // Ho finito di elaborare dati, chiudo lo statement
                return true;
            }
            else 
            {
                $stmt->close(); // Ho finito di elaborare dati, chiudo lo statement
                return false;
            }

        
            
            
        }
    }
    
    public function getUserEntityFromDB($_u){
        $mysqli = Db::getInstance()->connectDb();

        if ($stmt = $mysqli->prepare("SELECT id,user,permessi,nome FROM utenti WHERE user = ?")) {
            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("s", $_u);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $risposta_id = NULL;
            $risposta_u = NULL;
            $risposta_r = NULL;
            $risposta_nc = NULL;
            if (!$stmt->bind_result($risposta_id,$risposta_u, $risposta_r,$risposta_nc)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            if($stmt->fetch()) {
                $stmt->close(); // Ho finito di elaborare dati, chiudo lo statement
                $var = new User($risposta_id,$risposta_u, $risposta_r, $risposta_nc);
                return $var;
            }
            else 
            {
                $stmt->close(); // Ho finito di elaborare dati, chiudo lo statement
                return false;
            }

        
            
            
        } else {
            echo "prepare steteman failed";
        }
    }
}
?>