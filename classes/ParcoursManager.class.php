<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function addParcours($parcours){

		if($this->parcoursExiste($parcours) OR !$this->parcoursEstValide($parcours)){
			return false;

		}else{
			$sql = 'INSERT INTO parcours(par_km, vil_num1, vil_num2) VALUES (:kms, :ville1, :ville2)';
			$requete = $this->db->prepare($sql);

			$requete->bindValue(':kms', $parcours->getKmsParcours());
			$requete->bindValue(':ville1', $parcours->getVille1Parcours());
			$requete->bindValue(':ville2', $parcours->getVille2Parcours());

			$retour=$requete->execute();
			$requete->closeCursor();

			return $retour;
		}
	}

	public function parcoursExiste($parcours){
		$sql = 'SELECT par_num FROM parcours WHERE (vil_num1 = :ville1 AND vil_num2 = :ville2) OR (vil_num1 = :ville2 AND vil_num2 = :ville1)';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':ville1', $parcours->getVille1Parcours());
		$requete->bindValue(':ville2', $parcours->getVille2Parcours());

		$requete->execute();

		$resultat = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		return $resultat != null;
	}

	public function parcoursEstValide($parcours){
		return $parcours->getVille1Parcours() !== $parcours->getVille2Parcours();
	}

	public function getAllParcours(){

		$sql = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($parcours = $requete->fetch(PDO::FETCH_OBJ)){
			$listeParcours[] = new Parcours($parcours);
		}

		$requete->closeCursor();
		return $listeParcours;
	}
}
