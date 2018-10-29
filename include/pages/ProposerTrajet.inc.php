<?php if(isset($_SESSION['login'])){?>
  <h1>Proposer un trajet</h1>

<?php }else{ ?>
  <p>Vous devez être connecté pour accéder à cette page !</p>
  <p><img class = 'icone' src='image/erreur.png' alt='Erreur accès'> Redirection automatique dans 3 secondes</p>
  <?php header("Refresh: 3;URL=index.php");
}?>
