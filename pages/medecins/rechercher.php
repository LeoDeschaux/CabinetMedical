<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
$var = '1';																			// A COMPLETER
$type = 'medecin';																	// A COMPLETER
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/menu_secondaire.php'); // MEDECINS MENU
?>
<!DOCTYPE HTML>
<html>	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
      	<link rel="stylesheet" href="/CabinetMedical/styles/rechercher.css">
	</head>

	<body>

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
				$req = $linkpdo->query("SELECT * FROM medecin ORDER BY id_m DESC");
			} else {
				$req = $linkpdo->prepare("SELECT * FROM medecin WHERE nom LIKE :nom OR prenom LIKE :prenom ORDER BY nom, prenom ASC");
			}

		    $req->execute(array(
		    'nom' => $field . "%",
		    'prenom' => $field . "%"));
		    
		    ///Affichage des entrées du résultat une à une
		    echo "<h2>Liste de tous les medecins :</h2>";

		    echo "<table class=\"tableau_table\">";
		    echo "<tr class=\"tableau_cell_title\">";
		        echo "<th>Nom</th>";
		        echo "<th>Prenom</th>";

		        echo "<th>Civilité</th>";
		        
	        	echo "<th>Ajouter consultation</th>";

		        echo "<th>Modifier</th>";
		        echo "<th>Supprimer</th>";
		    echo "</tr>";

		    while ($row = $req->fetch()) {
		    	$id = $row['id_m'];

		        echo "<tr class=\"tableau_cell_title\">";
		            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";

		            echo "<td class=\"tableau_cell\">" . $row['civilite'] . "</td>";

            		echo "<td class=\"tableau_cell\"><a href=\"#\">Ajouter une consultation</a></td>";

		            echo "<td class=\"tableau_cell\"><a href=\"modifier.php?id=$id\">Modifier</a></td>";
	                echo "<td class=\"tableau_cell\"><a href=\"supprimer.php?id=$id\">Supprimer</a></td>";
		        echo "</tr>";
		    }

		    echo "</table>";
		    $req->closeCursor(); 
		}
		?>
	</body>
</html>