<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
<link href="../styles/menu_secondaire.css" rel="stylesheet" type="text/css">

<?php   				// les pages d'usagers, de medecins et de consultations renseignent leur type (usager, medecin, consultation) 
switch ($page) { 		// afin de pouvoir afficher leur menu secondaire en conséquence	
	case 'usager':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="../pages/usagers/rechercher.php">Rechercher un usager</a></td>
			<td class="usager_button"><a href="../pages/usagers/ajouter.php">Ajouter un usager</a></td>
		</table>
		<?php
		break;
	
	case 'medecin':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="../pages/medecins/rechercher.php">Rechercher un medecin</a></td>
			<td class="usager_button"><a href="../pages/medecins/ajouter.php">Ajouter un medecin</a></td>
		</table>
		<?php
		break;

	case 'consultation':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="../pages/consultations/rechercher.php">Rechercher une consultation</a></td>
			<td class="usager_button"><a href="../pages/consultations/ajouter.php">Ajouter une consultation</a></td>
		</table>
		<?php
		break;
}
?>
	
