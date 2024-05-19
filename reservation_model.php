<?php
 class reservation
 {


private $cin ;
private $idvoiture;
private $date_sortir;
private $date_entrer;



public function __construct($cin,$idvoiture,$date_sortir,$date_retour ){
    $this->cin = $cin;
        $this->idvoiture= $idvoiture;
        $this->date_sortir= $date_sortir;
        $this->date_retour= $date_retour;
    

}
public function getcin()
    {
        return $this->cin;
    }

 public function setcin($cin)
    {
        $this->cin = $cin;
}

public function getidvoiture() {
    return $this->idvoiture;
}

public function setidvoiture() {
    $this->idvoiture = $idvoiture;


public function getdate_sortir() {
    return $this->date_sortir;
}

public function setdate_sortir() {
    $this->date_sortir = $date_sortir;
}    

public function getdate_retour() {
    return $this->date_retour;
}

public function setdate_retour() {
    $this->date_retour = $date_retour;
} 
}
}
?>