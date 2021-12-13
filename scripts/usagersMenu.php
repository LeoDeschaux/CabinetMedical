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

<table class="usager_menu">
	<td class="usager_button"><a href="/CabinetMedical/pages/usagers/rechercher.php">Rechercher un usager</a></td>
	<td class="usager_button"><a href="/CabinetMedical/pages/usagers/ajouter.php">Ajouter un usager</a></td>
</table>

<?php
}
else{
?>

<?php }
?>
