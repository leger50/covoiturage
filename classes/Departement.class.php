<?php
class Departement{
	private $num;
	private $nom;
	private $villeNum;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'dep_num' :
					$this->setNumDepartement($valeur);
					break;

				case 'dep_nom' :
					$this->setNomDepartement($valeur);
					break;

				case 'vil_num' :
					$this->setNumVilleDivision($valeur);
					break;
			}
		}
	}

	public function getNumDepartement(){
		return $this->num;
	}

	public function setNumDepartement($num){
		if(is_numeric($num)){
			$this->num = $num;
		}
	}

	public function getNomDepartement(){
		return $this->nom;
	}

	public function setNomDepartement($nom){
		$this->nom = $nom;
	}

	public function getNumVilleDivision(){
		return $this->villeNum;
	}

	public function setNumVilleDivision($villeNum){
		if(is_numeric($villeNum)){
			$this->villeNum = $villeNum;
		}
	}

}
