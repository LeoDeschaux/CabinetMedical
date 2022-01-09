<?php
$page = 'consultation';							// type de la page
$sous_menu = 'ajouter';							// permet de mettre le sous menue Ajouter une consultation en surbrillance
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Cabinet ORDOMEDIC</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
    	<link rel="stylesheet" href="../../styles/modifier.css">
	<body>

		<header>
			<?php include('../../scripts/header.php'); 	// NAVIGUATION BAR ?>
		</header>

		<main>
			<?php 

			include('../../scripts/menu_secondaire.php'); // USAGERS MENU

			$id_u = '';
			$id_m = '';
			$date_heure = '';
			$duree_consultation = '';

			if(!empty($_GET['id_u'])) {
				$id_u = $_GET['id_u'];

				$req = $linkpdo->prepare("SELECT id_m FROM usager WHERE id_u=:id_u");
				$req->execute(array('id_u' => $id_u));

				while ($row = $req->fetch()) {
			    	$id_m = $row['id_m'];	
			    }
			}

			if(isset($_POST['send'])) {
				//GET ROW COUNT 
				$req = $linkpdo->query("SELECT * FROM consultation");
				$my_row_count = $req->rowCount();

				$id_u = $_POST['id_u'];
				$id_m = $_POST['id_m'];
				$date_heure = date("Y-m-d H:i:s", strtotime($_POST['jour_consultation']) + $_POST['heure_consultation']);
				$duree_consultation = $_POST['duree_consultation'] * 60;

				//CHECK IF CRENEAU DISPO
				$req = $linkpdo->prepare("
						SELECT * 
						FROM consultation 
						WHERE consultation.id_m=:id_m
						
						AND ((consultation.date_heure BETWEEN :date_heure AND (:date_heure+:duree_consultation))

						OR ((consultation.date_heure + consultation.duree) BETWEEN :date_heure AND (:date_heure+:duree_consultation))

						OR (:date_heure BETWEEN consultation.date_heure AND (consultation.date_heure + consultation.duree)))");

				$req->execute(array(
						'id_m' => $_POST['id_m'], 
						'date_heure' => strtotime($date_heure),
						'duree_consultation' => $duree_consultation));

				//IF CONSULTATION NOT FOUND THEN ADD NEW CONSULTATION
				if($req->rowCount() == 0) {
				    $req = $linkpdo->prepare("
				        INSERT INTO consultation(date_heure, duree, id_m, id_u) 
				        VALUES(:date_heure, :duree, :id_m, :id_u)");
					    
				    ///Exécution de la requête
				    $req->execute(array(
						    'date_heure' => strtotime($date_heure),
						    'duree' => ($_POST['duree_consultation'] * 60),
						    'id_m' => $_POST['id_m'],
							'id_u' => $_POST['id_u']));
				}

				$req = $linkpdo->query("SELECT * FROM consultation");

				if($req->rowCount() == ($my_row_count + 1)) {
					echo "Consultation Ajoutée";
				} else {
					echo "Erreur, la consultation n'a pas pu être ajoutée car le créneau est indisponible";
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
				<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : prenom" disabled><br></p> <br>

				<hr>

				<h2>Consultation</h2>

				<p> <label>Jour</label><input type="date" name="jour_consultation" value="<?php echo date('Y-m-d');?>"><br></p>		
				<p> <label>Durée</label><input type="number" min="5" max="120" step="5" name="duree_consultation" value="30">minutes<br></p>

				<p><label>Horaires Disponibles</label>
					<select name="heure_consultation" >
						<?php 
						for($heure = 8; $heure < 18; $heure++) {
							for($minutes = 0; $minutes < 60; $minutes+=5) {
								echo "<option value=" . (($heure*60*60) + $minutes*60) . ">" . date('H\hi', (($heure*60*60) + $minutes*60)) . 
									"&nbsp &nbsp</option>";
							}
						}	
						?>
					</select>
				</p>
				<br>
				<p> 
					<button><a href="rechercher.php">Annuler</a></button> 
					<button type="submit" name ="send" value="send">Valider la consultation</button> 
				</p>
			</form>
		</main>
		<?php include('../../scripts/footer.php');	// bas de page ?>
	</body>
</html>