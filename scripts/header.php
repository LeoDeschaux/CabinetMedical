<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
<?php

$stylePage1 = "menu";
$stylePage2 = "menu";
$stylePage3 = "menu";
$stylePage4 = "menu";
$stylePage5 = "menu";

$currentPageName = basename($_SERVER['PHP_SELF']);

if($page == "medecin")
	$stylePage1 = "menu-current";

if($page == "usager")
	$stylePage2 = "menu-current";

if($page == "medecin")
	$stylePage3 = "menu-current";

if($page == "consultation")
	$stylePage4 = "menu-current";

if($currentPageName == "statistiques.php")
	$stylePage5 = "menu-current";	
?>

<nav>
	<div class="table">
	<ul>
		<li class="<?php echo $stylePage2;?>">
			<a class ="usagers" href="/CabinetMedical/pages/usagers/rechercher.php">Usagers</a>
		</li>
		
		<li class="<?php echo $stylePage3;?>">
			<a class ="medecins" href="/CabinetMedical/pages/medecins/rechercher.php">Médecins</a>
		</li>

		<li class="<?php echo $stylePage4;?>">
			<a class ="consultations" href="/CabinetMedical/pages/consultations/rechercher.php">Consultations</a>
		</li>
		
		<li class="<?php echo $stylePage5;?>">
			<a class ="statistiques" href="/CabinetMedical/pages/Statistiques/rechercher.php">Statistiques</a>
		</li>
	</ul>
	</div>
</nav>

<form method="post" action="/CabinetMedical/scripts/connexion.php">
	<div class="deconnexion"><a><input type="submit" name="deconnexion" value="Déconnexion" style="all:unset" ></a></div> 
	<!-- style="all:unset" pour supprimer le style par défaul du bouton submit-->
</form>
