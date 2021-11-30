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
		<label>Nom</label><input type="text" onfocus="this.value=''" id="fname" name="fname" value="nom"><br>
		</p>

		<p>
		<label>Prenom</label><input type="text" onfocus="this.value=''" id="fname" name="fname" value="prenom"><br>
		</p>

		<p>
		<label>Adresse</label><input type="text" onfocus="this.value=''" id="fname" name="fname" value="adresse"><br>
		</p>

		<p>
		<label>Code Postal</label><input type="text" onfocus="this.value=''" id="fname" name="fname" value="code postal"><br>
		</p>

		<p>
		<label>Ville</label><input type="text" onfocus="this.value=''" id="fname" name="fname" value="ville"><br>
		</p>

		<p>
		<label>Num Tel</label><input type="text" onfocus="this.value=''" id="fname" name="fname" value="numéro de téléphone"><br>
		</p>

		<p>
		<button type="submit" form="form1" value="Submit">Ajouter</button>
		</p>

		</form>


	</body>
</html>