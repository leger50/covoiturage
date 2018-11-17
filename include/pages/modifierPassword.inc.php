<?php
if (isset($_SESSION['login'])){

  if(empty($_POST['new_password'])){ ?>

    <form method="post" action="#">

      <label for="old_password">Ancien mot de passe : </label>
        <input type="password" id="old_password" name="old_password" required/>
      </br>

      <label for="new_password">Nouveau mot de passe : </label>
        <input type="password" id="new_password" name="new_password" required/>
      </br>

      <label for="conf_password">Confirmer nouveau mot de passe : </label>
        <input type="password" id="conf_password" name="conf_password" required/>
      </br>

      <input type="submit" value="Valider" class="btn">

    </form>

  <?php
  }else{

    if($_POST['new_password'] === $_POST['conf_password']){

      $pdo = new Mypdo();
      $connexionManager = new ConnexionManager($pdo);
      $infosSontCorrectes = $connexionManager->infosConnexionCorrecte($_SESSION['login'], createProtectedPassword($_POST['old_password']));

      if($infosSontCorrectes){
        $personneManager = new PersonneManager($pdo);
        $idPersonne = $personneManager->getNumPersonneWithLogin($_SESSION['login']);

        $retour = $personneManager->updatePasswordOfPersonne($idPersonne, createProtectedPassword($_POST['new_password']));

        if($retour){
          echo "<p><img class='icone' src='image/valid.png' alt='Validation mise à jour mot de passe'> Votre mot de passe a bien été modifié";
          echo "<p>Redirection automatique dans 3 secondes</p>";
          header("Refresh: 3;URL=index.php?page=2");

        }else{
          echo "<p><img class='icone' src='image/erreur.png' alt='Erreur mise à jour mot de passe'> Erreur interne : votre mot de passe n'a pu être modifié";
        }

      }else{
        echo "<p><img class='icone' src='image/erreur.png' alt='Erreur saisi ancien mot de passe'> L'ancien mot de passe renseigné est incorrecte";
      }

    }else{
      echo "<p><img class='icone' src='image/erreur.png' alt='Confirmation mot de passe'> La confirmation du mot de passe est invalide, les 2 mots de passe doivent être identique";
    }
  }
}
