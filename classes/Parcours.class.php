<?php
class Parcours{
	private $num;
	private $kms;
	private $idVille1;
	private $idVille2;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'par_num' :
					$this->setNumParcours($valeur);
					break;

				case 'par_km' :
					$this->setKmsParcours($valeur);
					break;

				case 'vil_num1' :
					$this->setVille1Parcours($valeur);
					break;

				case 'vil_num2' :
					$this->setVille2Parcours($valeur);
					break;
			}
		}
	}

	public function getNumParcours(){
		return $this->num;
	}

	public function setNumParcours($num){
		if(is_numeric($num)){
			$this->num = $num;
		}
	}

	public function getKmsParcours(){
		return $this->kms;
	}

	public function setKmsParcours($kms){
		if(is_numeric($kms)){
			$this->kms = $kms;
		}
	}

	public function getVille1Parcours(){
		return $this->idVille1;
	}

	public function setVille1Parcours($idVille1){
		if(is_numeric($idVille1)){
			$this->idVille1 = $idVille1;
		}
	}

	public function getVille2Parcours(){
		return $this->idVille2;
	}

	public function setVille2Parcours($idVille2){
		if(is_numeric($idVille2)){
			$this->idVille2 = $idVille2;
		}
	}

}
