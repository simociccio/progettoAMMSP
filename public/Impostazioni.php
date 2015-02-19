<?php
		class Impostazioni {
		    public static $db_host = '';
		    public static $db_user = '';
		    public static $db_password = '';
		    public static $db_name='';
		    public static $app_path = '';
		    public static $nomePortale = '';
		}




switch($_SERVER['HTTP_HOST']){
    case '192.168.1.35':
        Impostazioni::$db_host = 'localhost';
        Impostazioni::$db_user = 'root';
        Impostazioni::$db_password = 'gianni';
        Impostazioni::$db_name='videoteca';
        Impostazioni::$app_path = 'http://'. $_SERVER['HTTP_HOST'] . '/progettoAMMSP/public/';
        Impostazioni::$nomePortale = "La Videotexca, dove ballano le storie";
    break;
	case 'spano.sc.unica.it':
		Impostazioni::$db_host = 'localhost';
		Impostazioni::$db_user = 'porcuSimone';
		Impostazioni::$db_password = 'leopardo519';
		Impostazioni::$db_name='amm14_porcuSimone';
		Impostazioni::$app_path = 'http://'. $_SERVER['HTTP_HOST'] . '/amm2014/porcuSimone/public/';
		Impostazioni::$nomePortale = "La Videotecca, dove ballano le storie";
	break;

	case 'localhost':
		Impostazioni::$db_host = 'localhost';
		Impostazioni::$db_user = 'root';
		Impostazioni::$db_password = '';
		Impostazioni::$db_name='videoteca';
		Impostazioni::$app_path = 'http://'. $_SERVER['HTTP_HOST'] . '/progettoAMMSP/public/';
		Impostazioni::$nomePortale = "La Videotecca, dove ballano le storie";
	break;
}