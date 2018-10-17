<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function addVille($ville){
		if($this->villeExiste($ville)){
			return false;

		}else{
			$sql = 'INSERT INTO ville(vil_nom) VALUES (:ville)';
			$requete = $this->db->prepare($sql);

			$requete->bindValue(':ville', $ville->getNomVille());

			$retour=$requete->execute();
			$requete->closeCursor();

			return $retour;
		}
	}

	public function villeExiste($ville){
		$sql = 'SELECT vil_nom FROM ville WHERE vil_nom = :ville';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':ville', $ville->getNomVille());

		$requete->execute();

		$resultat = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		return $resultat != null;
	}

	public function getAllVilles(){

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
	}
}
