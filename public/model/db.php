<?php
include_once basename(__DIR__) . '/../Impostazioni.php';

class Db {
    //put your code here

    private function __construct() {

    }

    private static $singleton;
    /**
     *  Restituisce un singleton per la connessione al Db
     * @return \Db
     */
    public static function getInstance(){
        if(!isset(self::$singleton)){
            self::$singleton = new Db();
        }

        return self::$singleton;
    }

    /**
     * Restituisce una connessione funzionante al db
     * @return \mysqli una connessione funzionante al db dell'applicazione,
     * null in caso di errore
     */
    public function connectDb(){
        $mysqli = new mysqli();
        $mysqli->connect(Impostazioni::$db_host, Impostazioni::$db_user, Impostazioni::$db_password, Impostazioni::$db_name);
        if($mysqli->errno != 0){
            return null;
        }else{
            $mysqli->set_charset("utf8");
            return $mysqli;
        }
    }
}

?>
