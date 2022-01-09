<?php
$page = 'medecin';								// type de la page	
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
s?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../../styles/defaut.css">
   	    <link rel="stylesheet" href="../../styles/supprimer.css">
   	</head>   
	<body>

		<header>
			<?php include('../../scripts/header.php'); 	// NAVIGUATION BAR ?>
		</header>

		<main>
			<?php include('../../scripts/menu_secondaire.php'); // USAGERS MENU ?>
	
			<h1>Etes vous sur de vouloir supprimer le medecin suivant ?</h1>

			<?php
			$id = '';
			if(!empty($_GET['id'])) {
			    $id = $_GET['id'];
			} else {
			    $id = $_POST['id'];
			}

			showUsager($id,$linkpdo);

			if(isset($_POST["send"])) {
			    $req = $linkpdo->prepare("DELETE FROM medecin WHERE id_m=:id");
			    $req->execute(array('id' => $id)); 

			    echo "CONTACT SUPPRIMÉ";
			    header('Location: rechercher.php');
			}
			?>
			<br>
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<table>
				    <tr>
				        <td><input type="submit" name="send" value="VALIDER LA SUPPRESSION"></td>
				        <button><a href="rechercher.php">Annuler</a></button>
				    </tr>
				</table>
			</form>
			<?php
			function showUsager($id,$linkpdo) {
			    // Sélection de tout le contenu de la table carnet_adresse
			    $req = $linkpdo->prepare("SELECT * FROM medecin WHERE id_m=:id");
			    $req->execute(array('id' => $id)); 
			    
			    // Affichage des entrées du résultat une à une
			    echo "<table class=\"tableau_table\">";
			    echo "<tr class=\"tableau_cell_title\">";
			        echo "<th>Nom</th>";
			        echo "<th>Prenom</th>";
			        echo "<th>Civilité</th>";
			    echo "</tr>";

			    while ($row = $req->fetch()) {
			    	$id = $row['id_m'];
			        echo "<tr class=\"tableau_cell_title\">";
			            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
			            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";
			            echo "<td class=\"tableau_cell\">" . $row['civilite'] . "</td>";	
			        echo "</tr>";
			    }
			    echo "</table>";   
			    $req->closeCursor(); 
			}
			?>
		</main>
	</body>
	<?include('../../scripts/footer.php');	// bas de page ?>
</html>