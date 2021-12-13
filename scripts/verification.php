<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 

  echo "ttttttttttttttttttttttttttttttttttttttt";

//if(isset($_POST['id']) && isset($_POST['mdp'])) {
  /*
  $reqU = $pdo->prepare("SELECT * FROM secretariat WHERE id = ?");
  $reqU->execute([$_POST['id']]);
  $user = $reqU->fetch();
  
  $reqP = $pdo->prepare("SELECT * FROM secretariat WHERE mdp = ?");
  $reqP->execute([$_POST['mdp']]);
  $password = $reqP->fetch();
  echo $req->fetch;
  */

  $req = $linkpdo->prepare("SELECT count(*) FROM secretariat WHERE id=:id AND mdp=:mdp");
  $req->execute(array('id' => $_POST['id'],
                      'mdp' => $_POST['mdp'] ));

  echo "rrrrrrrrrrr";
  echo "\n".$req->rowCount();
  if ($req->rowCount() > 0) {
      $_SESSION['connexion'] = 'oui';
      header('Location: /CabinetMedical/pages/usagers/rechercher.php');
    } else {
      header('Location: /CabinetMedical/index.php?erreur=1');
  }
//}
?>