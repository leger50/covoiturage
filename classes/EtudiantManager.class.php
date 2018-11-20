<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function addEtudiant($etudiant){

		if(!$this->addPersonneEtudiante($etudiant->getPersonneEtudiant())){
			return false;

		}else{
			$sql = 'INSERT INTO etudiant(per_num, dep_num, div_num) VALUES (:num, :departement, :division)';
			$requete = $this->db->prepare($sql);

			$requete->bindValue(':num', $this->db->lastInsertId());
			$requete->bindValue(':departement', $etudiant->getNumDepartement());
			$requete->bindValue(':division', $etudiant->getNumDivision());

			$retour=$requete->execute();
			$requete->closeCursor();

			return $retour;
		}
	}

	private function addPersonneEtudiante($personne){
		$personneManager = new PersonneManager($this->db);
		$retour = $personneManager->addPersonne($personne);
		return $retour;
	}

	public function getEtudiant($personne, $numEtudiant){

		$sql = 'SELECT dep_num, div_num FROM etudiant WHERE per_num = :num';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':num', $numEtudiant);
		$requete->execute();

		$etudiant = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		$newEtudiant = new Etudiant($personne, $etudiant);
		return $newEtudiant;
	}

}
