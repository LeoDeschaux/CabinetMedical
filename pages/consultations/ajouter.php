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
		?>

		<?php 
		$id_u = "";
		if(!empty($_GET['id_u'])) {
	    	$id_u = $_GET['id_u'];
		} 
		elseif(isset($_POST['id_u'])) {
		    $id_u = $_POST['id_u'];
		}

		$id_m = "";
		$req = $linkpdo->prepare("SELECT id_m FROM usager WHERE id_u=:id_u");
		$req->execute(array('id_u' => $id_u));
		while ($row = $req->fetch()) {
	    	$id_m = $row['id_m'];	
	    }


		if(isset($_POST['search_button']))
		{
		}
		elseif(isset($_POST['send'])) 
		{

			$id_m = $_POST['id_m'];

			$jour = $_POST['jour_consultation'];
			$duree = $_POST['duree_consultation'];
			$heure = $_POST['heure_consultation'];

		    createConsultation($linkpdo, $id_u, $id_m, $jour, $duree, $heure);
		}
		else
		{
		}
		?>


		<?php

		function createConsultation($linkpdo, $id_u, $id_m, $jour, $duree, $heure)
		{
			if(empty($id_u) || empty($id_m))
			{
				echo "L'usager ou le médecin est vide";
				return;
			}

			//GET ROW COUNT 
			$req = $linkpdo->query("SELECT * FROM consultation");
			$my_row_count = $req->rowCount();
			$date_heure = date("Y-m-d H:i:s", strtotime($jour) + $heure);
			$duree_consultation = $duree * 60;

			//CHECK IF CRENEAU DISPO
			$req = $linkpdo->prepare("
					SELECT * 
					FROM consultation 
					WHERE consultation.id_m=:id_m
					
					AND ((consultation.date_heure BETWEEN :date_heure AND (:date_heure+:duree_consultation))

					OR ((consultation.date_heure + consultation.duree) BETWEEN :date_heure AND (:date_heure+:duree_consultation))

					OR (:date_heure BETWEEN consultation.date_heure AND (consultation.date_heure + consultation.duree)))");

			$req->execute(array(
					'id_m' => $id_m, 
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
					    'id_m' => $id_m,
						'id_u' => $id_u));
			}

			$req = $linkpdo->query("SELECT * FROM consultation");

				while ($row = $req->fetch()) {
			    	$id_m = $row['id_m'];	
			    }
			}
		?>





















		<form method="post">
		<h2>Usager</h2>

		<input type="hidden" name="id_u" value="<?php echo $id_u;?>">	

		<input type="text" name="search" placeholder="nom, prenom, etc.">
		<button type="submit" name="search_button" value="search_button">Rechercher</button>

		<?php

		if(isset($_POST['search_button']))
		{
			showUsagers($linkpdo);
		}	

		function showUsagers($linkpdo) 
		{
			$field = "";

			if(isset($_POST['search']))
				$field = $_POST['search'];

			$req = $linkpdo->prepare("
				SELECT * 
				FROM usager 
				WHERE nom LIKE :nom 
				OR prenom LIKE :prenom 
				OR adresse LIKE :adresse 
				OR cp LIKE :cp 
				OR ville LIKE :ville 
				ORDER BY nom, prenom ASC");

		    $req->execute(array(
		    'nom' => $field . "%",
		    'prenom' => $field . "%",
		    'adresse' => $field . "%",
		    'cp' => $field . "%",
		    'ville' => $field . "%"));
		    
		    $medecin_referent = "null";

		     // Affichage des entrées du résultat une à une
		    echo "<table class=\"tableau_table\">";
		    echo "<tr class=\"tableau_cell_title\">";

		        echo "<th>Nom</th>";
		        echo "<th>Prenom</th>";

		        echo "<th>Médecin référent</th>";

		        echo "<th>Selectionner</th>";
		    echo "</tr>";

		    while ($row = $req->fetch()) {
		    	$id_u = $row['id_u'];
		    	if(!empty($row['id_m'])) {
			    	$req_medecin = $linkpdo->prepare("SELECT medecin.nom, medecin.prenom FROM medecin, usager WHERE medecin.id_m=:id_m");

			    	$req_medecin->execute(array(
			    		'id_m' => $row['id_m'] ));

			    	while($medecin_row = $req_medecin->fetch()) {
			    		$medecin_referent = $medecin_row['nom'] . " " . $medecin_row['prenom']; 
			    	}
		    	}
		        echo "<tr class=\"tableau_cell_title\">";
		            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";

		            echo "<td class=\"tableau_cell\">" . $medecin_referent . "</td>";

            		echo "<td class=\"tableau_cell\"><a href=\"../consultations/ajouter.php?id_u=$id_u\">Selectionner</a></td>";
		        echo "</tr>";
		    }
		    echo "</table>";
		    $req->closeCursor(); 
		}
		?>

		<hr>
			<br>

			<?php
			$nom = "";
			$prenom = "";
			$medecin_ref = "";
			$id_u = "";
			$id_medecin_ref = "";

			if(isset($_GET['id_u']))
			{
				$id_u = $_GET['id_u'];

				$req = $linkpdo->prepare("
				SELECT *
				FROM usager
				WHERE id_u=:id_u");
				$req->execute(array("id_u"=>$id_u));

				while($row = $req->fetch())
				{
					$nom = $row['nom'];
					$prenom = $row['prenom'];
					$id_medecin_ref = $row['id_m'];
				}

				$req = $linkpdo->prepare("
				SELECT *
				FROM medecin
				WHERE medecin.id_m=:id_m");
				$req->execute(array("id_m"=> $id_medecin_ref));
				while($row = $req->fetch())
				{
					$medecin_ref = $row['nom'] . " " . $row['prenom'];
				}
			}
			?>

			<p> <label>Nom</label><input type="text" name="nom" placeholder="ex: nom" value="<?php echo $nom;?>"
			<?php if(empty($nom)) echo "disabled"; else echo "readonly"?> 
			><br></p>

			<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : prenom"
			value="<?php echo $prenom;?>"
			<?php if(empty($prenom)) echo "disabled"; else echo "readonly"?> 
			><br></p>

			<p> <label>Médecin référent</label><input type="text" name="medecin_referent" placeholder="ex : medecin"
			value="<?php echo $medecin_ref;?>"
			<?php if(empty($medecin_ref)) echo "disabled"; else echo "readonly"?> 
			><br></p><br>

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

			<br>

			<h2>Consultation</h2>

			<p> <label>Jour</label><input type="date" name="jour_consultation" value="<?php echo date('Y-m-d');?>"><br></p>		
			<p> <label>Durée</label><input type="number" min="5" max="120" step="5" name="duree_consultation" value="30">minutes<br></p>

			<p><label>Horaires Disponibles</label>
				<select name="heure_consultation" placeholder="ex : 14h30">
					<?php 
					for($heure = 8; $heure < 18; $heure++) {
						for($minutes = 0; $minutes < 60; $minutes+=5) {
							echo "<option value=" . (($heure*60*60) + $minutes*60) . ">" . date('H\hi', (($heure*60*60) + $minutes*60)) . 
								"&nbsp &nbsp</option>";
						}
					}	
					?>
				</select>
			<br>
			<p> 
				<button><a href="rechercher.php">Annuler</a></button> 
				<button type="submit" name ="send" value="send">Valider la consultation</button> 
			</p>
		</form>
		</main>
	</body>

	<?php
		include('../../scripts/footer.php');  // bas de page
	?>
</html>