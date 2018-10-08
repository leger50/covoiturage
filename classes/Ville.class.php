<?php
class Ville{
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
				case 'vil_num' :
					$this->setNumVille($valeur);
					break;

				case 'vil_nom' :
					$this->setNomVille($valeur);
			}
		}
	}

	public function getNumVille(){
		return $this->num;
	}

	public function setNumVille($num){
		if(is_numeric($num)){
			$this->num = $num;
		}
	}

	public function getNomVille(){
		return $this->nom;
	}

	public function setNomVille($nom){
		$this->nom = $nom;
	}

}
