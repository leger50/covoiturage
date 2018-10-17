<h1>Ajouter un parcours</h1>

<?php
if(empty($_POST['par_km'])){
  $pdo = new Mypdo();
  $villeManager = new VilleManager($pdo);
  $listeVilles = $villeManager->getAllVilles();
?>

<form method="post" action="#">

  <label for="vil_num1">Ville 1 : </label>
    <select name="vil_num1" id="vil_num1">
      <?php foreach ($listeVilles as $ville) {
        echo "<option value=".$ville->getNumVille().">".$ville->getNomVille()."</option>\n";
      }?>
    </select>
    </br>

  <label for="vil_num2">Ville 2 : </label>
    <select name="vil_num2" id="vil_num2">
      <?php foreach ($listeVilles as $key=>$ville) {
        if($key !== 0){
          echo "<option value=".$ville->getNumVille().">".$ville->getNomVille()."</option>\n";
        }
      }?>
    </select>
    </br>

  <label for="par_km">Nombre de kilomètre(s) : </label>
    <input type="number" id="par_km" name="par_km" min="1" placeholder="Min: 1" required/>
  </br>

  <input type="submit" value="Valider" class="btn">

</form>

<?php
}else{
  $pdo = new Mypdo();
	$parcoursManager = new ParcoursManager($pdo);
	$parcours = new Parcours($_POST);

	$retour = $parcoursManager->addParcours($parcours);

  if($retour){
    echo "<p><img class='icone' src='image/valid.png' alt='Validation parcours'> Le parcours a été ajouté";
  }else{
    echo "<p><img class='icone' src='image/erreur.png' alt='Erreur parcours'> Le parcours existe déjà ou les noms de ville doivent être différents";
  }
}
?>
