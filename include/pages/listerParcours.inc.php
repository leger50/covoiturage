<?php
$pdo = new Mypdo();
$parcoursManager = new ParcoursManager($pdo);
$lesParcours = $parcoursManager->getAllParcours();

$villeManager = new VilleManager($pdo);
?>

<div class="lister">
  <h1>Lister des parcours proposés</h1>

  <p>Actuellement <?php echo count($lesParcours)?> parcours sont enregistrés</p>

  <table>

    <tr>
      <th>Numéro</th>
      <th>Nom ville</th>
      <th>Nom ville</th>
      <th>Nombre de Km</th>
    <tr>

    <?php foreach($lesParcours as $parcours) {
      $ville1 = $villeManager->getVille($parcours->getVille1Parcours());
      $ville2 = $villeManager->getVille($parcours->getVille2Parcours());
      ?>
      <tr>
        <td><?php echo $parcours->getNumParcours()?></td>
        <td><?php echo $ville1->getNomVille()?></td>
        <td><?php echo $ville2->getNomVille()?></td>
        <td><?php echo $parcours->getKmsParcours()?></td>
      </tr>
    <?php } ?>

  </table>
</div>
