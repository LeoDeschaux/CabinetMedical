<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
<link href="../../styles/menu_secondaire.css" rel="stylesheet" type="text/css">


<?php 
// permet de mettr ele sous menu Rechercher ou ajouter en surbrillance si on se trouve sur l'une d'entre elle
$rechercher = "";
$ajouter = "";
switch ($sous_menu) {
	case 'ajouter':
		$ajouter = "_surbrillance";
		break;

	case 'rechercher':
		$rechercher = "_surbrillance";
		break;
}

// les pages d'usagers, de medecins et de consultations renseignent leur type (usager, medecin, consultation)
// afin de pouvoir afficher leur menu secondaire en conséquence	 
switch ($page) { 		
	case 'usager':
		?>
		<div class=menu_secondaire_bar>
		<table class="usager_menu">
			<td class="usager_button<?php echo $rechercher; ?>"><a class="usager_text" href="rechercher.php"><span class="usager_text">Rechercher un usager</span></a></td>
			<td class="usager_button<?php echo $ajouter; ?>"><a href="ajouter.php">Ajouter un usager</a></td>
		</table>
		</div>
		<?php
		break;
	
	case 'medecin':
		?>
		<div class=menu_secondaire_bar>
		<table class="usager_menu">
			<td class="usager_button<?php echo $rechercher; ?>"><a href="rechercher.php">Rechercher un medecin</a></td>
			<td class="usager_button<?php echo $ajouter; ?>"><a href="ajouter.php">Ajouter un medecin</a></td>
		</table>
		</div>
		<?php
		break;

	case 'consultation':
		?>
		<table class="usager_menu">
			<td class="usager_button<?php echo $rechercher; ?>"><a href="rechercher.php">Rechercher une consultation</a></td>
			<td class="usager_button<?php echo $ajouter; ?>"><a href="ajouter.php">Ajouter une consultation</a></td>
		</table>
		<?php
		break;
}
?>
	
