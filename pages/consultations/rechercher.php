<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
$var = '1';																			// A COMPLETER
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR

//include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/usagersMenu.php'); 	// USAGERS MENU
?>
<!DOCTYPE HTML>
<html>	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
      	<link rel="stylesheet" href="/CabinetMedical/styles/rechercher.css">
	</head>

	<body>

		<h2 style="color:deeppink">*Mettre boutons : ajouter et rechercher*</h2>

		<br>
		<form method="post">
			<input type="text" name="search" placeholder="nom, prenom, etc.">
			<button type="submit" name="send" value="send">Rechercher</button> <br>
		</form>
		<br>

		<?php
		onFieldChange($linkpdo);

		function onFieldChange($linkpdo)
		{
			showConsultations($linkpdo);
		}

		function showConsultations($linkpdo) {

			$field = "";

			if(isset($_POST['search']))
				$field = $_POST['search'];

			if(empty($field)) {
				$req = $linkpdo->query(
					"SELECT consultation.id_c, consultation.date_heure, consultation.duree, usager.nom as nom_usager, usager.prenom as prenom_usager, medecin.nom as nom_medecin, medecin.prenom as prenom_medecin 
					FROM consultation, usager, medecin 
					WHERE consultation.id_m = medecin.id_m
					AND consultation.id_u = usager.id_u
					AND usager.id_m = medecin.id_m 
					ORDER BY consultation.date_heure DESC"
				);
			} else {
				$req = $linkpdo->prepare(
					"SELECT * FROM usager WHERE nom LIKE :nom OR prenom LIKE :prenom OR adresse LIKE :adresse OR cp LIKE :cp OR ville LIKE :ville ORDER BY nom, prenom ASC"
				);

				/*
				$req->execute(array(
			    'nom' => $field . "%",
			    'prenom' => $field . "%",
			    'adresse' => $field . "%",
			    'cp' => $field . "%",
			    'ville' => $field . "%"));
			    */
			}

		    ///Affichage des entrées du résultat une à une
		    echo "<h2>Liste de toutes les consultations :</h2>";

		    echo "<table class=\"tableau_table\">";
		    echo "<tr class=\"tableau_cell_title\">";

		    	echo "<th>Date</th>";
		    	echo "<th>Heure</th>";
		    	echo "<th>Durée</th>";

		        echo "<th>Nom</th>";
		        echo "<th>Prenom</th>";

		        echo "<th>Médecin</th>";

		        echo "<th>Modifier</th>";
		        echo "<th>Supprimer</th>";
		    echo "</tr>";

		    while ($row = $req->fetch()) {

		    	$jourConsultation = Date('d-m-Y', $row['date_heure']);
		    	
		    	$heureConsultation = date('H', $row['date_heure']) . "h" . date('i', $row['date_heure']);
		    	
		    	$tmp_heures = floor($row['duree'] / 60);
				$tmp_minutes = $row['duree'] - ($tmp_heures*60);
		    	
		    	$dureeConsultation = sprintf('%02d:%02d', $tmp_heures, $tmp_minutes);

		    	$medecin = $row['nom_medecin'] . " " . $row['prenom_medecin'];

		    	$id_c = $row['id_c'];


		    	/*
		    	$req_medecin = $linkpdo->prepare("SELECT medecin.nom, medecin.prenom FROM medecin, usager WHERE medecin.id_m=:id_m");

		    	$req_medecin->execute(array(
		    		'id_m' => $row['id_m'] 
		    	));

		    	while($medecin_row = $req_medecin->fetch())
		    	{
		    		$medecin_referent = $medecin_row['nom'] . " " . $medecin_row['prenom']; 
		    	}
		    	*/

		        echo "<tr class=\"tableau_cell_title\">";

		        	echo "<td class=\"tableau_cell\">" . $jourConsultation . "</td>";
		        	echo "<td class=\"tableau_cell\">" . $heureConsultation . "</td>";
		        	echo "<td class=\"tableau_cell\">" . $dureeConsultation  . "</td>";

		            echo "<td class=\"tableau_cell\">" . $row['nom_usager'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['prenom_usager'] . "</td>";

		            echo "<td class=\"tableau_cell\">" . $medecin . "</td>";

		            echo "<td class=\"tableau_cell\"><a href=\"modifier.php?id_c=$id_c\">Modifier</a></td>";
	                echo "<td class=\"tableau_cell\"><a href=\"supprimer.php?id_c=$id_c\">Supprimer</a></td>";
		        echo "</tr>";
		    }

		    echo "</table>";
		    $req->closeCursor(); 
		}
		?>
	</body>
</html>