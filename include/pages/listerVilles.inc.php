<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVilles();
?>

<div id="listerVille">
  <h1>Lister des villes</h1>

  <p>Actuellement <?php echo count($villes)?> villes sont enregistrées</p>

  <table>

    <tr>
      <th>Numéro</th>
      <th>Nom</th>
    <tr>

    <?php foreach($villes as $ville) { ?>
      <tr>
        <td><?php echo $ville->getNumVille()?></td>
        <td><?php echo $ville->getNomVille()?></td>
      </tr>
    <?php } ?>

  </table>
</div>
