<?php
class Propose{
	private $parcoursNum;
	private $personneNum;
	private $date;
	private $heure;
	private $nbPlaces;
	private $sensTrajet;

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

				case 'per_num' :
					$this->setNumPersonnePropose($valeur);
					break;

				case 'pro_date' :
					$this->setDatePropose($valeur);
					break;

				case 'pro_time' :
					$this->setHeurePropose($valeur);
					break;

				case 'pro_place' :
					$this->setNbPlacesPropose($valeur);
					break;

				case 'pro_sens' :
					$this->setSensPropose($valeur);
					break;
			}
		}
	}

	public function getNumParcours(){
		return $this->parcoursNum;
	}

	public function setNumParcours($parcoursNum){
		if(is_numeric($parcoursNum)){
			$this->parcoursNum = $parcoursNum;
		}
	}

	public function getNumPersonnePropose(){
		return $this->personneNum;
	}

	public function setNumPersonnePropose($personneNum){
		if(is_numeric($personneNum)){
			$this->personneNum = $personneNum;
		}
	}

	public function getDatePropose(){
		return $this->date;
	}

	public function setDatePropose($date){
		$this->date = $date;
	}

	public function getHeurePropose(){
		return $this->heure;
	}

	public function setHeurePropose($heure){
		$this->heure = $heure;
	}

	public function getNbPlacesPropose(){
		return $this->nbPlaces;
	}

	public function setNbPlacesPropose($nbPlaces){
		if(is_numeric($nbPlaces)){
			$this->nbPlaces = $nbPlaces;
		}
	}

	public function getSensPropose(){
		return $this->sensTrajet;
	}

	public function setSensPropose($sensTrajet){
		if(is_numeric($sensTrajet)){
			$this->sensTrajet = $sensTrajet;
		}
	}

}
