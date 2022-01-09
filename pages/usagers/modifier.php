<?php
$page = 'usager';								// type de la page
$sous_menu = '';
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Cabinet ORDOMEDIC</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
    	<link rel="stylesheet" href="../../styles/modifier.css">
	</head>

	<header>
		<?php include('../../scripts/header.php'); 	// NAVIGUATION BAR ?>
	</header>

	<body>
		<main>
			<?php 

			include('../../scripts/menu_secondaire.php'); // USAGERS MENU

			$nom = '';
			$prenom = '';
			$civilite = '';
			$num_secu = '';
			$adresse = '';
			$cp = '';
			$ville = '';
			$lieu_naissance = '';
			$date_naissance = '';

			$id_u = '';
			$id_m = '';

			if(!empty($_GET['id'])) {
			    $id_u = $_GET['id'];
			} else {
			    $id_u = $_POST['id'];
			}

			$req = $linkpdo->prepare("SELECT * FROM usager WHERE id_u=:id_u");
			$req->execute(array('id_u' => $id_u));

			if($req->rowCount() > 0) {
			    while ($row = $req->fetch()) {
			        $nom = $row['nom'];
					$prenom = $row['prenom'];
					$civilite = $row['civilite'];
					$num_secu = $row['num_secu'];
					$adresse = $row['adresse'];
					$cp = $row['cp'];
					$ville = $row['ville'];
					$lieu_naissance = $row['lieu_naissance'];
					$date_naissance = Date('Y-m-d', $row['date_naissance']);

					$id_m = $row['id_m'];
			    }
			}

			//MODIFICATION
			if(isset($_POST["send"])) {
			    $req = $linkpdo->prepare("
			        UPDATE usager
			        SET nom=:nom, prenom=:prenom, civilite=:civilite, num_secu=:num_secu, adresse=:adresse, cp=:cp, ville=:ville, lieu_naissance=:lieu_naissance, date_naissance=:date_naissance, id_m=:id_m
			        WHERE id_u=:id_u");

			    ///Exécution de la requête
			    $req->execute(array(
			    'id_u' => $id_u,
			    'nom' => $_POST['nom'],
			    'prenom' => $_POST['prenom'],
			    'civilite' => $_POST['civilite'],
			    'num_secu' => $_POST['num_secu'],
			    'adresse' => $_POST['adresse'],
			    'cp' => $_POST['cp'],
			    'ville' => $_POST['ville'],
			    'lieu_naissance' => $_POST['lieu_naissance'],
			    'date_naissance' => strtotime($_POST['date_naissance']),
				'id_m' => $_POST['id_m']
				));

			    $nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$civilite = $_POST['civilite'];
				$num_secu = $_POST['num_secu'];
				$adresse = $_POST['adresse'];
				$cp = $_POST['cp'];
				$ville = $_POST['ville'];
				$lieu_naissance = $_POST['lieu_naissance'];
				$date_naissance = $_POST['date_naissance'];

				$id_m = $_POST['id_m'];

			    echo "*modifications* <br>";
			    header('Location: rechercher.php');
			}
			?>
			
			<div class="fiche_inscription">
				
			<form method="post">

				<input type="hidden" name="id_u" value="<?php echo $id_u; ?>">
				
				<p><label>Nom</label><input type="text" name="nom" placeholder="ex : BROISIN" value="<?php echo $nom; ?>"><br> </p>
				<p><label>Prenom</label><input type="text" name="prenom" placeholder="ex : Julien" value="<?php echo $prenom; ?>"><br> </p>
				<br>
				<p>
				<label>Civilité</label>
				<select name="civilite">
			    	<option value="M" <?php if($civilite=="M") echo "selected"?>>Monsieur</option>
			    	<option value="Mme" <?php if($civilite=="Mme") echo "selected"?>>Madame</option>
			    	<option value="Mlle" <?php if($civilite=="Mlle") echo "selected"?>>Mademoiselle</option>
			  	</select>
				</p>
				<p><label>Numéro de sécurité social</label><input type="text" name="num_secu" placeholder="ex : 0123456789" value="<?php echo $num_secu; ?>"><br></p>
				<br>
				<p><label>Adresse</label><input type="text" name="adresse" placeholder="ex : 18 rue des coquelicot" value="<?php echo $adresse; ?>"><br></p>
				<p><label>Code Postal</label><input type="text" name="cp" placeholder="ex : 31300" value="<?php echo $cp; ?>"><br></p>
				<p><label>Ville</label><input type="text" name="ville" placeholder="ex : Toulouse" value="<?php echo $ville; ?>"><br></p>
				<br>
				<p><label>Lieu de naissance</label><input type="text" name="lieu_naissance" placeholder="ex : Toulouse" value="<?php echo $lieu_naissance; ?>"><br></p>
				<p><label>Date de naissance</label><input type="date" name="date_naissance" placeholder="ex : 01/01/1990" value="<?php echo $date_naissance; ?>"><br></p>
				<br>

				<?php
					echo "<p>";
					echo "<label>Médecin référent</label>";
					echo "<select name=\"id_m\"*>";

			    	///Sélection de tout le contenu de la table carnet_adresse
			    	$req = $linkpdo->query("SELECT * FROM medecin ORDER BY nom");

			    	echo "<option value=\"0\"></option>";

					while ($row = $req->fetch()) {
				    	if($id_m == $row['id_m']) {
				    		echo "<option value=\"" . $row['id_m'] . "\"selected>"  . $row['nom'] . " " . $row['prenom'] . "</option>";
				    	} else {
				    		echo "<option value=\"" . $row['id_m'] . "\">"  . $row['nom'] . " " . $row['prenom'] . "</option>";
				    	}
				    }

				  	echo "</select>";
					echo "</p>";
				?>
				<br>
				<p>
				<button type="submit" name ="send" value="send"><a href=""></a>Valider les modifications</button>
				<button><a href="rechercher.php">Annuler</a></button>
				</p>
			</form>
			</div>
		</main>
		<?php include('../../scripts/footer.php');	// bas de page ?>
	</body>
</html>