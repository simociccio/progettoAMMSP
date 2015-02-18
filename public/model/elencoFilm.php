<?php
include_once 'film.php';

class elencoFilm {
	public static function getFilmFromDB($_t){
        $mysqli = new mysqli("localhost", "root", "", "videoteca");

        if ($stmt = $mysqli->prepare("SELECT titolo FROM film WHERE titolo = ?")) {

            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("s",$_t);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $risposta_t = NULL;
            
            if (!$stmt->bind_result($risposta_t)) {
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
    
    
   public static function getEntityFilmFromDB($_t){
        $mysqli = new mysqli("localhost", "root", "", "videoteca");

        if ($stmt = $mysqli->prepare("SELECT titolo FROM film WHERE titolo = ?")) {

            // Linkiamo i parametri con i placeholder (?)
            $stmt->bind_param("s",$_t);

            // Eseguiamo la query
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Linkiamo i risultati su delle variabili
            $risposta_t = NULL;
            
            if (!$stmt->bind_result($risposta_t)) {
                echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Recupero le righe una alla volta
            if($stmt->fetch()) {
                $stmt->close(); // Ho finito di elaborare dati, chiudo lo statement
                $var = new Titolo($risposta_t);
                return $var;
            }
            else 
            {
                $stmt->close(); // Ho finito di elaborare dati, chiudo lo statement
                return false;
            }

        
            
            
        }
    }
}
?>