<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/www/CabinetMedical/styles/defaut.css">

	</head>

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

		<!-- ///////////////////// FORMULAIRE //////////////////// -->
		<?php
		echo "test echo php";
		?>

		<br>
		<br>

		<style type="text/css">
			form  { display: table;      }
			p     { display: table-row;  }
			label { display: table-cell; }
			input { display: table-cell; }
		</style>

		<form method="get" id="nameform">
		
		<p>
		<label>Nom</label><input type="text" id="fname" name="fname" placeholder="ex : BROISIN"><br>
		</p>

		<p>
		<label>Prenom</label><input type="text" id="fname" name="fname" placeholder="ex : Julien"><br>
		</p>

		<p>
		<label>Adresse</label><input type="text" id="fname" name="fname" placeholder="ex : 18 rue des coquelicot"><br>
		</p>

		<p>
		<label>Code Postal</label><input type="text" id="fname" name="fname" placeholder="ex : 31300"><br>
		</p>

		<p>
		<label>Ville</label><input type="text" id="fname" name="fname" placeholder="ex : Toulouse"><br>
		</p>

		<p>
		<label>Num Tel</label><input type="text" id="fname" name="fname" placeholder="ex : 0102030405"><br>
		</p>

		<p>
		<button type="submit" form="form1" value="Submit">Ajouter</button>
		</p>

		</form>


	</body>
</html>