<?php
if ((empty($_POST['per_login'])) && !isset($_SESSION['login'])){
  $_SESSION['nbAlea1'] = rand(1, 9);
  $_SESSION['nbAlea2'] = rand(1, 9); ?>

  <h1>Pour vous connecter</h1>

  <form action="#" method="post">

    <label for="per_login">Nom d'utilisateur : </label>
      <input type="text" name="per_login" id="per_login" required/>
    </br>
    <label for="per_pwd">Mot de passe : </label>
      <input type="password" name="per_pwd" id="per_pwd" required/>
    </br>
    <label for="captcha"><img src="image/nb/<?php echo $_SESSION['nbAlea1']?>.jpg"> + <img src="image/nb/<?php echo $_SESSION['nbAlea2']?>.jpg"> = </label>
      <input type="text" name="captcha" id="captcha" required/>
    </br>

    <input type="submit" value="Valider" class="btn">
  </form>

<?php }else{
  if(!isset($_SESSION['login'])){
    $pdo = new Mypdo();
    $connexionManager = new ConnexionManager($pdo);
    $infosCorrects = $connexionManager->infosConnexionCorrecte($_POST['per_login'], createProtectedPassword($_POST['per_pwd']));
    $captchaValide = $connexionManager->captchaEstValide($_SESSION['nbAlea1'], $_SESSION['nbAlea2'], $_POST['captcha']);

    if($infosCorrects){

      if($captchaValide){
        $_SESSION['login'] = $_POST['per_login'];
        unset($_SESSION['nbAlea1']);
        unset($_SESSION['nbAlea2']);
        
        echo "<p><img class='icone' src='image/valid.png' alt='Validation connexion'> Vous avez été connecté </p>";
        echo "<p>Redirection automatique dans 2 secondes</p>";
        header("Refresh: 2;URL=index.php");

      }else{
        echo "<p><img class='icone' src='image/erreur.png' alt='Erreur connexion'>Captcha saisi invalide</p>";
      }

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
