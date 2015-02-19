Benvenuto! Ecco i film a nostra disposizione:<br>
<div id="films-container">
<?php
//si aspetta in ingresso un array di film


foreach ($films as $film) {
    ?>
    <div class="films-one">
        <div class="films-title"><?= $film->getTitolo(); ?></div>
        <div class="films-dxsx">
        <div class="films-sx">
            <strong>Autore: </strong><?= $film->getAutore(); ?><br>
            <strong>Prezzo: </strong><?= $film->getPrezzo(); ?>€<br>
            <strong>Durata: </strong><?= $film->getDurata(); ?>min.<br>

            <strong>Quantità: </strong><?php

            if($film->getQuantita() == 0){
                echo "Esaurito";

            } else
            {
                echo $film->getQuantita();
            }


            ?><br>
        </div>
        <div class="films-dx"><strong>Trama: </strong><br><?= $film->getTrama(); ?><br><br>

            <?php

            if($film->getQuantita() == 0){
                echo "";

            } else
            {
                echo "<a href='ordina/".$film->getID()."'>Acquista!</a>";
            }


            ?>
        </div>

        </div>
    </div>
    <?php
}

?>
</div>