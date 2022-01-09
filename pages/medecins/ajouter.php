<?php
$page = 'medecin';																	// type de la page	
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
include('../../scripts/header.php'); 			// NAVIGUATION BAR
include('../../scripts/menu_secondaire.php'); // USAGERS MENU
include('../../scripts/footer.php');			// bas de page
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
    	<link rel="stylesheet" href="../../styles/ajouter.css">
	</head>

	<body>
		<!-- ///////////////////// FORMULAIRE //////////////////// -->
		<?php 

		$nom = '';
		$prenom = '';
		$civilite = '';

		if(isset($_POST['send'])) {
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$civilite = $_POST['civilite'];

			// CHECK IF USAGER EXIST 
			$req = $linkpdo->prepare("SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom");
			$req->execute(array('nom' => $nom, 'prenom' => $prenom));

			// IF USAGER NOT FOUND THEN ADD NEW USAGER
			if($req->rowCount() == 0) {
			    $req = $linkpdo->prepare("
			        INSERT INTO medecin(nom, prenom, civilite) 
			        VALUES(:nom, :prenom, :civilite)");
			    
			    // Exécution de la requête
			    $req->execute(array(
			    'nom' => $nom,
			    'prenom' => $prenom,
			    'civilite' => $civilite));

			    // CHECK IF USAGER ADDED 
				$req = $linkpdo->prepare("SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom");
				$req->execute(array('nom' => $nom, 'prenom' => $prenom));
				if($req->rowCount() == 1) {
					echo "Medecin Ajouté";
				} else {
					echo "Erreur, certains champs sont faux";
				}
			}
		}
		?>
		<br>
		<br>
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
			<br>
			<br>
			<p> 
				<button><a href="rechercher.php">Annuler</a></button> 
				<button type="submit" name ="send" value="send">Ajouter</button> 
			</p>
		</form>
	</body>
</html>