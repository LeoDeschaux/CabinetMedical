<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../styles/defaut.css">
<style type="text/css">
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
}
</style>


	</head>

	<?php

	?>

	<body>

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
		
		<!-- <img src="../images/golo.jpg"> -->

		<br>

		<form>
			
			<button type="submit" form="form1" value="Submit">Ajouter un usager</button>

			<button type="submit" form="form1" value="Submit">Modifier un usager</button>

			<button type="submit" form="form1" value="Submit">Supprimer un usager</button>
		</form>

		<hr>

		<h1></h1>
		<form>
			
  			<input type="text" id="fname" name="fname" value="nom, prenom, etc.">
			<button type="submit" form="form1" value="Submit">Rechercher</button>
  			<br><br>
		</form>
		

		<table>
			<tr>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Adresse</th>
				<th>Code Postal</th>
				<th>Ville</th>
				<th>Num Téléphone</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>

			<tr>
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