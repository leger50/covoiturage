<h1>Ajouter une ville</h1>

<?php
if(empty($_POST['vil_nom'])){
?>

<form method="post" action="#">

  <label for="vil_nom">Nom : </label>
    <input type="text" id="vil_nom" name="vil_nom" required/>
  </br>

  <input type="submit" value="Valider" class="btn">

</form>

<?php
}else{
  $pdo = new Mypdo();
	$villeManager = new VilleManager($pdo);
	$ville = new Ville($_POST);

	$retour = $villeManager->addVille($ville);

  if($retour){
    echo "<p><img class='icone' src='image/valid.png' alt='Validation ville'> La ville <strong>".$ville->getNomVille()."</strong> a été ajoutée";
    echo "<p>Redirection automatique dans 3 secondes</p>";
    header("Refresh: 3;URL=index.php?page=8");

  }else{
    echo "<p><img class='icone' src='image/erreur.png' alt='Erreur ville'> La ville <strong>".$ville->getNomVille()."</strong> existe déjà";
  }
}
?>
