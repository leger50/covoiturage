<?php
class Salarie{
	private $personneObj;

	private $telPro;
	private $numFonction;

	public function __construct($personneObj, $valeursSalarie){
		if(!empty($valeursSalarie)){
			$this->affecte($personneObj, $valeursSalarie);
		}
	}

	public function affecte($personneObj, $valeursSalarie){
		$this->setPersonneSalarie($personneObj);

		foreach($valeursSalarie as $attribut => $valeur){

			switch($attribut){
				case 'sal_telprof' :
					$this->setTelPro($valeur);
					break;

				case 'fon_num' :
					$this->setNumFonction($valeur);
					break;
			}
		}
	}

	public function getPersonneSalarie(){
		return $this->personneObj;
	}

	public function setPersonneSalarie($personneObj){
		$this->personneObj = $personneObj;
	}

	public function getTelPro(){
		return $this->telPro;
	}

	public function setTelPro($telPro){
			$this->telPro = $telPro;
	}

	public function getNumFonction(){
		return $this->numFonction;
	}

	public function setNumFonction($numFonction){
		if(is_numeric($numFonction)){
			$this->numFonction = $numFonction;
		}
	}
}
