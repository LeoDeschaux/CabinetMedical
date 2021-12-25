<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
$var = '1';	
$type = 'usager';				
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/footer.php');
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/menu_secondaire.php'); // USAGERS MENU
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
    	<link rel="stylesheet" href="/CabinetMedical/styles/ajouter.css">
    	<link rel="stylesheet" href="/CabinetMedical/styles/footer.css">
	</head>

	<body>
		<!-- ///////////////////// FORMULAIRE //////////////////// -->
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

		if(isset($_POST['send'])) {
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$civilite = $_POST['civilite'];
			$num_secu = $_POST['num_secu'];
			$adresse = $_POST['adresse'];
			$cp = $_POST['cp'];
			$ville = $_POST['ville'];
			$lieu_naissance = $_POST['lieu_naissance'];
			$date_naissance = $_POST['date_naissance'];

			//CHECK IF USAGER EXIST 
			$req = $linkpdo->prepare("SELECT * FROM usager WHERE nom=:nom AND prenom=:prenom");
			$req->execute(array('nom' => $nom, 'prenom' => $prenom));

			//IF USAGER NOT FOUND THEN ADD NEW USAGER
			if($req->rowCount() == 0) {
			    $req = $linkpdo->prepare("
			        INSERT INTO usager(nom, prenom, civilite, num_secu, adresse, 
			        cp, ville, lieu_naissance, date_naissance) 
			        VALUES(:nom, :prenom, :civilite, :num_secu, :adresse, :cp, :ville, :lieu_naissance, :date_naissance)");
			    
			    $date_naissance = strtotime($date_naissance);
			    
			    ///Exécution de la requête
			    $req->execute(array(
			    'nom' => $nom,
			    'prenom' => $prenom,
			    'civilite' => $civilite,
			    'num_secu' => $num_secu,
			    'adresse' => $adresse,
			    'cp' => $cp,
			    'ville' => $ville,
			    'lieu_naissance' => $lieu_naissance,
				'date_naissance' => $date_naissance));

			    //CHECK IF USAGER ADDED 
				$req = $linkpdo->prepare("SELECT * FROM usager WHERE nom=:nom AND prenom=:prenom");
				$req->execute(array('nom' => $nom, 'prenom' => $prenom));
				if($req->rowCount() == 1) {
					echo "Usager Ajouté";
				} else {
					echo "Erreur, certains champs sont faux";
				}
			}
		}
		?>

		<br>
		<br>
		<div class="fiche_inscription">
			<form method="post">
				<p> <label>Nom</label><input type="text" name="nom" placeholder="ex : BROISIN"><br> </p>
				<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : Julien"><br> </p>
				<br>
				<p>
				<label>Civilité</label>
				<select name="civilite"*>
				   	<option value="M">Monsieur</option>
				   	<option value="Mme">Madame</option>
				   	<option value="Mlle">Mademoiselle</option>
				</select>
				</p>
				<p> <label>N° de sécurité social</label><input type="text" name="num_secu" placeholder="ex : 0123456789"><br> </p>
				<br>
				<p> <label>Adresse</label><input type="text" name="adresse" placeholder="ex : 18 rue des coquelicot"><br> </p>
				<p> <label>Code Postal</label><input type="text" name="cp" placeholder="ex : 31300"><br> </p>
				<p> <label>Ville</label><input type="text" name="ville" placeholder="ex : Toulouse"><br> </p>
				<br>
				<p> <label>Lieu de naissance</label><input type="text" name="lieu_naissance" placeholder="ex : Toulouse"><br> </p>
				<p> <label>Date de naissance</label><input type="date" name="date_naissance" placeholder="ex : 01/01/1990"><br> </p>
				<br>
				<?php
				echo "<p>";
				echo "<label>Médecin référent</label>";
				echo "<select name=\"medecin_referent\"*>";

			    ///Sélection de tout le contenu de la table carnet_adresse
			    $req = $linkpdo->query("SELECT * FROM medecin ORDER BY nom");

		    	echo "<option value=\"clef\"></option>";

				while ($row = $req->fetch()) {
				    	echo "<option value=\"" . $row['id_m'] . "\">"  . $row['nom'] . " " . $row['prenom'] . "</option>";
				}
				echo "</select>";
				echo "</p>";
				?>
				<br>
				<p> 
				<input type="reset" value="Vider les champs"> 
				<button><a href="/CabinetMedical/pages/usagers/rechercher.php">Retour</a></button>
				<button type="submit" name ="send" value="send">Ajouter</button> 
				</p>
			</form>
		</div>
	</body>
</html>