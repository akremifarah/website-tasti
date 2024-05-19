<?php 
class voiture
{
    private $idvoiture;
    private $libelle;
    private $disponibilite;
    public function __construct($idvoiture, $libelle, $disponibilite)
    {
        $this->idvoiture = $idvoiture;
        $this->libelle = $libelle;
        $this->disponibilite= $disponibilite;
}
public function getidvoiture()
    {
        return $this->idvoiture;
    }

    public function setidvoiture($idvoiture)
    {
        $this->idvoiture = $idvoiture;
    }
    public function getlibelle()
    {
        return $this->libelle;
    }

    public function setlibelle($libelle)
    {
        $this->libelle = $libelle;
    }
    public function getdisponibilite()
    {
        return $this->disponibilite;
    }

    public function setdisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }


}
?>