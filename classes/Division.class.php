<?php
class Division{
	private $num;
	private $nom;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'div_num' :
					$this->setNumDivision($valeur);
					break;

				case 'div_nom' :
					$this->setNomDivision($valeur);
					break;
			}
		}
	}

	public function getNumDivision(){
		return $this->num;
	}

	public function setNumDivision($num){
		if(is_numeric($num)){
			$this->num = $num;
		}
	}

	public function getNomDivision(){
		return $this->nom;
	}

	public function setNomDivision($nom){
		$this->nom = $nom;
	}

}
