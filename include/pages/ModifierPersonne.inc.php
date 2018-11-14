<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);

if(!isset($_SESSION['personne'])){
  if(empty($_GET['id'])){

    $personnes = $personneManager->getAllPersonnes();
    ?>

    <div class="lister">
      <h1>Modifier une personne enregistrée</h1>

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
  					<td><a href="index.php?page=3&amp;id=<?php echo $personne->getNumPersonne();?>"><img class='icone' src='image/modifier.png' alt='Modifier une personne'></td>
          </tr>
        <?php } ?>

      </table>
    </div>

  <?php
  }else{
    $_SESSION['personne'] = $personneManager->getPersonne($_GET['id']);?>

    <form method="post" action="#">

      <label for="per_nom">Nom : </label>
        <input type="text" id="per_nom" name="per_nom" value="<?php echo $_SESSION['personne']->getNomPersonne()?>" required/>
      </br>

      <label for="per_prenom">Prénom : </label>
        <input type="text" id="per_prenom" name="per_prenom" value="<?php echo $_SESSION['personne']->getPrenomPersonne()?>" required/>
      </br>

      <label for="per_tel">Téléphone : </label>
        <input type="tel" id="per_tel" name="per_tel" value="<?php echo $_SESSION['personne']->getTelPersonne()?>" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="0XXXXXXXXX" required/>
      </br>

      <label for="per_mail">Mail : </label>
        <input type="email" id="per_mail" name="per_mail" value="<?php echo $_SESSION['personne']->getMailPersonne()?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="monMail@domain.com" required/>
      </br>

      <label for="per_login">Login : </label>
        <input type="text" id="per_login" name="per_login" value="<?php echo $_SESSION['personne']->getLoginPersonne()?>" required/>
      </br>

      <input type="submit" value="Valider" class="btn">

    </form>

  <?php
  }

}else{
  if(!empty($_POST['per_nom'])){
    $personne = new Personne($_POST);
    $retour = $personneManager->updatePersonne($_SESSION['personne']->getNumPersonne(), $personne);

    if($retour){
      echo "<p><img class='icone' src='image/valid.png' alt='Validation modification'> La personne '<strong>".$personne->getPrenomPersonne()." ".$personne->getNomPersonne()."</strong>' a été modifiée</p>";
    }else{
      echo "<p><img class='icone' src='image/erreur.png' alt='Erreur suppression'>Erreur interne : La personne '<strong>".$personne->getPrenomPersonne()." ".$personne->getNomPersonne()."</strong>' n'a pu être modifiée</p>";
    }
    unset($_SESSION['personne']);
    header("Refresh: 3;URL=index.php?page=3");
  }
}
  ?>
