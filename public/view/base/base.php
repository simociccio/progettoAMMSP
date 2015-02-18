Benvenuto! Ecco i film a nostra disposizione:<br>
<?php
//si aspetta in ingresso un array di film


foreach ($films as $film) {
    echo $film->getTitolo()." ".$film->getTrama()." <br>";
}

?>