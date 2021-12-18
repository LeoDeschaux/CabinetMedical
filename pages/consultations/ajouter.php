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

				<h2>Usager</h2>

				<p>	
				<input list="brow" placeholder="nom, prenom">
				<datalist id="brow">
				  <option value="Usager 1">
				  <option value="Usager 2">
				</datalist>  

				<!-- BOUTON AJOUTER USAGER
				<style type="text/css">
				.button{
					background: lightgreen;
					color: black;
					border: black 1px solid;
					border-radius: 12px;

					padding: 6px;
					margin: 10px;
				}

				</style>

				<a href="#" class="button" style="display: table-cell";>Ajouter un nouvel usager</a>	
				</p>
				-->

				<p> <label>Nom</label><input type="text" name="nom" placeholder="ex : nom" disabled><br></p>
				<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : prenom" disabled><br></p>
				<p> <label>Médecin référent</label><input type="text" name="medecin_referent" placeholder="ex : medecin" disabled><br></p>
				<br>
			</form>
		</div>

		<hr>

		<div class="fiche_inscription">
			<form method="post">

				<h2>Médecin</h2>

				<p>	
				<input list="brow2" placeholder="nom, prenom">
				<datalist id="brow2">
				  <option value="Medecin 1">
				  <option value="Medecin 2">
				</datalist>  
				</p>

				<p> <label>Nom</label><input type="text" name="nom" placeholder="ex : nom" disabled><br></p>
				<p> <label>Prenom</label><input type="text" name="prenom" placeholder="ex : prenom" disabled><br></p>
				<br>
			</form>
		</div>

		<hr>

		<div class="fiche_inscription">
			<form method="post">

				<h2>Consultation</h2>
				<p> <label>Jour</label><input type="date" name="nom" placeholder="ex : BROISIN"><br></p>
				
				<p> <label>Durée</label><input type="text" name="prenom" placeholder="ex : 15 minutes"><br></p>

				<p><label>Horaires Disponibles</label>
				<select name="horaire" placeholder="ex : 14h30">
					<option value="">14h20</option>
					<option value="">14h30</option>
				</select>
				<br>
				</p>
				
				<br>

			</form>
		</div>

		<p> 
			<input type="reset" value="Annuler la consultation"> 
			<button type="submit" name ="send" value="send">Valider la consultation</button> 
		</p>

	</body>
</html>