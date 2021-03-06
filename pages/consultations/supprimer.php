<?php
$page = 'consultation';							// type de la page
$sous_menu = '';
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Cabinet ORDOMEDIC</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
   	    <link rel="stylesheet" href="/CabinetMedical/styles/supprimer.css">
   	</head>   
	<body>

		<header>
			<?php include('../../scripts/header.php'); 	// NAVIGUATION BAR ?>
		</header>
	
		<main>

			<?php include('../../scripts/menu_secondaire.php'); // USAGERS MENU ?>

			<h1>Etes vous sur de vouloir supprimer la consultation suivante ?</h1>

			<?php
			$id_c = '';
			if(!empty($_GET['id_c'])) {
			    $id_c = $_GET['id_c'];
			} else {
			    $id_c = $_POST['id_c'];
			}

			showConsultations($id_c, $linkpdo);

			if(isset($_POST["send"])) {
			    $req = $linkpdo->prepare("DELETE FROM consultation WHERE id_c=:id_c");
			    $req->execute(array('id_c' => $id_c)); 

			    echo "CONTACT SUPPRIMÉ";
			    header('Location: rechercher.php');
			}
			?>
			<br>
			<form action="" method="post">
				<input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
				<table>
				    <tr>
				        <input type="submit" name="send" value="Valider la suppression">
				        <button><a href="rechercher.php">Annuler</a></button>
				    </tr>
				</table>
			</form>

			<?php
			function showConsultations($id_c,$linkpdo) {
			    // Sélection de tout le contenu de la table carnet_adresse
			    $req = $linkpdo->prepare("
			    	SELECT consultation.id_c, consultation.date_heure, consultation.duree, usager.nom as nom_usager, usager.prenom as prenom_usager, medecin.nom as nom_medecin, medecin.prenom as prenom_medecin 
					FROM consultation, usager, medecin 
					WHERE id_c=:id_c 
					AND consultation.id_m = medecin.id_m
					AND consultation.id_u = usager.id_u
					ORDER BY consultation.date_heure DESC"
				);

			    $req->execute(array('id_c' => $id_c)); 
			    
			    // Affichage des entrées du résultat une à une
			    echo "<table class=\"tableau_table\">";
			    echo "<tr class=\"tableau_cell_title\">";

			    	echo "<th>Date</th>";
			    	echo "<th>Heure</th>";
			    	echo "<th>Durée</th>";

			        echo "<th>Nom</th>";
			        echo "<th>Prenom</th>";

			        echo "<th>Médecin</th>";
			    echo "</tr>";

			    while ($row = $req->fetch()) {

			    	$jourConsultation = Date('d/m/Y', $row['date_heure']);
			    	
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

			        echo "</tr>";
			    }
			    echo "</table>";
			    $req->closeCursor(); 
			}
			?>
		</main>
		<?php include('../../scripts/footer.php');	// bas de page ?>
	</body>
</html>