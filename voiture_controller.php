<meta charset="UTF-8">
<?php

require_once '../model/voiture_model.php';
require_once '../config/config.php';
class voitureController
{
    private $connexion;

    public function __construct()
    {
        $conn = new Config();
        $this->connexion = $conn->getConnexion();
    }

    public function createvoiture($idvoiture, $libelle, $disponibilite)
    {
        return new voiture($idvoiture, $libelle, $disponibilite);
    }
    public function getvoiture()
    {
        try {
            // Préparer une requête SQL pour sélectionner tous les utilisateurs
            $req = "SELECT * FROM voitureee";
            $res = $this->connexion->prepare($req);
            $res->execute();

            // Récupérer tous les résultats dans un tableau associatif
            $users = $res->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            // Gérer les erreurs en affichant un message
            echo "Erreur lors de la récupération des utilisateurs: " . $e->getMessage();
            return [];
        }
    }
    public function getvoitureById($id)
    {
        $users = $this->getvoiture();
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                $userModel = new UserModel($user['idvoiture'], $user['libelle'], $user['disponibilite']);
                return $userModel;
            }
        }
        echo "<p class='error'>Aucun utilisateur trouvé avec l'ID " . $id . "</p>";
    }
    public function addvoiture($user)
    {
        try {
            // Préparez la requête SQL avec des marqueurs de paramètre
            $req = "INSERT INTO `voitureee` (`idvoiture`, `libelle`, `disponibilite`) 
                VALUES (:idvoiture, :libelle, :disponibilite)";
            $res = $this->connexion->prepare($req);

            // Liaison des valeurs avec bindValue
            $res->bindValue(':idvoiture', $user->getidvoiture());
            $res->bindValue(':libelle', $user->getlibelle());
            $res->bindValue(':disponibilite', $user->getdisponibilite());

            // Exécution de la requête
            if ($res->execute()) {
                echo "<script>alert('Insertion des données réussie')</script>";
                return true;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion des données " . $e->getMessage();
            return false;
        }
    }
    public function updatevoiture($idvoiture, $libelle, $disponibilite)
    {
    }
    public function deletevoiture($id)
    {
        $req = "DELETE FROM voitureee WHERE idvoiture = ?";
        $res = $this->connexion->prepare($req);
        $res->execute($id);
    }
    
    

}
?>