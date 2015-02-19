<!DOCTYPE html>
<html>
<head>
	<title><?= $datiPagina->getTitolo() ?> - <?= Impostazioni::$nomePortale ?></title>
	<link href="<?= Impostazioni::$app_path ?>/res/stile.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <base href="<?= Impostazioni::$app_path ?>">
	<meta charset="UTF-8">
	<script language="javascript">
		function digits(fld) {
		fld.value = fld.value.replace(/[^0-9,]/ig, "");
		}
</script>

</head>
<body>
<div id="page">
    <div id="user-info"><?= $datiPagina->getUserInfo() ?></div>
	<div id="header"><h1><?= $datiPagina->getTitolo() ?>
		<h2><?= $datiPagina->getUtenteLoggato()?></h2>
	</h1></div>
	<div id="menu">
		<ul id="menu-items">
            <li><a href='.'>HOME</a></li>
            <?php

            if($datiPagina->getRole() == 1){
                ?>
                <li><a href='catalogo'>CATALOGO</a></li>
                <li><a href='ordini'>LISTA ORDINI</a></li>
                <?php
            } else if($datiPagina->isLogged()){
                ?>
                <li><a href='cronologia'>CRONOLOGIA ACQUISTI</a></li>
            <?php
            }

            if($datiPagina->isLogged()) echo "<li><a href='logout'>LOGOUT</a></li>";
            ?>

		</ul>
	</div>
	<div id="contenuto">
	<?php 
		if($datiPagina->iError()) echo $datiPagina->getErrorMessage();
		$content = $datiPagina->getSubView();
		require "$content";

	?>

	</div>
</div>
</body>
</html>