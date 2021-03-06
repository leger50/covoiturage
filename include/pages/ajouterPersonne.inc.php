<?php
if(!isset($_SESSION['ajoutPersonne'])){

  if(empty($_POST['per_nom'])){ ?>
    <h1>Ajouter une personne</h1>

    <form method="post" action="#">

      <label for="per_nom">Nom : </label>
        <input type="text" id="per_nom" name="per_nom" required/>
      </br>

      <label for="per_prenom">Prénom : </label>
        <input type="text" id="per_prenom" name="per_prenom" required/>
      </br>

      <label for="per_tel">Téléphone : </label>
        <input type="tel" id="per_tel" name="per_tel" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="0XXXXXXXXX" required/>
      </br>

      <label for="per_mail">Mail : </label>
        <input type="email" id="per_mail" name="per_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="monMail@domain.com" required/>
      </br>

      <label for="per_login">Login : </label>
        <input type="text" id="per_login" name="per_login" required/>
      </br>

      <label for="per_pwd">Mot de passe : </label>
        <input type="password" id="per_pwd" name="per_pwd" required/>
      </br>

      <p>Catégorie :
      <input type="radio" name="categorie" value="etudiant" id="etudiant" checked/> <label for="etudiant">Etudiant</label>
	    <input type="radio" name="categorie" value="personnel" id="personnel" /> <label for="personnel">Personnel</label></p>

      <input type="submit" value="Valider" class="btn">

    </form>

  <?php }else{
    $_SESSION['ajoutPersonne'] = new Personne($_POST);
    $pdo = new Mypdo();

    if($_POST['categorie'] == 'etudiant'){
      $divisionManager = new DivisionManager($pdo);
      $listeDivisions = $divisionManager->getAllDivisions();

      $departementManager = new DepartementManager($pdo);
      $listeDepartements = $departementManager->getAllDepartements();

      $villeManager = new VilleManager($pdo);?>

      <h1>Ajouter un étudiant</h1>

      <form method="post" action="#">

        <label for="div_num">Année : </label>
          <select name="div_num" id="div_num">
            <?php foreach ($listeDivisions as $division) {
              echo "<option value=".$division->getNumDivision().">".$division->getNomDivision()."</option>\n";
            }?>
          </select>
        </br>

        <label for="dep_num">Département : </label>
          <select name="dep_num" id="dep_num">
            <?php foreach ($listeDepartements as $departement) {
              $ville = $villeManager->getVille($departement->getNumVilleDepartement());
              echo "<option value=".$departement->getNumDepartement().">".$departement->getNomDepartement()." - ".$ville->getNomVille()."</option>\n";
            }?>
          </select>
        </br>

        <input type="submit" value="Valider" class="btn">

      </form>

  <?php
    }elseif($_POST['categorie'] == 'personnel'){
      $fonctionManager = new FonctionManager($pdo);
      $listeFonctions = $fonctionManager->getAllFonctions(); ?>

      <h1>Ajouter un salarié</h1>

      <form method="post" action="#">

        <label for="sal_telprof">Téléphone professionnel : </label>
          <input type="tel" id="sal_telprof" name="sal_telprof" pattern='\d{2}\d{2}\d{2}\d{2}\d{2}' title="0XXXXXXXXX" required/>
        </br>

        <label for="fon_num">Fonction : </label>
          <select name="fon_num" id="fon_num">
            <?php foreach ($listeFonctions as $fonction) {
              echo "<option value=".$fonction->getNumFonction().">".$fonction->getLibelleFonction()."</option>\n";
            }?>
          </select>
        </br>

        <input type="submit" value="Valider" class="btn">

      </form>

    <?php
    }
  }
}else{
  $pdo = new Mypdo();

  if(!empty($_POST['div_num'])){
    $etudiantManager = new EtudiantManager($pdo);
    $etudiant = new Etudiant($_SESSION['ajoutPersonne'], $_POST);

    $retour = $etudiantManager->addEtudiant($etudiant);

    if($retour){
      echo "<p><img class='icone' src='image/valid.png' alt='Validation ajout étudiant'> L'étudiant '<strong>".$etudiant->getPersonneEtudiant()->getPrenomPersonne()." ".$etudiant->getPersonneEtudiant()->getNomPersonne()."</strong>' a été ajouté</p>";
      echo "<p>Redirection automatique dans 3 secondes</p>";
      header("Refresh: 3;URL=index.php?page=2");
    }else{
      echo "<p><img class='icone' src='image/erreur.png' alt='Erreur ajout étudiant'> L'étudiant '<strong>".$etudiant->getPersonneEtudiant()->getPrenomPersonne()." ".$etudiant->getPersonneEtudiant()->getNomPersonne()."</strong>' existe déjà</p>";
    }

  }elseif(!empty($_POST['sal_telprof'])){
    $salarieManager = new SalarieManager($pdo);
    $salarie = new Salarie($_SESSION['ajoutPersonne'], $_POST);

    $retour = $salarieManager->addSalarie($salarie);

    if($retour){
      echo "<p><img class='icone' src='image/valid.png' alt='Validation ajout salarié'> Le salarié '<strong>".$salarie->getPersonneSalarie()->getPrenomPersonne()." ".$salarie->getPersonneSalarie()->getNomPersonne()."</strong>' a été ajouté</p>";
      echo "<p>Redirection automatique dans 3 secondes</p>";
      header("Refresh: 3;URL=index.php?page=2");
    }else{
      echo "<p><img class='icone' src='image/erreur.png' alt='Erreur ajout salarié'> Le salarié '<strong>".$salarie->getPersonneSalarie()->getPrenomPersonne()." ".$salarie->getPersonneSalarie()->getNomPersonne()."</strong>' existe déjà</p>";
    }
  }

  unset($_SESSION['ajoutPersonne']);

} ?>
