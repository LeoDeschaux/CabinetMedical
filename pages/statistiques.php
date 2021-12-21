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
		<table>
			<thead>
				<tr>
					<th>Tranche d'âge</th>
					<th>Nb Hommes</th>
					<th>Nb Femmes</th>
				</tr>
			</thead>
			<tfoot>
				<tbody>
					<tr>
						<td>Moins de 25 ans</td>
						<td> - 25 ans Hommes</td>
						<td> - 25 ans Femmes</td>
					</tr>
					<tr>
						<td>Entre 25 et 50 ans</td>
						<td>hommes</td>
						<td>femmes</td>
					</tr>
					<tr>
						<td>Plus de 50 ans</td>
						<td> + 50 ans Hommes</td>
						<td> + 50 ans Femmes</td>
					</tr>
				</tbody>
			</tfoot>
		</table>
	</body>
</html>