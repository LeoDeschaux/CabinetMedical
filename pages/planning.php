<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Planning</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../styles/defaut.css">
    	<?php 
			include($_SERVER['DOCUMENT_ROOT'] . '/www/CabinetMedical/scripts/connexion.php'); 
		?>
	</head>

	<body>

    	<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
    	<?php 
			$var = '1';
			$CouleurMenu = 'Planning';
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/www/CabinetMedical/scripts/header.php';
			include($headerPath); 
		?>
		
		<section style="text-align: center">
			<h1 style="font-family: arial;font-size: 5em;color: deeppink;, text-align: center !important;">
				PLANNING
			</h1>
		</section>
		
	</body>

</html>