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
			<a class ="accueil" href="<?php echo $path.'pages/accueil.php';?>">Accueil</a>
		</li>

		<li class="menu">
			<a class ="usagers" href="<?php echo $path.'pages/usagers.php';?>">Usagers</a>
		</li>
		
		<li class="menu">
			<a class ="medecins" href="<?php echo $path.'pages/medecins.php';?>">Medecins</a>
		</li>

		<li class="menu">
			<a class ="planning" href="<?php echo $path.'pages/planning.php';?>">Planning</a>
		</li>
		
		<li class="menu">
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
else{
?>

<?php }
?>

<?php
	switch ($CouleurMenu) {
		case 'Accueil':
			?>
			<style type="text/css"> 
				.accueil {
					border-top: 3px solid #9BA0C8;
					background-color: rgba(155, 160, 200, 0.15);
				}
			</style>
			<?php
			break;
		
		case 'Planning':
			?>
			<style type="text/css"> 
				.planning {
					border-top: 3px solid #9BA0C8;
					background-color: rgba(155, 160, 200, 0.15);
				}
			</style>
			<?php
			break;
		
		case 'Statistiques':
			?>
			<style type="text/css"> 
				.statistiques {
					border-top: 3px solid #9BA0C8;
					background-color: rgba(155, 160, 200, 0.15);
				}
			</style>
			<?php
			break;
		
		case 'Usagers':
			?>
			<style type="text/css"> 
				.usagers {
					border-top: 3px solid #9BA0C8;
					background-color: rgba(155, 160, 200, 0.15);
				}
			</style>
			<?php
			break;
		
		case 'Médecins':
			?>
			<style type="text/css"> 
				.medecins {
					border-top: 3px solid #9BA0C8;
					background-color: rgba(155, 160, 200, 0.15);
				}
			</style>
			<?php
			break;
	}
?>

