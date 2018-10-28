<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);

if(empty($_GET['id'])){

  $personnes = $personneManager->getAllPersonnes();
  ?>

  <div class="lister">
    <h1>Lister des personnes enregistrées</h1>

    <p>Actuellement <?php echo count($personnes);?> personnes enregistrées</p>

    <table>

      <tr>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Prénom</th>
      <tr>

      <?php foreach($personnes as $personne) { ?>
        <tr>
          <td><a href="index.php?page=2&amp;id=<?php echo $personne->getNumPersonne();?>"><?php echo $personne->getNumPersonne();?></td>
          <td><?php echo $personne->getNomPersonne();?></td>
          <td><?php echo $personne->getPrenomPersonne();?></td>
        </tr>
      <?php } ?>

    </table>
  </div>

<?php }else{
  $numPersonne = $_GET['id'];
  $personne = $personneManager->getPersonne($numPersonne);?>

  <?php if($personneManager->estEtudiant($numPersonne)){
    $etudiantManager = new EtudiantManager($pdo);
    $etudiant = $etudiantManager->getEtudiant($personne, $numPersonne);

    $departementManager = new DepartementManager($pdo);
    $departement = $departementManager->getDepartement($etudiant->getNumDepartement());

    $villeManager = new VilleManager($pdo);
    $ville = $villeManager->getVille($departement->getNumVilleDepartement()); ?>

    <div id="detailsEtudiant">

      <h1>Détails sur l'étudiant <?php echo $etudiant->getPersonneEtudiant()->getNomPersonne(); ?> </h1>

      <table>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Mail</th>
          <th>Téléphone</th>
          <th>Département</th>
          <th>Ville</th>
        </tr>

        <tr>
          <td><?php echo $etudiant->getPersonneEtudiant()->getNomPersonne();?></td>
          <td><?php echo $etudiant->getPersonneEtudiant()->getPrenomPersonne();?></td>
          <td><?php echo $etudiant->getPersonneEtudiant()->getMailPersonne();?></td>
          <td><?php echo $etudiant->getPersonneEtudiant()->getTelPersonne();?></td>
          <td><?php echo $departement->getNomDepartement();?></td>
          <td><?php echo $ville->getNomVille();?></td>
        </tr>
      </table>

    </div>


  <?php }else{
    $salarieManager = new SalarieManager($pdo);
    $salarie = $salarieManager->getSalarie($personne, $numPersonne);

    $fonctionManager = new FonctionManager($pdo);
    $fonction = $fonctionManager->getFonction($salarie->getNumFonction()); ?>

    <div id="detailsSalarie">

      <h1>Détails sur le salarié <?php echo $salarie->getPersonneSalarie()->getNomPersonne(); ?> </h1>

      <table>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Mail</th>
          <th>Téléphone</th>
          <th>Téléphone pro</th>
          <th>Fonction</th>
        </tr>

        <tr>
          <td><?php echo $salarie->getPersonneSalarie()->getNomPersonne();?></td>
          <td><?php echo $salarie->getPersonneSalarie()->getPrenomPersonne();?></td>
          <td><?php echo $salarie->getPersonneSalarie()->getMailPersonne();?></td>
          <td><?php echo $salarie->getPersonneSalarie()->getTelPersonne();?></td>
          <td><?php echo $salarie->getTelPro();?></td>
          <td><?php echo $fonction->getLibelleFonction();?></td>
        </tr>
      </table>

    </div>

  <?php
  }
}
  ?>
