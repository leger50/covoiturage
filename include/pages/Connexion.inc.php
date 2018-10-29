<?php
if ((empty($_POST['per_login'])) && !isset($_SESSION['login'])){ ?>

  <h1>Pour vous connecter</h1>

  <form action="#" method="post">

    <label for="per_login">Nom d'utilisateur : </label>
      <input type="text" name="per_login" id="per_login" required/>
    </br>
    <label for="per_pwd">Mot de passe : </label>
      <input type="password" name="per_pwd" id="per_pwd" required/>
    </br>

    <input type="submit" value="Valider" class="btn">
  </form>

<?php }else{
  if(!isset($_SESSION['login'])){
    $pdo = new Mypdo();
    $connexionManager = new ConnexionManager($pdo);
    $infosCorrects = $connexionManager->infosConnexionCorrecte($_POST['per_login'], createProtectedPassword($_POST['per_pwd']));

    if($infosCorrects){
      $_SESSION['login'] = $_POST['per_login'];
      echo "<p><img class='icone' src='image/valid.png' alt='Validation connexion'> Vous avez été connecté </p>";
      echo "<p>Redirection automatique dans 2 secondes</p>";
      header("Refresh: 2;URL=index.php");

    }else{
      echo "<p><img class='icone' src='image/erreur.png' alt='Erreur connexion'>Identifiant ou mot de passe invalide</p>";
    }

  }else{
    session_destroy();
    echo "<p>Vous avez bien été déconnecté !</p>";
    echo "<p><img class = 'icone' src='image/valid.png' alt='Validation déconnexion'> Redirection automatique dans 2 secondes</p>";
    header("Refresh: 2;URL=index.php");
  }
?>
<?php } ?>
