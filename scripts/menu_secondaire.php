<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
<link href="../../styles/menu_secondaire.css" rel="stylesheet" type="text/css">

<?php   				// les pages d'usagers, de medecins et de consultations renseignent leur type (usager, medecin, consultation) 
switch ($page) { 		// afin de pouvoir afficher leur menu secondaire en conséquence	
	case 'usager':
		?>
		<div class=menu_secondaire_bar>
		<table class="usager_menu">
			<td class="usager_button"><a class="usager_text" href="rechercher.php"><span class="usager_text">Rechercher un usager</span></a></td>
			<td class="usager_button"><a href="ajouter.php">Ajouter un usager</a></td>
		</table>
		</div>
		<?php
		break;
	
	case 'medecin':
		?>
		<div class=menu_secondaire_bar>
		<table class="usager_menu">
			<td class="usager_button"><a href="rechercher.php">Rechercher un medecin</a></td>
			<td class="usager_button"><a href="ajouter.php">Ajouter un medecin</a></td>
		</table>
		</div>
		<?php
		break;

	case 'consultation':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="rechercher.php">Rechercher une consultation</a></td>
			<td class="usager_button"><a href="ajouter.php">Ajouter une consultation</a></td>
		</table>
		<?php
		break;
}
?>
	
