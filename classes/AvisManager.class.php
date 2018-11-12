<?php
class AvisManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	/*public function addVille($ville){
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
	}*/

	public function getAverageOfPerson($personne){

		$sql = 'SELECT ROUND(AVG(avi_note), 1) as moyenne FROM avis WHERE per_num = :numPersonne';

		$requete = $this->db->prepare($sql);
    $requete->bindValue(':numPersonne', $personne);
		$requete->execute();

		$moyenne = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		if($moyenne->moyenne != null){
			return $moyenne->moyenne;
		}else{
			return "Non noté";
		}

	}

	public function getLastAvisOnPerson($personne){

		$sql = 'SELECT a.avi_comm FROM avis a
						WHERE a.per_num = :numPersonne
						ORDER by a.avi_date DESC
						LIMIT 1';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':numPersonne', $personne);
		$requete->execute();

		$avis = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		if($avis != null){
			return $avis->avi_comm;
		}else{
			return "Non noté";
		}
	}
}
