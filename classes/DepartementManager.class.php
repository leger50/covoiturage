<?php
class DepartementManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllDepartements(){

		$sql = 'SELECT dep_num, dep_nom, vil_num FROM departement';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($departement = $requete->fetch(PDO::FETCH_OBJ)){
			$listeDepartements[] = new Departement($departement);
		}

		$requete->closeCursor();
		return $listeDepartements;
	}

	public function getDepartement($numDepartement){

		$sql = 'SELECT dep_num, dep_nom, vil_num FROM departement WHERE dep_num = :num';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':num', $numDepartement);
		$requete->execute();

		$departement = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		$newDepartement = new Departement($departement);
		return $newDepartement;
	}
}
