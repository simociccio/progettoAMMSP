<table>
    <tr>
        <th>ID Ordine</th>
        <th>Data Ordine</th>
        <th>Titolo Film Ordinato</th>
    </tr>


<?php
foreach ($acquisti as $acquisto) {
    ?>
    <tr>
        <td><?= $acquisto->getID(); ?></td>
        <td><?= $acquisto->getTs(); ?></td>
        <td><?= $acquisto->getTitolo(); ?></td>
    </tr>
<?php
}
?>

    </table>
