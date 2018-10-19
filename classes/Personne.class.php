<?php
class Personne{
	private $num;
	private $nom;
	private $prenom;
	private $tel;
	private $mail;
	private $login;
	private $passwd;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'per_num' :
					$this->setNumPersonne($valeur);
					break;

				case 'per_nom' :
					$this->setNomPersonne($valeur);
					break;

				case 'per_prenom' :
					$this->setPrenomPersonne($valeur);
					break;

				case 'per_tel' :
					$this->setTelPersonne($valeur);
					break;

				case 'per_mail' :
					$this->setMailPersonne($valeur);
					break;

				case 'per_login' :
					$this->setLoginPersonne($valeur);
					break;

				case 'per_pwd' :
					$this->setPasswdPersonne($valeur);
					break;
			}
		}
	}

	public function getNumPersonne(){
		return $this->num;
	}

	public function setNumPersonne($num){
		if(is_numeric($num)){
			$this->num = $num;
		}
	}

	public function getNomPersonne(){
		return $this->nom;
	}

	public function setNomPersonne($nom){
		$this->nom = $nom;
	}

	public function getPrenomPersonne(){
		return $this->prenom;
	}

	public function setPrenomPersonne($prenom){
		$this->prenom = $prenom;
	}

	public function getTelPersonne(){
		return $this->tel;
	}

	public function setTelPersonne($tel){
		$this->tel = $tel;
	}

	public function getMailPersonne(){
		return $this->mail;
	}

	public function setMailPersonne($mail){
		$this->mail = $mail;
	}

	public function getLoginPersonne(){
		return $this->login;
	}

	public function setLoginPersonne($login){
		$this->login = $login;
	}

	public function getPasswdPersonne(){
		return $this->passwd;
	}

	public function setPasswdPersonne($passwd){ //a encrypter
		$this->passwd = $passwd;
	}

}
