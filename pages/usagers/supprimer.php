<?php
$page = 'usager';								// type de la page
$sous_menu = '';
include('../../scripts/connexion.php');  		// AUTHENTIFICATION & CONNEXION BDD
?>
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
			<h1>Etes vous sur de vouloir supprimer l'usager suivant ?</h1>

			<?php

			include('../../scripts/menu_secondaire.php'); // USAGERS MENU

			$id = '';
			if(!empty($_GET['id_u'])) {
			    $id = $_GET['id_u'];
			} else {
			    $id = $_POST['id_u'];
			}

			showUsager($id,$linkpdo);

			if(isset($_POST["send"])) {
			    $req = $linkpdo->prepare("DELETE FROM usager WHERE id_u=:id");
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
			            echo "<td class=\"tableau_cell\">" . Date('d/m/Y', $row['date_naissance']) . "</td>";
			        echo "</tr>";
			    }
			    echo "</table>";   
			    $req->closeCursor(); 
			}
			?>
		</main>
		<?php include('../../scripts/footer.php');	// bas de page ?>
	</body>
</html>