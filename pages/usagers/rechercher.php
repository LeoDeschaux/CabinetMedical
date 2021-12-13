<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
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

	<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
	<?php 
		$var = '1';
		$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php';
		include($headerPath); 
		?>

		<!-- ///////////////////// USAGERS MENU //////////////////// -->
	<?php 
		$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/usagersMenu.php';
		include($headerPath); 
	?>

	<br>

	<form method="post">
			<input type="text" name="search" placeholder="nom, prenom, etc.">
			<button type="submit" name="send" value="send">Rechercher</button>
			<br>
	</form>

	<br>

	<?php
	onFieldChange();

	function onFieldChange()
	{
		if(empty($_POST['search']))
		{
			echo "show all";
			showAllUsagers();
		}
		else
		{
			echo "show corresponding";
			showCorrespondingUsagers();
		}
	}

	?>

	<?php 
	function showCorrespondingUsagers()
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

	    $req = $linkpdo->prepare("SELECT * FROM usager WHERE nom=:nom OR prenom=:prenom OR adresse=:adresse OR cp=:cp OR ville=:ville");
    
	    $field = $_POST['search'];

	    $req->execute(array(
	    'nom' => $field,
	    'prenom' => $field,
	    'adresse' => $field,
	    'cp' => $field,
	    'ville' => $field));
	    
	    ///Affichage des entrées du résultat une à une
	    echo "<h2>Liste de tous les contacts :</h2>";

	    echo "<table class=\"tableau_table\">";
	    echo "<tr class=\"tableau_cell_title\">";
	        echo "<th>Nom</th>";
	        echo "<th>Prenom</th>";
	        echo "<th>Adresse</th>";
	        echo "<th>CodePostal</th>";
	        echo "<th>Ville</th>";
	    echo "</tr>";

	    while ($row = $req->fetch())
	    {
	        echo "<tr class=\"tableau_cell_title\">";
	            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
	            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";
	            echo "<td class=\"tableau_cell\">" . $row['adresse'] . "</td>";
	            echo "<td class=\"tableau_cell\">" . $row['cp'] . "</td>";
	            echo "<td class=\"tableau_cell\">" . $row['ville'] . "</td>";
	        echo "</tr>";
	    }

	    echo "</table>";
	    
	    $req->closeCursor(); 
	}


	function showAllUsagers()
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
	    $req = $linkpdo->query("SELECT * FROM usager");
	    
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

	        echo "<th>Modifier</th>";
	        echo "<th>Supprimer</th>";
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
	            echo "<td class=\"tableau_cell\">" . Date("d-m-Y", $row['date_naissance']). "</td>";

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