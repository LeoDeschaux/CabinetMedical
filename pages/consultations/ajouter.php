<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
$var = '1';		
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR
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
	<!-- ///////////////////// FORMULAIRE //////////////////// -->
	<?php 

		$id_u = '';
		$id_m = '';
		$date_heure = '';
		$duree = '';

		if(!empty($_GET['id_u']))
		{
			$id_u = $_GET['id_u'];

			$req = $linkpdo->prepare("SELECT id_m FROM usager WHERE id_u=:id_u");
			$req->execute(array('id_u' => $id_u));

			while ($row = $req->fetch())
		    {
		    	$id_m = $row['id_m'];	
		    }

		    echo "id_m: " . $id_m;
		}

		if(isset($_POST['send'])) {

			$id_u = $_POST['id_u'];
			$id_m = $_POST['id_m'];
			$date_heure = date("Y-m-d H:i:s", 
				strtotime($_POST['jour_consultation']) + $_POST['heure_consultation']);
			$duree = $_POST['duree_consultation'];

			echo "id_u: " . $id_u . "<br>";
			echo "id_m: " . $id_m . "<br>";
			echo "date_heure: " . $date_heure . "<br>";
			echo "duree: " . $duree . "<br>";

			echo "<br>";
			echo "heure: " . date('H\hi', $_POST['heure_consultation']) . "<br>";

			//CHECK IF CRENEAU DISPO
			$req = $linkpdo->prepare("
				SELECT * 
				FROM consultation 
				WHERE consultation.id_m=:id_m
				AND consultation.date_heure=:date_heure
			");
			
			$req->execute(array(
				'id_m' => $_POST['id_m'], 
				'date_heure' => strtotime($date_heure)
			));

			//IF CONSULTATION NOT FOUND THEN ADD NEW CONSULTATION
			if($req->rowCount() == 0) {
			    $req = $linkpdo->prepare("
			        INSERT INTO consultation(date_heure, duree, id_m, id_u) 
			        VALUES(:date_heure, :duree, :id_m, :id_u)");
			    
			    ///Exécution de la requête
			    $req->execute(array(
				    'date_heure' => strtotime($date_heure),
				    'duree' => $_POST['duree_consultation'],
				    'id_m' => $_POST['id_m'],
					'id_u' => $_POST['id_u']
				));

			    //CHECK IF CONSULTATION ADDED 
				$req = $linkpdo->prepare("
					SELECT * 
					FROM consultation 
					WHERE consultation.id_m=:id_m
					AND consultation.date_heure=:date_heure
				");
				
				$req->execute(array(
					'id_m' => $_POST['id_m'],
					'date_heure' => strtotime($date_heure)
				));
				
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

		<div class="fiche_inscription">
			<form method="post">

				<h2>Usager</h2>

				<p>	
				<select name="id_u" label="nom, prenom">
		    	<option value="" disabled selected hidden>Selectionner un usager</option>

				<?php
		    	///Sélection de tout le contenu de la table carnet_adresse
		    	$req = $linkpdo->query("SELECT * FROM usager ORDER BY nom, prenom");

				while ($row = $req->fetch())
			    {
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
				<p> <label>Médecin référent</label><input type="text" name="medecin_referent" placeholder="ex : medecin" disabled><br></p>
				<br>

		<hr>


				<h2>Médecin</h2>

				<p>	
				<select name="id_m" label="nom, prenom">
		    	<option value="" disabled selected hidden>Selectionner un médecin</option>

				<?php
		    	///Sélection de tout le contenu de la table carnet_adresse
		    	$req = $linkpdo->query("SELECT * FROM medecin ORDER BY nom, prenom");

				while ($row = $req->fetch())
			    {
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

				<p> <label>Jour</label><input type="date" name="jour_consultation" placeholder="ex : BROISIN"><br></p>
				
				<p> <label>Durée</label><input type="text" name="duree_consultation" placeholder="ex : 15 minutes"><br></p>



				<p><label>Horaires Disponibles</label>
				<select name="heure_consultation" placeholder="ex : 14h30">

				<?php 
					for($heure = 8; $heure < 18; $heure++)
					{
						for($minutes = 0; $minutes < 60; $minutes+=5)
						{
							echo 
							"<option value=" . (($heure*60*60) + $minutes*60) . ">" . date('H\hi', (($heure*60*60) + $minutes*60)) . 
							"&nbsp &nbsp</option>";
						}
					}	
				?>

				</select>

			</div>
				
				<br>

				<p> 
					<input type="reset" value="Annuler la consultation"> 
					<button type="submit" name ="send" value="send">Valider la consultation</button> 
				</p>
		</form>

	</body>
</html>