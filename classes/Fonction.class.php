<?php
class Fonction{
	private $num;
	private $libelle;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'fon_num' :
					$this->setNumFonction($valeur);
					break;

				case 'fon_libelle' :
					$this->setLibelleFonction($valeur);
					break;
			}
		}
	}

	public function getNumFonction(){
		return $this->num;
	}

	public function setNumFonction($num){
		if(is_numeric($num)){
			$this->num = $num;
		}
	}

	public function getLibelleFonction(){
		return $this->libelle;
	}

	public function setLibelleFonction($libelle){
		$this->libelle = $libelle;
	}

}
