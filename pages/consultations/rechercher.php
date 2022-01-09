<?php
$page = 'consultation';							// type de la page
$sous_menu = 'rechercher';						// permet de mettre le sous menue Rechercher une consultation en surbrillance
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
?>
<!DOCTYPE HTML>
<html>	
	<head>
		<title>Cabinet ORDOMEDIC</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
      	<link rel="stylesheet" href="../../styles/rechercher.css">
	</head>
	<body>

		<?php include('../../scripts/header.php'); 	// NAVIGUATION BAR ?>

		<br>
		<form method="post">
			<input type="text" name="search" placeholder="nom, prenom, etc.">
			<select name="id_m" label="">
		    	<option value="0" selected>Tous les médecins</option>

		    	<?php
		    	$req = $linkpdo->query("SELECT * FROM medecin ORDER BY nom, prenom DESC");
		    	while($row = $req->fetch()) {
		    		echo "<option value=" . $row['id_m'] . ">" . $row['nom'] . " " . $row['prenom'] . "</option>";
		    		}
		    	?>
		    </select>

		    <select name="filtre_consultation" label="">
		    	<option value="0" selected>Consultations à venir</option>
		    	<option value="1">Consultations passées</option>
		    	<option value="2">Toutes les consultations</option>
		    </select>

		    <!--
		    <input type="date" name="jour_consultation" value="<?php echo date('Y-m-d');?>">
			-->

			<button type="submit" name="send" value="send">Rechercher</button> <br>
		</form>
		<br>
		<?php
		onFieldChange($linkpdo);

		function onFieldChange($linkpdo) {
			showConsultations($linkpdo);
		}

		function showConsultations($linkpdo) {

			$select_filter = "";
			$search_filter = "";
			$filtre_consultation = "AND consultation.date_heure
						> UNIX_TIMESTAMP(NOW())";
			$field = "";

			if(isset($_POST['search'])) {
				$field = $_POST['search'];

				if($_POST['id_m'] != 0)
					$select_filter = "AND consultation.id_m=" . $_POST['id_m'];

				if(!empty($_POST['search'])) {
					$search_filter = "AND (usager.nom LIKE :field
					OR usager.prenom LIKE :field
					OR medecin.nom LIKE :field
					OR medecin.prenom LIKE :field)";
				}

				switch ($_POST['filtre_consultation']) {
					case 0:
						$filtre_consultation = "AND consultation.date_heure
						> UNIX_TIMESTAMP(NOW())";
						break;

					case 1:
						$filtre_consultation = "AND consultation.date_heure
						< UNIX_TIMESTAMP(NOW())";
						break;

					default:
						$filtre_consultation = "";
						break;
				}
			}

			$query = "SELECT consultation.id_c, consultation.date_heure, consultation.duree, usager.nom as nom_usager, usager.prenom as prenom_usager, medecin.nom as nom_medecin, medecin.prenom as prenom_medecin  
			FROM consultation, usager, medecin 
			WHERE consultation.id_m = medecin.id_m
			AND consultation.id_u = usager.id_u" . " " .
			$select_filter . " " . 
			$search_filter . " " . 
			$filtre_consultation . " " . 
			"ORDER BY consultation.date_heure DESC";

					if(!empty($_POST['search'])) {
						$search_filter = "AND (usager.nom LIKE :field
						OR usager.prenom LIKE :field
						OR medecin.nom LIKE :field
						OR medecin.prenom LIKE :field)";
					}
				}

				$query = "SELECT consultation.id_c, consultation.date_heure, consultation.duree, usager.nom as nom_usager, usager.prenom as prenom_usager,medecin.nom as nom_medecin, medecin.prenom as prenom_medecin  
				FROM consultation, usager, medecin 
				WHERE consultation.id_m = medecin.id_m
				AND consultation.id_u = usager.id_u" . " " .
				$select_filter . " " . 
				$search_filter .
				"ORDER BY consultation.date_heure DESC";

				$req = $linkpdo->prepare($query);

				$req->execute(array(
			    'field' => $field . "%"));

			    // Affichage des entrées du résultat une à une
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
		    	$jourConsultation = date('d/m/Y', $row['date_heure']);
		    	
		    	$heureConsultation = date('H', $row['date_heure']) . "h" . date('i', $row['date_heure']);
		    	
		    	$tmp_heures = floor($row['duree'] / 60);
				$tmp_minutes = $row['duree'] - ($tmp_heures*60);
		    	
		    	$dureeConsultation = sprintf('%02dh%02dm', $tmp_heures, $tmp_minutes);


			    	$medecin = $row['nom_medecin'] . " " . $row['prenom_medecin'];

			    	$id_c = $row['id_c'];

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
		</main>
	</body>

	<?php
		include('../../scripts/footer.php');			// bas de page
	?>
</html>