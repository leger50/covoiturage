<?php if(isset($_SESSION['login'])){
  $pdo = new Mypdo();?>

  <h1>Rechercher un trajet</h1>

  <?php
  if(empty($_POST['ville_depart'])){
    $proposeManager = new ProposeManager($pdo);
    $listeVilles = $proposeManager->getAllVillesDepart();
  ?>

  <form method="post" action="#">

    <label for="ville_depart">Ville de départ : </label>
      <select name="ville_depart" id="ville_depart">
        <?php foreach ($listeVilles as $ville) {
          echo "<option value=".$ville->getNumVille().">".$ville->getNomVille()."</option>\n";
        }?>
      </select>
    </br>

    <input type="submit" value="Valider" class="btn">

  </form>

  <?php
  }else{
    if(empty($_POST['ville_arrivee'])){
      $villeManager = new VilleManager($pdo);
      $ville = $villeManager->getVille($_POST['ville_depart']);

      $parcoursManager = new ParcoursManager($pdo);
      $listeVillesArrivee = $parcoursManager->getVillesArriveeParcours($_POST['ville_depart']);
    ?>

    <form method="post" action="#">

      <label for="ville_depart">Ville de départ :<?php echo $ville->getNomVille();?> </label>
        <input type="hidden" id="ville_depart" name="ville_depart" value='<?php echo $ville->getNumVille();?>'/>
      </br>

      <label for="ville_arrivee">Ville d'arrivée : </label>
        <select name="ville_arrivee" id="ville_arrivee">
          <?php foreach ($listeVillesArrivee as $villeArrivee) {
            echo "<option value=".$villeArrivee->getNumVille().">".$villeArrivee->getNomVille()."</option>\n";
          }?>
        </select>
      </br>

      <label for="pro_date">Date de départ : </label>
        <input type="date" id="pro_date" name="pro_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value='<?php echo date('Y-m-d');?>' min='<?php echo date('Y-m-d');?>'required/>
      </br>

      <label for="pro_time">À partir de : </label>
        <select name="pro_time" id="pro_time">
          <?php for ($i = 0; $i < 24; $i++) {
            echo "<option value=".$i.">".$i."h</option>\n";
          }?>
        </select>
      </br>

      <label for="precision_date">Précision : </label>
        <select name="precision_date" id="precision_date">
          <option value="0">Ce jour</options>
          <?php for ($i = 1; $i < (PRECISION +1); $i++) {
            echo "<option value=".$i.">+/-".$i." jour(s)</option>\n";
          }?>
        </select>
      </br>

      <input type="submit" value="Valider" class="btn">

    </form>

    <?php
    }else{
      $parcoursManager = new ParcoursManager($pdo);
      $numParcours = $parcoursManager->getParcours($_POST['ville_depart'], $_POST['ville_arrivee']);

      $sensParcours = $numParcours->pro_sens;
      $numParcours = $numParcours->par_num;

      $proposeManager = new ProposeManager($pdo);
      $listeTrajets = $proposeManager->rechercherTrajet($numParcours, $_POST['pro_date'], $_POST['pro_time'], $_POST['precision_date'], $sensParcours);

      $villeManager = new VilleManager($pdo);
      $villeDepart = $villeManager->getVille($_POST['ville_depart']);
      $villeArrivee = $villeManager->getVille($_POST['ville_arrivee']);

      $avisManager = new AvisManager($pdo);

      if($listeTrajets != null){
      ?>

      <div class="lister">
        <table>

          <tr>
            <th>Ville départ</th>
            <th>Ville arrivée</th>
            <th>Date départ</th>
            <th>Heure départ</th>
            <th>Nombre de place(s)</th>
            <th>Nom du covoitureur</th>
          <tr>

          <?php foreach($listeTrajets as $trajet) {
            $moyennePersonne = $avisManager->getAverageOfPerson($trajet->per_num);
            $dernierAvis = $avisManager->getLastAvisOnPerson($trajet->per_num);?>
            <tr>
              <td><?php echo $villeDepart->getNomVille();?></td>
              <td><?php echo $villeArrivee->getNomVille();?></td>
              <td><?php echo getFrenchDate($trajet->pro_date);?></td>
              <td><?php echo $trajet->pro_time;?></td>
              <td><?php echo $trajet->pro_place;?></td>
              <td>
                <a class="bulleInfos" href="">
                   <?php echo $trajet->per_prenom." ".$trajet->per_nom;?>
                   <span>
                     <p>Moyenne des avis : <?php echo $moyennePersonne;?></p>
                     <p>Dernier avis : <?php echo $dernierAvis;?></p>
                   </span>
                </a>
              </td>
            </tr>
          <?php } ?>

        </table>
      </div>

    <?php
      }else{ ?>
        <p><img class = 'icone' src='image/erreur.png' alt='Pas de trajets'> Désolé, pas de trajets disponible !</p>
    <?php
      }
    }
  } ?>

<?php }else{ ?>
  <p>Vous devez être connecté pour accéder à cette page !</p>
  <p><img class = 'icone' src='image/erreur.png' alt='Erreur accès'> Redirection automatique dans 3 secondes</p>
  <?php header("Refresh: 3;URL=index.php");
}?>
