<?php
class EtudiantManager{
	//echo $pdo->lastInsertId();
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

	public function addPersonneEtudiante($personne){
		$personneManager = new PersonneManager($this->db);
		$retour = $personneManager->addPersonne($personne);
		return $retour;
	}

}
