<?php
class ConnexionManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function infosConnexionCorrecte($login, $passwordProtected){
    $sql = 'SELECT per_login, per_pwd FROM personne WHERE per_login = :login';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':login', $login);

		$requete->execute();

		$resultat = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

    if($resultat != null){
      return $passwordProtected === $resultat->per_pwd;
    }else{
      return false;
    }
  }

  public function captchaEstValide($nb1, $nb2, $reponse){
    return ($nb1 + $nb2) == $reponse;
  }
}
