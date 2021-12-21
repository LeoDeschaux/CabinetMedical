<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->

<?php 
if($var == '1') {

	$path = '/CabinetMedical/';
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
	<?php
	switch ($type) {
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
	}
	?>
	

	<?php
	}
else{
	?>

	<?php 
}
?>
