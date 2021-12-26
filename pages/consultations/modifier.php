 <?php
$page = 'consultation';																// type de la page
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/menu_secondaire.php'); // CONSULTATION MENU
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/footer.php');			// bas de page	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
    	<link rel="stylesheet" href="/CabinetMedical/styles/modifier.css">
	</head>
	<body>
		<?php 

		$id_c = '';
		$id_u = '';
		$id_m = '';
		$date_heure = '';
		$duree = '';

		$jour_consultation = '';
		$heure_consultation = '';

		if(!empty($_GET['id_c'])) {
			$id_c = $_GET['id_c'];

			$req = $linkpdo->prepare("SELECT * FROM consultation WHERE id_c=:id_c");
			$req->execute(array('id_c' => $id_c));

			while ($row = $req->fetch()) {
		    	$id_m = $row['id_m'];	
		    	$id_u = $row['id_u'];	
		    	$date_heure = $row['date_heure'];	
		    	$duree = $row['duree'];	

		    	$heure_consultation = ((Date('H', $date_heure)*60*60) + Date('i', $date_heure)*60);
		    	$jour_consultation = Date('Y-m-d', ($date_heure-$heure_consultation));  	
		    }
		}

		if(isset($_POST['send'])) {

			$id_u = $_POST['id_u'];
			$id_m = $_POST['id_m'];
			$tmp_date_heure = date("Y-m-d H:i:s", 
				strtotime($_POST['jour_consultation']) + $_POST['heure_consultation']);
			$duree = $_POST['duree_consultation'];

			echo "id_u: " . $id_u . "<br>";
			echo "id_m: " . $id_m . "<br>";
			echo "date_heure: " . $tmp_date_heure . "<br>";
			echo "duree: " . $duree . "<br>";

			//CHECK IF CRENEAU DISPO
			$req = $linkpdo->prepare("
				SELECT * 
				FROM consultation 
				WHERE consultation.id_m=:id_m
				AND consultation.date_heure=:date_heure");
			
			$req->execute(array(
				'id_m' => $_POST['id_m'], 
				'date_heure' => strtotime($tmp_date_heure)));

			//IF CONSULTATION NOT FOUND THEN ADD NEW CONSULTATION
			if($req->rowCount() == 0) {
			    $req = $linkpdo->prepare("
			        UPDATE consultation
			        SET date_heure=:date_heure, duree=:duree, id_m=:id_m, id_u=:id_u 
			        WHERE id_c=:id_c");
			    
			    ///Exécution de la requête
			    $req->execute(array(
				    'date_heure' => strtotime($tmp_date_heure),
				    'duree' => $_POST['duree_consultation'],
				    'id_m' => $_POST['id_m'],
					'id_u' => $_POST['id_u'],
					'id_c' => $id_c));

			    //CHECK IF CONSULTATION ADDED 
				$req = $linkpdo->prepare("
					SELECT * 
					FROM consultation 
					WHERE consultation.id_m=:id_m
					AND consultation.date_heure=:date_heure");
				
				$req->execute(array(
					'id_m' => $_POST['id_m'],
					'date_heure' => strtotime($tmp_date_heure)));
				
				if($req->rowCount() == 1) {
					echo "Consultation Ajoutée";
				} else {
					echo "Erreur, la consultation n'a pas pu être ajoutée";
				}
			}
		}
		?>
		<br>
		<br>
		<form method="post">

			<h2>Usager</h2>

			<p>	
				<select name="id_u" label="nom, prenom">
			    	<option value="" disabled selected hidden>Selectionner un usager</option>
					<?php
			    	///Sélection de tout le contenu de la table carnet_adresse
			    	$req = $linkpdo->query("SELECT * FROM usager ORDER BY nom, prenom");

					while ($row = $req->fetch()) {
				    	if($row['id_u'] == $id_u)
				    		echo "<option value=\"" . $row['id_u'] . "\" selected>"  . $row['nom'] . " " . $row['prenom'] . "</option>";
				    	else
				    		echo "<option value=\"" . $row['id_u'] . "\">"  . $row['nom'] . " " . $row['prenom'] . "</option>";
				    }
					?>
			 	</select>
			</p>

			<p> <label>Nom</label><input type="text" name="nom" placeholder="ex : nom" disabled><br></p>
			<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : prenom" disabled><br></p>
			<p> <label>Médecin référent</label><input type="text" name="medecin_referent" placeholder="ex : medecin" disabled><br></p> <br>

			<hr>

			<h2>Médecin</h2>

			<p>	
				<select name="id_m" label="nom, prenom">
		    	<option value="" disabled selected hidden>Selectionner un médecin</option>

				<?php
		    	///Sélection de tout le contenu de la table carnet_adresse
		    	$req = $linkpdo->query("SELECT * FROM medecin ORDER BY nom, prenom");

				while ($row = $req->fetch()) {
			    	if($row['id_m'] == $id_m)
			    		echo "<option value=\"" . $row['id_m'] . "\"selected>"  . $row['nom'] . " " . $row['prenom'] . "</option>";
			    	else
			    		echo "<option value=\"" . $row['id_m'] . "\">"  . $row['nom'] . " " . $row['prenom'] . "</option>";
			    }
				?>
			 	</select>
			</p>

			<p> <label>Nom</label><input type="text" name="nom" placeholder="ex : nom" disabled><br></p>
			<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : prenom" disabled><br></p>
			<br>

			<hr>

			<h2>Consultation</h2>

			<p> <label>Jour</label><input type="date" name="jour_consultation" value="<?php echo $jour_consultation;?>"><br></p>	
			<p> <label>Durée</label><input type="text" name="duree_consultation" placeholder="ex : 15 minutes"value="<?php echo $duree; ?>"><br></p>

			<p><label>Horaires Disponibles</label>
			<select name="heure_consultation" placeholder="ex : 14h30">
				<?php 
				for($heure = 8; $heure < 18; $heure++) {
					for($minutes = 0; $minutes < 60; $minutes+=5) {
						$tmp_horaire = (($heure*60*60) + $minutes*60);
						if($tmp_horaire == $heure_consultation) {
							echo "<option value=" . $tmp_horaire . " selected>" . date('H\hi', $tmp_horaire) . "&nbsp &nbsp</option>";
						} else {
							echo "<option value=" . $tmp_horaire . ">" . date('H\hi', $tmp_horaire) . "&nbsp &nbsp</option>";
						}	
					}
				}	
				?>
			</select>
			<br>
			<p> 
				<button><a href="/CabinetMedical/pages/consultations/rechercher.php">Annuler</a></button> 
				<button type="submit" name ="send" value="send">Valider la Modification</button> 
			</p>
		</form>
	</body>
</html>