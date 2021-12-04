<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->

<?php 
if($var == '1') {

$path = '/www/CabinetMedical/';
//echo $path; 

$stylePage1 = "menu";
$stylePage2 = "menu";
$stylePage3 = "menu";
$stylePage4 = "menu";
$stylePage5 = "menu";

$currentPageName = basename($_SERVER['PHP_SELF']);

if($currentPageName == "accueil.php")
	$stylePage1 = "menu-current";

if($currentPageName == "usagers.php" || $currentPageName == "ajouter.php" ||
   $currentPageName == "modifier.php" || $currentPageName == "rechercher.php" ||
   $currentPageName == "supprimer.php")
	$stylePage2 = "menu-current";

if($currentPageName == "medecins.php")
	$stylePage3 = "menu-current";

if($currentPageName == "planning.php")
	$stylePage4 = "menu-current";

if($currentPageName == "statistiques.php")
	$stylePage5 = "menu-current";
?>

<nav>
	<div class="table">
	<ul>
		<li class="<?php echo $stylePage1;?>">
			<a class ="accueil" href="<?php echo $path.'pages/accueil.php';?>">Accueil</a>
		</li>

		<li class="<?php echo $stylePage2;?>">
			<a class ="usagers" href="<?php echo $path.'pages/usagers.php';?>">Usagers</a>
		</li>
		
		<li class="<?php echo $stylePage3;?>">
			<a class ="medecins" href="<?php echo $path.'pages/medecins.php';?>">Medecins</a>
		</li>

		<li class="<?php echo $stylePage4;?>">
			<a class ="planning" href="<?php echo $path.'pages/planning.php';?>">Planning</a>
		</li>
		
		<li class="<?php echo $stylePage5;?>">
			<a class ="statistiques" href="<?php echo $path.'pages/statistiques.php';?>">Statistiques</a>
		</li>
		
		<li class="deconnexion">
			<a href="<?php echo $path.'index.php';?>">Déconnexion</a>
		</li>
	</ul>
	</div>
</nav>

<?php
}
?>