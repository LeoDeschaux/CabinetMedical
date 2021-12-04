<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/www/CabinetMedical/styles/defaut.css">
	</head>

	<?php

	?>

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

	<?php 

	?>

	<style type="text/css">
	form  { display: table;      }
	p     { display: table-row;  }
	label { display: table-cell; }
	input { display: table-cell; }
	</style>
		
	<form method="post">
	
	<p>
	<label>Nom</label><input type="text" name="nom" placeholder="ex : BROISIN"><br>
	</p>

	<p>
	<label>Prenom</label><input type="text" name="prenom" placeholder="ex : Julien"><br>
	</p>

	<br>

	<p>
	<label>Civilité</label>
	<select name="civilite"*>
    	<option value="M">Monsieur</option>
    	<option value="Mme">Madame</option>
    	<option value="Mlle">Mademoiselle</option>
  	</select>
	</p>

	<p>
	<label>Numéro de sécurité social</label><input type="text" name="num_secu" placeholder="ex : 0123456789"><br>
	</p>

	<br>

	<p>
	<label>Adresse</label><input type="text" name="adresse" placeholder="ex : 18 rue des coquelicot"><br>
	</p>

	<p>
	<label>Code Postal</label><input type="text" name="cp" placeholder="ex : 31300"><br>
	</p>

	<p>
	<label>Ville</label><input type="text" name="ville" placeholder="ex : Toulouse"><br>
	</p>

	<br>

	<p>
	<label>Lieu de naissance</label><input type="text" name="lieu_naissance" placeholder="ex : Toulouse"><br>
	</p>

	<p>
	<label>Date de naissance</label><input type="text" name="date_naissance" placeholder="ex : 01/01/1990"><br>
	</p>

	<br>

	<p>
	<button type="submit" name ="send" value="send">Ajouter</button>
	</p>

	</form>

	</body>
</html>