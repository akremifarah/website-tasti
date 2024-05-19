<meta charset="UTF-8">
<?php

require_once '../model/reservation_model.php';
require_once '../config/config.php';
class reservationController
{
    private $connexion;

    public function __construct()
    {
        $conn = new Config();
        $this->connexion = $conn->getConnexion();
    }
    public function createReservation($cin,$idvoiture,$date_sortir,$date_retour)
    {
        return new reservation($cin,$idvoiture,$date_sortir,$date_retour);
    }

    public function getReservation()
    {
        try {
            // Préparer une requête SQL pour sélectionner tous les utilisateurs
            $req = "SELECT * FROM reservation";
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
    public function getReservationById($id)
    {
        $users = $this->getReservation();
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                $userModel = new UserModel($user['cin'], $user['idvoiture'], $user['date_sortir'], $user['date_retour']);
                return $userModel;
            }
        }
        echo "<p class='error'>Aucun utilisateur trouvé avec l'ID " . $id . "</p>";
    }

    public function addReservation($reservation)
    {
        try {
            // Préparez la requête SQL avec des marqueurs de paramètre
            $req = "INSERT INTO `reservation` (`cin`, `idvoiture`, `date_sortir`, `date_retour`) 
                VALUES (:cin, :idvoiture, :date_sortir, :date_retour)";
            $res = $this->connexion->prepare($req);

            // Liaison des valeurs avec bindValue
            $res->bindValue(':cin', $reserv->getcin());
            $res->bindValue(':idvoiture', $reserv->getidvoiture());
            $res->bindValue(':date_sortir', $reserv->getdate_sortir());
            $res->bindValue(':date_retour', $reserv->getdate_retour());

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
    public function updateReservation($cin,$idvoiture,$date_sortir,$date_retour)
    {
        
    }
    public function deleteReservation($id)
    {
        $req = "DELETE FROM reservation WHERE idvoiture = ?";
        $res = $this->connexion->prepare($req);
        $res->execute($id);
    }
    
}
?>