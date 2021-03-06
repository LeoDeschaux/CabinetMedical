<?php
$page = 'usager';								// type de la page
$sous_menu = 'rechercher';							// permet de mettre le sous menue Rechercher un usager en surbrillance
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
?>
<!DOCTYPE HTML>
<html>	
	<head>
		<title>Cabinet ORDOMEDIC</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
      	<link rel="stylesheet" href="../../styles/rechercher.css">
	</head>

	<body>

		<header>
			<?php include('../../scripts/header.php'); 	// NAVIGUATION BAR ?>
		</header>

		<main>
			<?php include('../../scripts/menu_secondaire.php'); // USAGERS MENU ?>	
			<br>
			<form method="post">
				<input type="text" name="search" placeholder="nom, prenom, etc.">
				<button type="submit" name="send" value="send">Rechercher</button> <br>
			</form>
			<br>

			<?php
			onFieldChange($linkpdo);

			function onFieldChange($linkpdo)
			{
				showUsagers($linkpdo);
			}

			function showUsagers($linkpdo) {

				$field = "";

				if(isset($_POST['search']))
					$field = $_POST['search'];

				if(empty($field)) {
					$req = $linkpdo->query("SELECT * FROM usager ORDER BY id_u DESC");
				} else {
					$req = $linkpdo->prepare("SELECT * FROM usager WHERE nom LIKE :nom OR prenom LIKE :prenom OR adresse LIKE :adresse OR cp LIKE :cp OR ville LIKE :ville ORDER BY nom, prenom ASC");
				}

			    $req->execute(array(
			    'nom' => $field . "%",
			    'prenom' => $field . "%",
			    'adresse' => $field . "%",
			    'cp' => $field . "%",
			    'ville' => $field . "%"));
			    
			    ///Affichage des entrées du résultat une à une
			    echo "<h2>Liste de tous les contacts :</h2>";

			    echo "<table class=\"tableau_table\">";
			    echo "<tr class=\"tableau_cell_title\">";
			        echo "<th>Nom</th>";
			        echo "<th>Prenom</th>";

			        echo "<th>Civilité</th>";
			        echo "<th>Num Sécu</th>";
			        
			        echo "<th>Adresse</th>";
			        echo "<th>CP</th>";
			        echo "<th>Ville</th>";
			        
			        echo "<th>Lieu de naissance</th>";
			        echo "<th>Date de naissance</th>";

			        echo "<th>Médecin Référent</th>";
		        	echo "<th>Ajouter consultation</th>";

			        echo "<th>Modifier</th>";
			        echo "<th>Supprimer</th>";
			    echo "</tr>";

			    $medecin_referent = "null";

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

			            echo "<td class=\"tableau_cell\">" . $row['civilite'] . "</td>";
						echo "<td class=\"tableau_cell\">" . $row['num_secu'] . "</td>";
			            
			            echo "<td class=\"tableau_cell\">" . $row['adresse'] . "</td>";
			            echo "<td class=\"tableau_cell\">" . $row['cp'] . "</td>";
			            echo "<td class=\"tableau_cell\">" . $row['ville'] . "</td>";

			            echo "<td class=\"tableau_cell\">" . $row['lieu_naissance'] . "</td>";
			            echo "<td class=\"tableau_cell\">" . Date("d/m/Y", $row['date_naissance']). "</td>";

			            echo "<td class=\"tableau_cell\">" . $medecin_referent . "</td>";

	            		echo "<td class=\"tableau_cell\"><a href=\"../consultations/ajouter.php?id_u=$id_u\">Ajouter une consultation</a></td>";

			            echo "<td class=\"tableau_cell\"><a href=\"modifier.php?id=$id_u\">Modifier</a></td>";
		                echo "<td class=\"tableau_cell\"><a href=\"supprimer.php?id_u=$id_u\">Supprimer</a></td>";
			        echo "</tr>";
			    }
			    echo "</table>";
			    $req->closeCursor(); 
			}
			?>
		</main>

		<?php include('../../scripts/footer.php'); // bas de page ?>

	</body>
	
</html>
