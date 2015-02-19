<script>
$( document ).ready(function() {
        function loadAJAX(){
            $.ajax({ // ajax call starts
                dataType: "json",
                url: 'ajax',
                type: 'GET',
                success: function (response) {
                    var trHTML = "<tr><th>Titolo</th><th>Acquirente</th><th>Timestamp</th></tr>";
                    $.each(response, function (i, item) {
                        trHTML += '<tr><td>' + item.titolo + '</td><td>' + item.acquirente + '</td><td>' + item.timestamp + '</td></tr>';
                    });
                    $('#ordini').empty();
                    $('#ordini').append(trHTML);
                }
            })
        }

    setInterval(function(){
        loadAJAX();
    }, 1000);

    });
</script>

<table id="ordini">
    <tr><th>Titolo</th><th>Acquirente</th><th>Timestamp</th></tr>


    <?php
    foreach ($acquisti as $acquisto) {
        ?>
        <tr>

            <td><?= $acquisto->getTitolo(); ?></td>
            <td><?= $acquisto->getNomeAcquirente(); ?></td>
            <td><?= $acquisto->getTs(); ?></td>
        </tr>
    <?php
    }
    ?>

</table>