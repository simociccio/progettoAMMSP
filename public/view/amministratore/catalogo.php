<script>
    $( document ).ready(function() {
        $('#insert-film-enabler').click(function() {
            $('#insert-film').toggle();
            $('#insert-film-enabler').toggle();
        });

        $('#insert-film-disabler').click(function() {
            $('#insert-film').toggle();
            $('#insert-film-enabler').toggle();
        });

    });
</script>

<div id="insert-film-enabler">▼ CLICCA QUI PER INSERIRE UN FILM ▼</div>
<div id="insert-film">
    <form action="catalogo" method="post" id='form'>
        <input type="hidden" name="cmd">
        <p>
            <label>
                <span>Titolo :</span>
                <input id="titolo" type="text" name="titolo"  />
            </label>
        </p>

        <p>
            <label>
                <span>Autore :</span>
                <input id="autore" type="text" name="autore"  />
            </label>    </p>


        <p>
            <label>
                <span>Prezzo :</span>
                <input id="prezzo" type="text" name="prezzo" onkeyup="digits(this);" />
            </label>   </p>

        <p>
            <label>
                <span>Durata :</span>
                <input id="durata" type="text" name="durata" onkeyup="digits(this);" />
            </label>
        </p>

        <p>
            <label>
                <span>Quantità :</span>
                <input id="quantita" type="text" name="quantita" onkeyup="digits(this);" />
            </label>
        </p>

        <p>
            <label>
                <span>Trama :</span>
                <textarea id="trama" name="trama" ></textarea>
            </label>   </p>

        <p>
            <label id="button">
                <input type="submit" class="button" value="Inserisci Film" />
            </label>
        </p>
    </form>
    <div id="insert-film-disabler">▲ NASCONDI ▲</div>
</div>




<table>
    <tr>
        <th>ID</th>
        <th>Titolo</th>
        <th>Autore</th>
        <th>Prezzo</th>
        <th>Durata</th>
        <th>Quantità</th>
    </tr>
    <?php
    //si aspetta in ingresso un array di film


    foreach ($films as $film) {
        ?>
        <tr>
    <td><?= $film->getID(); ?></td>
    <td><?= $film->getTitolo(); ?></td>
    <td><?= $film->getAutore(); ?></td>
    <td><?= $film->getPrezzo(); ?></td>
    <td><?= $film->getDurata(); ?></td>
    <td><?= $film->getQuantita(); ?></td>
        </tr>

    <?php
    }

    ?>
</table>