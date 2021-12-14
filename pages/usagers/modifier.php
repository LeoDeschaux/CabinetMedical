<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
$var = '1';		
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR	
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/usagersMenu.php'); 	// USAGERS MENU											
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
		$nom = '';
		$prenom = '';
		$civilite = '';
		$num_secu = '';
		$adresse = '';
		$cp = '';
		$ville = '';
		$lieu_naissance = '';
		$date_naissance = '';

		$id = '';

		if(!empty($_GET['id'])) {
		    $id = $_GET['id'];
		} else {
		    $id = $_POST['id'];
		}

		$req = $linkpdo->prepare("SELECT * FROM usager WHERE id_u=:id");
		$req->execute(array('id' => $id));

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
		    }
		}

		//MODIFICATION
		if(isset($_POST["send"])) {
		    $req = $linkpdo->prepare("
		        UPDATE usager
		        SET nom=:nom, prenom=:prenom, civilite=:civilite, num_secu=:num_secu, adresse=:adresse, cp=:cp, ville=:ville, lieu_naissance=:lieu_naissance, date_naissance=:date_naissance
		        WHERE id_u=:id");

		    ///Exécution de la requête
		    $req->execute(array(
		    'id' => $id,
		    'nom' => $_POST['nom'],
		    'prenom' => $_POST['prenom'],
		    'civilite' => $_POST['civilite'],
		    'num_secu' => $_POST['num_secu'],
		    'adresse' => $_POST['adresse'],
		    'cp' => $_POST['cp'],
		    'ville' => $_POST['ville'],
		    'lieu_naissance' => $_POST['lieu_naissance'],
		    'date_naissance' => strtotime($_POST['date_naissance'])));

		    $nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$civilite = $_POST['civilite'];
			$num_secu = $_POST['num_secu'];
			$adresse = $_POST['adresse'];
			$cp = $_POST['cp'];
			$ville = $_POST['ville'];
			$lieu_naissance = $_POST['lieu_naissance'];
			$date_naissance = $_POST['date_naissance'];

		    echo "*modifications* <br>";
		    header('Location: /CabinetMedical/pages/usagers/rechercher');
		}
		?>
			
		<form method="post">

			<input type="hidden" name="id" value="<?php echo $id; ?>">
			
			<p><label>Nom</label><input type="text" name="nom" placeholder="ex : BROISIN" value="<?php echo $nom; ?>"><br></p>
			<p><label>Prenom</label><input type="text" name="prenom" placeholder="ex : Julien" value="<?php echo $prenom; ?>"><br></p>
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
				echo "<select name=\"medecin_referent\"*>";

		    	///Sélection de tout le contenu de la table carnet_adresse
		    	$req = $linkpdo->query("SELECT * FROM medecin ORDER BY nom");

		    	echo "<option value=\"clef\"></option>";

				while ($row = $req->fetch()) {
			    	if($id_medecin_referent == $row['id_m']) {
			    		echo "<option value=\"" . $row['id_m'] . "\">"  . $row['nom'] . " " . $row['prenom'] . "</option>";
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
			<button><a href="/CabinetMedical/pages/usagers/rechercher.php">Annuler</a></button>
			</p>
			
		</form>
	</body>
</html>