<?php
class SalarieManager{
	//echo $pdo->lastInsertId();
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function addSalarie($salarie){

		if(!$this->addPersonneSalarie($salarie->getPersonneSalarie())){
			return false;

		}else{
			$sql = 'INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES (:num, :tel, :numFonction)';
			$requete = $this->db->prepare($sql);

			$requete->bindValue(':num', $this->db->lastInsertId());
			$requete->bindValue(':tel', $salarie->getTelPro());
			$requete->bindValue(':numFonction', $salarie->getNumFonction());

			$retour=$requete->execute();
			$requete->closeCursor();

			return $retour;
		}
	}

	private function addPersonneSalarie($personne){
		$personneManager = new PersonneManager($this->db);
		$retour = $personneManager->addPersonne($personne);
		return $retour;
	}

	public function getSalarie($personne, $numSalarie){

		$sql = 'SELECT sal_telprof, fon_num FROM salarie WHERE per_num = :num';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':num', $numSalarie);
		$requete->execute();

		$salarie = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		$newSalarie = new Salarie($personne, $salarie);
		return $newSalarie;
	}

}
