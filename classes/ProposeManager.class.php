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

	public function getAllVillesDepart(){
		$sql = 'SELECT T.vil_num, v.vil_nom FROM(
							SELECT pa.vil_num1 as vil_num FROM propose po
							INNER JOIN parcours pa ON (po.par_num = pa.par_num)
							WHERE po.pro_sens = 0
							UNION
							SELECT pa.vil_num2 FROM propose po
							INNER JOIN parcours pa ON (po.par_num = pa.par_num)
							WHERE po.pro_sens = 1)T
						INNER JOIN ville v ON (v.vil_num = T.vil_num)';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($ville = $requete->fetch(PDO::FETCH_OBJ)){
			$listeVilles[] = new Ville($ville);
		}

		$requete->closeCursor();
		return $listeVilles;
	}

	public function rechercherTrajet($numParcours, $dateDepart, $heureDepart, $precision, $sensParcours){
		$sql = 'SELECT T.pro_date, T.pro_time, T.pro_place, p.per_nom, p.per_prenom FROM(
							SELECT po.pro_date, po.pro_time, po.pro_place, po.per_num FROM propose po
							INNER JOIN parcours pa ON(pa.par_num = po.par_num)
							WHERE po.par_num = :numParcours AND po.pro_sens = :sens AND pro_date >= DATE_ADD(:dateDepart, INTERVAL -(:precision) DAY) AND pro_date <= DATE_ADD(:dateDepart, INTERVAL +(:precision) DAY) AND HOUR(pro_time) >= :heureDepart)T
						INNER JOIN personne p ON (p.per_num = T.per_num)
						ORDER BY T.pro_date, T.pro_time';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':numParcours', $numParcours);
		$requete->bindValue(':sens', $sensParcours);
		$requete->bindValue(':dateDepart', $dateDepart);
		$requete->bindValue(':heureDepart', $heureDepart);
		$requete->bindValue(':precision', $precision);

		$requete->execute();

		while($trajet = $requete->fetch(PDO::FETCH_OBJ)){
			$listeTrajets[] = $trajet;
		}

		$requete->closeCursor();

		if(empty($listeTrajets)){
			return null;
		}

		return $listeTrajets;
	}

}
