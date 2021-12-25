<?php
$page = 'usager';																	// type de la page
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 	// Session Start 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php'); 			// NAVIGUATION BAR
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/menu_secondaire.php'); // USAGERS MENU
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/footer.php');			// bas de page
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/CabinetMedical/styles/defaut.css">
   	    <link rel="stylesheet" href="/CabinetMedical/styles/supprimer.css">
   	</head>   
	<body>
	
		<h1>Etes vous sur de vouloir supprimer l'usager suivant ?</h1>

		<?php
		$id = '';
		if(!empty($_GET['id'])) {
		    $id = $_GET['id'];
		} else {
		    $id = $_POST['id'];
		}

		showUsager($id,$linkpdo);

		if(isset($_POST["send"])) {
		    $req = $linkpdo->prepare("DELETE FROM usager WHERE id_u=:id");
		    $req->execute(array('id' => $id)); 

		    echo "CONTACT SUPPRIMÉ";
		    header('Location: /CabinetMedical/pages/usagers/rechercher.php');
		}
		?>
		<br>
		<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<table>
			    <tr>
			        <td><input type="submit" name="send" value="VALIDER LA SUPPRESSION"></td>
			        <button><a href="/CabinetMedical/pages/usagers/rechercher.php">Annuler</a></button>
			    </tr>
			</table>
		</form>

		<?php
		function showUsager($id,$linkpdo) {
		    ///Sélection de tout le contenu de la table carnet_adresse
		    $req = $linkpdo->prepare("SELECT * FROM usager WHERE id_u=:id");
		    $req->execute(array('id' => $id)); 
		    
		    ///Affichage des entrées du résultat une à une
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
		    echo "</tr>";

		    while ($row = $req->fetch()) {
		    	$id = $row['id_u'];
		        echo "<tr class=\"tableau_cell_title\">";
		            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";

		            echo "<td class=\"tableau_cell\">" . $row['civilite'] . "</td>";
					echo "<td class=\"tableau_cell\">" . $row['num_secu'] . "</td>";
		            
		            echo "<td class=\"tableau_cell\">" . $row['adresse'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['cp'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . $row['ville'] . "</td>";

		            echo "<td class=\"tableau_cell\">" . $row['lieu_naissance'] . "</td>";
		            echo "<td class=\"tableau_cell\">" . Date('d-m-Y', $row['date_naissance']) . "</td>";
		        echo "</tr>";
		    }
		    echo "</table>";   
		    $req->closeCursor(); 
		}
		?>
	</body>
</html>