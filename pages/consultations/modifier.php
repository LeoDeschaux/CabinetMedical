<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Médecins</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
    	<?php 
			include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 
		?>
	</head>

	<body>

    	<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
    	<?php 
			$var = '1';
			$CouleurMenu = 'Médecins';
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php';
			include($headerPath); 
		?>
		

		<section style="text-align: center">
			<h1 style="font-family: arial;font-size: 5em;color: deeppink;, text-align: center !important;">
				Consultations - Modifier
			</h1>
		</section>
	</body>
</html>