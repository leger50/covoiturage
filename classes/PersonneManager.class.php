<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function addPersonne($personne){
		if($this->personneExiste($personne)){
			return false;

		}else{
			$sql = 'INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:nom, :prenom, :tel, :mail, :login, :passwd)';
			$requete = $this->db->prepare($sql);

			$requete->bindValue(':nom', $personne->getNomPersonne());
			$requete->bindValue(':prenom', $personne->getPrenomPersonne());
			$requete->bindValue(':tel', $personne->getTelPersonne());
			$requete->bindValue(':mail', $personne->getMailPersonne());
			$requete->bindValue(':login', $personne->getLoginPersonne());
			$requete->bindValue(':passwd', $personne->getPasswdPersonne());

			$retour=$requete->execute();
			$requete->closeCursor();

			return $retour;
		}
	}

	public function personneExiste($personne){
		$sql = 'SELECT per_num FROM personne WHERE per_mail = :mail OR per_login = :login';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':mail', $personne->getMailPersonne());
		$requete->bindValue(':login', $personne->getLoginPersonne());

		$requete->execute();

		$resultat = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		return $resultat != null;
	}

	/*public function getAllVilles(){

		$sql = 'SELECT vil_num, vil_nom FROM ville';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($ville = $requete->fetch(PDO::FETCH_OBJ)){
			$listeVilles[] = new Ville($ville);
		}

		$requete->closeCursor();
		return $listeVilles;
	}

	public function getVille($numVille){

		$sql = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num = :num';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':num', $numVille);
		$requete->execute();

		$ville = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		$newVille = new Ville($ville);
		return $newVille;
	}*/
}
