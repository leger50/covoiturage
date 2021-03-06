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

	public function updatePersonne($idPersonne, $personne){
		$sql = 'UPDATE personne SET per_nom = :nom, per_prenom = :prenom, per_tel = :tel, per_mail = :mail, per_login = :login
						WHERE per_num = :num';
		$requete = $this->db->prepare($sql);

		$requete->bindValue(':num', $idPersonne);
		$requete->bindValue(':nom', $personne->getNomPersonne());
		$requete->bindValue(':prenom', $personne->getPrenomPersonne());
		$requete->bindValue(':tel', $personne->getTelPersonne());
		$requete->bindValue(':mail', $personne->getMailPersonne());
		$requete->bindValue(':login', $personne->getLoginPersonne());

		$retour=$requete->execute();
		$requete->closeCursor();

		return $retour;
	}

	public function updatePasswordOfPersonne($idPersonne, $passwordProtected){
		$sql = 'UPDATE personne SET per_pwd = :passwd
						WHERE per_num = :num';
		$requete = $this->db->prepare($sql);

		$requete->bindValue(':num', $idPersonne);
		$requete->bindValue(':passwd', $passwordProtected);

		$retour=$requete->execute();
		$requete->closeCursor();

		return $retour;
	}

	public function supprimerPersonne($idPersonne){

			$sql = 'DELETE FROM avis WHERE per_num = :num';
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':num', $idPersonne);
			$retour=$requete->execute();
			$requete->closeCursor();

			$sql = 'DELETE FROM avis WHERE per_per_num = :num';
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':num', $idPersonne);
			$retour=$requete->execute();
			$requete->closeCursor();

			$sql = 'DELETE FROM etudiant WHERE per_num = :num';
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':num', $idPersonne);
			$retour=$requete->execute();
			$requete->closeCursor();

			$sql = 'DELETE FROM salarie WHERE per_num = :num';
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':num', $idPersonne);
			$retour=$requete->execute();
			$requete->closeCursor();

			$sql = 'DELETE FROM propose WHERE per_num = :num';
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':num', $idPersonne);
			$retour=$requete->execute();
			$requete->closeCursor();

			$sql = 'DELETE FROM personne WHERE per_num = :num';
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':num', $idPersonne);
			$retour=$requete->execute();
			$requete->closeCursor();

			return $retour;
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

	public function getAllPersonnes(){

		$sql = 'SELECT per_num, per_nom, per_prenom FROM personne';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($personne = $requete->fetch(PDO::FETCH_OBJ)){
			$listePersonnes[] = new Personne($personne);
		}

		$requete->closeCursor();
		return $listePersonnes;
	}

	public function estEtudiant($numPersonne){
		$sql = 'SELECT per_num FROM etudiant WHERE per_num = :num';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':num', $numPersonne);

		$requete->execute();

		$resultat = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		return $resultat != null;
	}

	public function getPersonne($numPersonne){
		$sql = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login FROM personne WHERE per_num = :num';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':num', $numPersonne);
		$requete->execute();

		$personne = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		$newPersonne = new Personne($personne);
		return $newPersonne;
	}

	public function getNumPersonneWithLogin($loginPersonne){
		$sql = 'SELECT per_num FROM personne WHERE per_login = :login';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':login', $loginPersonne);
		$requete->execute();

		$resultat = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		return $resultat->per_num;
	}
}
