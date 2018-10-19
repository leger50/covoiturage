<?php
class Etudiant{
	private $personneObj;

	private $numDepartement;
	private $numDivision;

	public function __construct($personneObj, $valeursEtudiant){
		if(!empty($valeursEtudiant)){
			$this->affecte($personneObj, $valeursEtudiant);
		}
	}

	public function affecte($personneObj, $valeursEtudiant){
		$this->setPersonneEtudiant($personneObj);

		foreach($valeursEtudiant as $attribut => $valeur){

			switch($attribut){
				case 'dep_num' :
					$this->setNumDepartement($valeur);
					break;

				case 'div_num' :
					$this->setNumDivision($valeur);
					break;
			}
		}
	}

	public function getPersonneEtudiant(){
		return $this->personneObj;
	}

	public function setPersonneEtudiant($personneObj){
		$this->personneObj = $personneObj;
	}

	public function getNumDepartement(){
		return $this->numDepartement;
	}

	public function setNumDepartement($numDepartement){
		if(is_numeric($numDepartement)){
			$this->numDepartement = $numDepartement;
		}
	}

	public function getNumDivision(){
		return $this->numDivision;
	}

	public function setNumDivision($numDivision){
		if(is_numeric($numDivision)){
			$this->numDivision = $numDivision;
		}
	}
}
