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
		


		<style type="text/css">
		.tableau_table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 100%;

		}

		.tableau_cells {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}

		tr, th{
			border: 1px solid #dddddd;
			background-color: none;
		}

		</style>

		<form>
			
  			<input type="text" id="fname" name="fname" value="nom, prenom, etc.">
			<button type="submit" form="form1" value="Submit">Rechercher</button>
  			<br><br>
		</form>
		
		<table class="tableau_table">

			<tr class="tableau_cells">
				<th>Nom</th>
				<th>Prenom</th>
				<th>Adresse</th>
				<th>Code Postal</th>
				<th>Ville</th>
				<th>Num Téléphone</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>

			<tr class="tableau_cells">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</body>
</html>