<?php
class ProposeManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function addTrajetPropose($propose){
		$sql = 'INSERT INTO propose(par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES (:numParcours, :numPersonne, :dateTrajet, :heureTrajet, :nbPlaces, :sensTrajet)';
		$requete = $this->db->prepare($sql);

		$requete->bindValue(':numParcours', $propose->getNumParcours());
		$requete->bindValue(':numPersonne', $propose->getNumPersonnePropose());
		$requete->bindValue(':dateTrajet', $propose->getDatePropose());
		$requete->bindValue(':heureTrajet', $propose->getHeurePropose());
		$requete->bindValue(':nbPlaces', $propose->getNbPlacesPropose());
		$requete->bindValue(':sensTrajet', $propose->getSensPropose());

		$retour=$requete->execute();
		$requete->closeCursor();

		return $retour;
	}
}
