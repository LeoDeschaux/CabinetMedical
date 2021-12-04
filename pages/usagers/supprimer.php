<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Accueil Secrétariat</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="/www/CabinetMedical/styles/defaut.css">
	<body>

	<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
	<?php 
		$var = '1';
		$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/www/CabinetMedical/scripts/header.php';
		include($headerPath); 
	?>

	<!-- ///////////////////// USAGERS MENU //////////////////// -->
	<?php 
		$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/www/CabinetMedical/scripts/usagersMenu.php';
		include($headerPath); 
	?>

	<style type="text/css">
	.tableau_table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;

	}

	.tableau_cell_title {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	.tableau_cell{
		border: 1px solid #dddddd;
	}

	tr, th{
		border: 1px solid #dddddd;
		background-color: none;
	}
	</style>

	<h1>Etes vous sur de vouloir supprimer l'usager suivant ?</h1>

	<?php

	$id = '';

	if(!empty($_GET['id']))
	{
	    $id = $_GET['id'];
	}
	else
	{
	    $id = $_POST['id'];
	}

	showUsager($id);

	if(isset($_POST["send"]))
	{
	    ///Connexion au serveur MySQL
	    $login = 'root';
	    $mdp = '';

	    $server = '127.0.0.1';
	    $db = 'cabinet';

	    try {
	        $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	    }
	        catch (Exception $e) {
	        die('Erreur : ' . $e->getMessage());
	    }

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
	    </tr>
	</table>
	</form>

<?php
function showUsager($id)
{
	///Connexion au serveur MySQL
    $login = 'root';
    $mdp = '';
    $server = '127.0.0.1';
    $db = 'cabinet';

    try {
        $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    }
        catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

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

    while ($row = $req->fetch())
    {
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
            echo "<td class=\"tableau_cell\">" . $row['date_naissance'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    
    $req->closeCursor(); 
}

?>
</html>