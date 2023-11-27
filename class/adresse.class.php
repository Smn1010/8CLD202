<?php
class Adresse {
    public $id;
    public $nomRue;
    public $numeroMaison;
    public $codePostal;
    
    public $ville;
    public $pays;
    public $userProId;

    public function __construct($nomRue,$numeroMaison, $codePostal,  $ville, $pays, $userProId, $id = null) {
        $this->id = $id;
        $this->nomRue = $nomRue;
        $this->numeroMaison = $numeroMaison;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->userProId = $userProId;
    }

    public function getId() {
        return $this->id;
    }

    public function getNomRue() {
        return $this->nomRue;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function getNumeroMaison() {
        return $this->numeroMaison;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getPays() {
        return $this->pays;
    }

    public function getUserProId() {
        return $this->userProId;
    }
}
?>