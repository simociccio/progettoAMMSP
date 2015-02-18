<!DOCTYPE html>
<html>
<head>
	<title><?= $datiPagina->getTitolo() ?> - <?= Impostazioni::$nomePortale ?></title>
	<link href="res/stile.css" rel="stylesheet" type="text/css">
    <base href="http://192.168.1.35/progettoAmmS/public/">
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
                    SEI ADMIN
                <?php
            } else {
                ?>
                    SEI UN BURDO
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