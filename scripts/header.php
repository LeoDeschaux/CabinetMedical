<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->

<?php 
if($var == '1') {

$path = '/www/CabinetMedical/';
//echo $path;
?>

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

<?php
}
else{
?>

<?php }
?>
