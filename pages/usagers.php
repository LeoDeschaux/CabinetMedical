<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php');
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../styles/defaut.css">
    	<?php 
			include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 
		?>
	</head>

	<?php

	?>

	<body>

		<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
    	<?php 
			$var = '1';
			$type = 'usager';
			$CouleurMenu = 'Usagers';
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php';
			include($headerPath); 
		?>

		<!-- ///////////////////// USAGER MENU //////////////////// -->
		<?php 
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/usagersMenu.php';
			include($headerPath); 
		?>
		
	</body>
</html>