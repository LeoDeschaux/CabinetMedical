<?php
$page = 'statistique';																// type de la page
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/footer.php');			// bas de page
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Statistiques</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
    	<link rel="stylesheet" href="/CabinetMedical/styles/statistiques.css">
    	<link rel="stylesheet" href="/CabinetMedical/styles/footer.css">
	</head>
	<body>
		<?php
		$moins25_h = '';
		$entre25et50_h = '';
		$plus50_h = '';

		$moins25_f = '';
		$entre25et50_f = '';
		$plus50_f = '';

		//MOINS DE 25 ANS HOMMES
		$req = $linkpdo->query("
			SELECT count(*) as nb_moins25_h
			FROM usager
			WHERE civilite = 'M'
			AND floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) < 25");
		$moins25_h = ($req->fetch())['nb_moins25_h'];

		//ENTRE 25 ET 50 HOMMES
		$req = $linkpdo->query("
			SELECT count(*) as nb_entre25et50_h
			FROM usager
			WHERE civilite = 'M'
			AND floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) BETWEEN 25 AND 50");
		$entre25et50_h = ($req->fetch())['nb_entre25et50_h'];

		//PLUS DE 50 ANS HOMMES
		$req = $linkpdo->query("
			SELECT count(*) as nb_plus50_h
			FROM usager
			WHERE civilite = 'M'
			AND floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) > 50");
		$plus50_h = ($req->fetch())['nb_plus50_h'];

		//MOINS DE 25 ANS FEMMES
		$req = $linkpdo->query("
			SELECT count(*) as nb_moins25_f
			FROM usager
			WHERE (civilite = 'Mme' OR civilite = 'Mlle') 
			AND floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) < 25");
		$moins25_f = ($req->fetch())['nb_moins25_f'];

		//ENTRE 25 ET 50 FEMMES
		$req = $linkpdo->query("
			SELECT count(*) as nb_entre25et50_f
			FROM usager
			WHERE (civilite = 'Mme' OR civilite = 'Mlle') 
			AND floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) BETWEEN 25 AND 50");
		$entre25et50_f = ($req->fetch())['nb_entre25et50_f'];

		//PLUS DE 50 ANS FEMMES
		$req = $linkpdo->query("
			SELECT count(*) as nb_plus50_f
			FROM usager
			WHERE (civilite = 'Mme' OR civilite = 'Mlle') 
			AND 
			floor( (UNIX_TIMESTAMP(NOW()) - date_naissance) / (60*60*24*365) ) > 50");
		$plus50_f = ($req->fetch())['nb_plus50_f'];
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
		<?php
		$req = $linkpdo->prepare("SELECT * FROM medecin, consutation WHERE medecin.id_m = consutation.id_m ORDER BY nom, prenom ASC");

		$req->execute(array('id_m' => "" ));

		echo "<table class=\"tableau_table\">";
		echo "<tr class=\"tableau_cell_title\">";
		    echo "<th>Médecin</th>";
		    echo "<th>Nb Heures</th>";
		echo "</tr>";

		while ($row = $req->fetch()) {

		    	if(!empty($row['id_m']))
		    	{
		    		$req = $linkpdo->query("
						SELECT nom, prenom
						FROM consutation, medecin
						WHERE consutation.id_m = medecin.id_m");
					$medecin = ($req->fetch())['medecin'];

			    	$req = $linkpdo->query("
						SELECT sum(duree) as duree_total
						FROM consutation, medecin
						WHERE consutation.id_m = medecin.id_m");
					$duree_total = ($req->fetch())['duree_total'];
		    	}

		    	echo "<tr class=\"tableau_cell_title\">";
		            echo "<td class=\"tableau_cell\">" . $row['medecin'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['duree_total'] . "</td>";
		        echo "</tr>";
	}

	echo "</table>";
	$req->closeCursor(); 
		
		
		?>
	</body>
</html>
