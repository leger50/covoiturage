<?php
class Avis{
	private $perNumCible;
	private $perNumAuteur;
  private $parcoursNum;
  private $commentaire;
  private $note;
  private $date;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'per_num' :
					$this->setNumPersonneCiblee($valeur);
					break;

				case 'per_per_num' :
					$this->setNumPersonneAuteur($valeur);
					break;

        case 'par_num' :
					$this->setNumParcours($valeur);
					break;

        case 'avi_comm' :
					$this->setAvisCommentaire($valeur);
					break;

        case 'avi_note' :
					$this->setAvisNote($valeur);
					break;

        case 'avi_date' :
					$this->setDateAvis($valeur);
					break;
			}
		}
	}

	public function getNumPersonneCiblee(){
		return $this->perNumCible;
	}

	public function setNumPersonneCiblee($num){
		if(is_numeric($num)){
			$this->perNumCible = $num;
		}
	}

	public function getNumPersonneAuteur(){
		return $this->perNumAuteur;
	}

	public function setNumPersonneAuteur($num){
    if(is_numeric($num)){
			$this->perNumAuteur = $num;
		}
	}

  public function getNumParcours(){
		return $this->parcoursNum;
	}

	public function setNumParcours($num){
    if(is_numeric($num)){
			$this->parcoursNum = $num;
		}
	}

  public function getAvisCommentaire(){
		return $this->commentaire;
	}

	public function setAvisCommentaire($commentaire){
		$this->commentaire = $commentaire;
	}

  public function getAvisNote(){
		return $this->note;
	}

	public function setAvisNote($note){
    if(is_numeric($valeur) && ($valeur >= 0 && $valeur <=5)){
		    $this->note = $note;
    }
	}

  public function getDateAvis(){
		return $this->date;
	}

	public function setDateAvis($date){
		$this->date = $date;
	}
}
