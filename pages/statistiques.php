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

		$moins25_h = '';
		$entre25et50_h = '';
		$plus50_h = '';

		$moins25_f = '';
		$entre25et50_f = '';
		$plus50_f = '';

		// GET AGE
		$req = $linkpdo->query("
			SELECT date_naissance, 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) as age
			FROM usager
			ORDER BY age DESC
		");

		while($row = $req->fetch())
		{
			echo "Date: " . $row['date_naissance'] . ", age: " . $row['age'] . "<br>";
		}

		//MOINS DE 25 ANS
		$req = $linkpdo->query("
			SELECT count(*) as nb_moins25_h
			FROM usager
			WHERE civilite = 'M'
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) < 25
		");
		$moins25_h = ($req->fetch())['nb_moins25_h'];


		//ENTRE 25 ET 50
		$req = $linkpdo->query("
			SELECT count(*) as nb_entre25et50_h
			FROM usager
			WHERE civilite = 'M'
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) BETWEEN 25 AND 50
		");
		$entre25et50_h = ($req->fetch())['nb_entre25et50_h'];

		//PLUS DE 50 ANS
		$req = $linkpdo->query("
			SELECT count(*) as nb_plus50_h
			FROM usager
			WHERE civilite = 'M'
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) > 50
		");
		$plus50_h = ($req->fetch())['nb_plus50_h'];






		//MOINS DE 25 ANS
		$req = $linkpdo->query("
			SELECT count(*) as nb_moins25_f
			FROM usager
			WHERE (civilite = 'Mme' OR civilite = 'Mlle') 
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) < 25
		");
		$moins25_f = ($req->fetch())['nb_moins25_f'];


		//ENTRE 25 ET 50
		$req = $linkpdo->query("
			SELECT count(*) as nb_entre25et50_f
			FROM usager
			WHERE (civilite = 'Mme' OR civilite = 'Mlle') 
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) BETWEEN 25 AND 50
		");
		$entre25et50_f = ($req->fetch())['nb_entre25et50_f'];

		//PLUS DE 50 ANS
		$req = $linkpdo->query("
			SELECT count(*) as nb_plus50_f
			FROM usager
			WHERE (civilite = 'Mme' OR civilite = 'Mlle') 
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) > 50
		");
		$plus50_f = ($req->fetch())['nb_plus50_f'];


		echo "HOMME <br>";
		echo "NB moins de 25 ans: " . $moins25_h . "<br>";
		echo "NB entre 25 et 50 ans: " . $entre25et50_h . "<br>";
		echo "NB plus de 50 ans: " . $plus50_h . "<br>";

		echo "<br>";
		echo "FEMME <br>";
		echo "NB moins de 25 ans: " . $moins25_f . "<br>";
		echo "NB entre 25 et 50 ans: " . $entre25et50_f . "<br>";
		echo "NB plus de 50 ans: " . $plus50_f . "<br>";

		?>

		<br>

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
					<td><?php echo $moins25_h ?></td>
					<td><?php echo $moins25_f ?></td>
				</tr>
				<tr>
					<td>Entre 25 et 50 ans</td>
					<td><?php echo $entre25et50_h ?></td>
					<td><?php echo $entre25et50_f ?></td>
				</tr>
				<tr>
					<td>Plus de 50 ans</td>
					<td><?php echo $plus50_h ?></td>
					<td><?php echo $plus50_f ?></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>