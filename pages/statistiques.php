<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 
$type = 'statistique';
$var ='1';
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Statistiques</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../styles/defaut.css">
    	<link rel="stylesheet" href="../styles/statistiques.css">
	</head>
	<body>
		<?php
		$format = "Y-m-d";
		$timestamp = date_timestamp_get(date_create());
		$date_jour = date($format, $timestamp);
		$req = $linkpdo->prepare("SELECT * FROM usager WHERE date_naissance - $date_jour < 788 400 000 AND civilite = 'M' ");
		$req->execute(array());
		echo "\n".$req->rowCount();
		

			 
		?>
		<table>
			<thead>
				<tr>
					<th>Tranche d'âge</th>
					<th>Nb Hommes</th>
					<th>Nb Femmes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Moins de 25 ans</td>
					<td><?php //echo $req; ?></td>
					<td> </td>
				</tr>
				<tr>
					<td>Entre 25 et 50 ans</td>
					<td> </td>
					<td> </td>
				</tr>
				<tr>
					<td>Plus de 50 ans</td>
					<td> </td>
					<td> </td>
				</tr>
			</tbody>
		</table>
	</body>
</html>