<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/www/CabinetMedical/styles/defaut.css">
	<body>

    	<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
    	<?php 
			$var = '1';
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/www/CabinetMedical/scripts/header.php';
			include($headerPath); 
		?>

		<!-- ///////////////////// USAGERS MENU //////////////////// -->
		<?php 
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/www/CabinetMedical/scripts/usagersMenu.php';
			include($headerPath); 
		?>
		
	</body>

	<section style="text-align: center">
			<h1 style="font-family: arial;font-size: 5em;color: deeppink;, text-align: center !important;">
				USAGERS - SUPPRIMER
			</h1>
		</section>
</html>