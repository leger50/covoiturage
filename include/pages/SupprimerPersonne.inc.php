<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);

if(!isset($_SESSION['supprimerPersonne'])){
  if(empty($_GET['id'])){

    $personnes = $personneManager->getAllPersonnes();
    ?>

    <div class="lister">
      <h1>Supprimer une personne enregistrée</h1>

      <p>Actuellement <?php echo count($personnes);?> personnes enregistrées</p>

      <table>

        <tr>
          <th>Numéro</th>
          <th>Nom</th>
          <th>Prénom</th>
        <tr>

        <?php foreach($personnes as $personne) { ?>
          <tr>
            <td><?php echo $personne->getNumPersonne();?></td>
            <td><?php echo $personne->getNomPersonne();?></td>
            <td><?php echo $personne->getPrenomPersonne();?></td>
  					<td><a href="index.php?page=4&amp;id=<?php echo $personne->getNumPersonne();?>"><img class='icone' src='image/erreur.png' alt='Supprimer une personne'></td>
          </tr>
        <?php } ?>

      </table>
    </div>

  <?php
  }else{
    $_SESSION['supprimerPersonne'] = $_GET['id'];?>

    <form method="post" action="#">
      <label for="confSuppr">Êtes vous sûr de vouloir supprimer cette personne : </label></br>

      <input type="submit" id="confirmer" name="confirmer" value="Confirmer" class="btn"/>
      <input type="submit" id="annuler" name="annuler" value="Annuler" class="btn"/>
    </form>

  <?php
  }

}else{
  if(!empty($_POST['confirmer'])){
    $personne = $personneManager->getPersonne($_SESSION['supprimerPersonne']);
    $retour = $personneManager->supprimerPersonne($_SESSION['supprimerPersonne']);

    if($retour){
      echo "<p><img class='icone' src='image/valid.png' alt='Validation suppression'> La personne '<strong>".$personne->getPrenomPersonne()." ".$personne->getNomPersonne()."</strong>' a été supprimée</p>";
    }else{
      echo "<p><img class='icone' src='image/erreur.png' alt='Erreur suppression'>Erreur interne : La personne '<strong>".$personne->getPrenomPersonne()." ".$personne->getNomPersonne()."</strong>' n'a pu être supprimée</p>";
    }
  }else{
    unset($_SESSION['supprimerPersonne']);
    header("location:index.php?page=4");
  }
}
  ?>
