<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../styles/defaut.css">

	</head>

	<?php

	?>

	<body>

		<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
    	<nav>
    		<div class="table">
			<ul>
				<li class="menu"><a href="accueil_secretariat.php">Accueil</a></li>

				<li class="menu"><a href="usagers.php">Usagers</a></li>
				<li class="menu"><a href="medecins.php">Medecins</a></li>

				<li class="menu"><a href="planning.php">Planning</a></li>
				<li class="menu"><a href="statistiques.php">Statistiques</a></li>
				<li class="deconnexion"><a href="../index.html">Déconnexion</a></li>
			</ul>
			</div>
		</nav>

		<br>

		<!-- ///////////////////// LIEN USAGER & FORMULAIRE //////////////////// -->

		<style type="text/css">
		table{
			font-style: none;
			margin: 20px;
		}

		td
		{
			background-color: white;
			padding: 10px;
			margin: 30px;
		}
		</style>

		
		<table>
			<td><a href="usagers/ajouter.php">Ajouter un usager</a></td>
			<td><a href="usagers/modifier.php">Modifier un usager</a></td>
			<td><a href="usagers/supprimer.php">Rechercher un usager</a></td>
			<td><a href="usagers/supprimer.php">Supprimer un usager</a></td>
		</table>
	</body>
</html>