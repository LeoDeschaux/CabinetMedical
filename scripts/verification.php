<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 

/* // ANCIENNE VERSION

$req = $linkpdo->prepare("SELECT count(*) FROM secretariat WHERE id=:id AND mdp=:mdp");
$req->execute(array('id' => $_POST['id'],
                      'mdp' => $_POST['mdp'] ));

if ($req->rowCount() > 0) {
  $_SESSION['connexion'] = 'oui';
  header('Location: /CabinetMedical/pages/usagers/rechercher.php');
} else {
  header('Location: /CabinetMedical/index.php?erreur=1');
}
*/

if(isset($_POST['id']) && isset($_POST['mdp'])) {

  if(preg_match('`([\-_.,;:\|]+)`', $_POST['id'])) {

    header('Location: /CabinetMedical/index.php?erreur=2');

  } elseif (preg_match('`([\-_.,;:\|]+)`', $_POST['id'])) {

    header('Location: /CabinetMedical/index.php?erreur=2');

  } else {
    
      if ($_POST['id'] == "salu") {

        if ($_POST['mdp'] == "sava") {

          $_SESSION['connexion'] = 'oui';
          header('Location: /CabinetMedical/pages/usagers/rechercher.php');

        } else {
          header('Location: /CabinetMedical/index.php?erreur=1');
        }
      } else {
          header('Location: /CabinetMedical/index.php?erreur=1');
      }
  }
} 
?>