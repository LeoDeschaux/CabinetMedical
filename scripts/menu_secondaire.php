<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
<link href="/CabinetMedical/styles/menu_secondaire.css" rel="stylesheet" type="text/css">

<?php
switch ($page) {
	case 'usager':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="/CabinetMedical/pages/usagers/rechercher.php">Rechercher un usager</a></td>
			<td class="usager_button"><a href="/CabinetMedical/pages/usagers/ajouter.php">Ajouter un usager</a></td>
		</table>
		<?php
		break;
	
	case 'medecin':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="/CabinetMedical/pages/medecins/rechercher.php">Rechercher un medecin</a></td>
			<td class="usager_button"><a href="/CabinetMedical/pages/medecins/ajouter.php">Ajouter un medecin</a></td>
		</table>
		<?php
		break;

	case 'consultation':
		?>
		<table class="usager_menu">
			<td class="usager_button"><a href="/CabinetMedical/pages/consultations/rechercher.php">Rechercher une consultation</a></td>
			<td class="usager_button"><a href="/CabinetMedical/pages/consultations/ajouter.php">Ajouter une consultation</a></td>
		</table>
		<?php
		break;
}
?>
	
