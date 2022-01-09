<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
<?php

$stylePage1 = "menu";
$stylePage2 = "menu";
$stylePage3 = "menu";
$stylePage4 = "menu";
$stylePage5 = "menu";

$currentPageName = basename($_SERVER['PHP_SELF']);

// les pages d'usagers, de medecins et de consultations renseignent leur type (usager, medecin, consultation) 
// afin de pouvoir afficher leur menu en conséquence
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
			<a class ="usagers" href="../pages/usager/rechercher.php">Usagers</a>
		</li>
		
		<li class="<?php echo $stylePage3;?>">
			<a class ="medecins" href="../pages/medecins/rechercher.php">Médecins</a>
		</li>

		<li class="<?php echo $stylePage4;?>">
			<a class ="consultations" href="../pages/consultations/rechercher.php">Consultations</a>
		</li>
		
		<li class="<?php echo $stylePage5;?>">
			<a class ="statistiques" href="../pages/statistiques.php">Statistiques</a>
		</li>
	</ul>
	</div>
</nav>

<!-- bouton qui déconnecte l'utilisateur et le redirige vers index.php -->
<form method="post" action="connexion.php">
	<div class="deconnexion"><a><input type="submit" name="deconnexion" value="Déconnexion" style="all:unset" ></a></div> 
	<!-- style="all:unset" pour supprimer le style par défaul du bouton submit-->
</form>
