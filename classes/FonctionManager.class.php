<?php
class FonctionManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllFonctions(){

		$sql = 'SELECT fon_num, fon_libelle FROM fonction';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($fonction = $requete->fetch(PDO::FETCH_OBJ)){
			$listeFonctions[] = new Fonction($fonction);
		}

		$requete->closeCursor();
		return $listeFonctions;
	}
}
