<?php if(isset($_SESSION['login'])){
  $pdo = new Mypdo();?>

  <h1>Proposer un trajet</h1>

  <?php
  if(empty($_POST['ville_depart'])){
    $parcoursManager = new ParcoursManager($pdo);
    $listeVillesParcours = $parcoursManager->getAllVillesParcours();
  ?>

  <form method="post" action="#">

    <label for="ville_depart">Ville de départ : </label>
      <select name="ville_depart" id="ville_depart">
        <?php foreach ($listeVillesParcours as $ville) {
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
        <input type="hidden" id="ville_depart" name="ville_depart" value=<?php echo $ville->getNumVille();?>/>
      </br>

      <label for="ville_arrivee">Ville d'arrivée : </label>
        <select name="ville_arrivee" id="ville_arrivee">
          <?php foreach ($listeVillesArrivee as $villeArrivee) {
            echo "<option value=".$villeArrivee->getNumVille().">".$villeArrivee->getNomVille()."</option>\n";
          }?>
        </select>
      </br>

      <label for="pro_date">Date de départ : </label>
        <input type="date" id="pro_date" name="pro_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required/>
      </br>

      <label for="pro_time">Heure de départ : </label>
        <input type="time" id="pro_time" name="pro_time" pattern="[0-9]{2}:[0-9]{2}" required/>
      </br>

      <label for="pro_place">Nombre de places : </label>
        <input type="number" id="pro_place" name="pro_place" min="1" placeholder="Min: 1" required/>
      </br>

      <input type="submit" value="Valider" class="btn">

    </form>


    <?php
    }else{
      echo $_POST['pro_date'];
      echo $_POST['pro_time'];
      $propose = new Propose($_POST);

    	$parcoursManager = new ParcoursManager($pdo);
    	$infosParcours = $parcoursManager->getParcours($_POST['ville_depart'], $_POST['ville_arrivee']);
      $propose->setNumParcours($infosParcours->par_num);
      $propose->setSensPropose($infosParcours->pro_sens);

      $personneManager = new PersonneManager($pdo);
      $numPersonne = $personneManager->getNumPersonneWithLogin($_SESSION['login']);
      $propose->setNumPersonnePropose($numPersonne);

      $proposeManager = new ProposeManager($pdo);

    	$retour = $proposeManager->addTrajetPropose($propose);

      if($retour){ ?>
        <p><img class='icone' src='image/valid.png' alt='Validation proposition trajet'> Le trajet a été ajouté</p>
        <p>Redirection automatique dans 3 secondes</p>
        <?php //header("Refresh: 3;URL=index.php?page=6");

      }else{ ?>
        <p><img class='icone' src='image/erreur.png' alt='Erreur ajout proposition trajet'> Erreur Interne : le trajet n'a pu être ajouté</p>

      <?php
      }
    }
  }
  ?>

<?php }else{ ?>
  <p>Vous devez être connecté pour accéder à cette page !</p>
  <p><img class = 'icone' src='image/erreur.png' alt='Erreur accès'> Redirection automatique dans 3 secondes</p>
  <?php header("Refresh: 3;URL=index.php");
}?>
