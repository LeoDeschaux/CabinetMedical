<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->

<?php 
if($var == '1') {

$path = '/www/CabinetMedical/';
//echo $path;
?>

<style type="text/css">
.usager_menu{
	font-style: none;
	margin: 20px;
}
.usager_button
{
	background-color: white;
	padding: 10px;
	margin: 30px;
}
</style>

<table class="usager_menu">
	<td class="usager_button"><a href="/www/CabinetMedical/pages/usagers/ajouter.php">Ajouter un usager</a></td>
	<td class="usager_button"><a href="/www/CabinetMedical/pages/usagers/modifier.php">Modifier un usager</a></td>
	<td class="usager_button"><a href="/www/CabinetMedical/pages/usagers/rechercher.php">Rechercher un usager</a></td>
	<td class="usager_button"><a href="/www/CabinetMedical/pages/usagers/supprimer.php">Supprimer un usager</a></td>
</table>

<!-- 
<nav>
	<div class="table">
	<ul>
		<li class="menu">
			<a href="<?php echo $path.'pages/accueil_secretariat.php';?>">Accueil</a>
		</li>

		<li class="menu">
			<a href="<?php echo $path.'pages/usagers.php';?>">Usagers</a>
		</li>
		
		<li class="menu">
			<a href="<?php echo $path.'pages/medecins.php';?>">Medecin</a>
		</li>

		<li class="menu">
			<a href="<?php echo $path.'pages/planning.php';?>">Planning</a>
		</li>
		
		<li class="menu">
			<a href="<?php echo $path.'pages/statistiques.php';?>">Statistiques</a>
		</li>
		
		<li class="deconnexion">
			<a href="<?php echo $path.'index.html';?>">Déconnexion</a>
		</li>
	</ul>
	</div>
</nav>
-->

<?php
}
else{
?>

<?php }
?>
