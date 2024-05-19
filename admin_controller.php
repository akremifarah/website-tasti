<meta charset="UTF-8">
<?php

require_once '../model/admin_model.php';
require_once '../config/config.php';
class adminController
{
    private $connexion;

    public function __construct()
    {
        $conn = new Config();
        $this->connexion = $conn->getConnexion();
    }

    public function createUser($idadmin,$cin, $nom, $prenom,$mdp,$tlph)
    {
        return new admin_model($idadmin,$cin, $nom, $prenom,$mdp,$tlph);
    }
    public function getUsers()
    {
        try {
            // Préparer une requête SQL pour sélectionner tous les utilisateurs
            $req = "SELECT * FROM admin";
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
    public function getUserById($id)
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                $userModel = new adminModel($user['idadmin'],$user['cin'], $user['nom'], $user['prenom'], $user['mdp'], $user['tlph']);
                return $userModel;
            }
        }
        echo "<p class='error'>Aucun utilisateur trouvé avec l'ID " . $id . "</p>";
    }
    public function addUser($user)
    {
        try {
            // Préparez la requête SQL avec des marqueurs de paramètre
            $req = "INSERT INTO `admin` (`idadmin`,`cin`, `nom`, `prenom`, `mdp`, `tlph`) 
                VALUES (:idadmin,:cin, :nom, :prenom, :mdp, :tlph)";
            $res = $this->connexion->prepare($req);

            // Liaison des valeurs avec bindValue
            $res->bindValue(':idadmin', $user->getidadmin());
            $res->bindValue(':cin', $user->getcin());
            $res->bindValue(':nom', $user->getnom());
            $res->bindValue(':prenom', $user->getprenom());
            $res->bindValue(':mdp', $user->getmdp());
            $res->bindValue(':tlph', $user->gettlph());

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
    public function updateUser($idadmin,$cin, $nom, $prenom,$mdp,$tlph)
    {
    }
    public function deleteUser($id)
    {
        $req = "DELETE FROM admin WHERE idadmin = ?";
        $res = $this->connexion->prepare($req);
        $res->execute($id);
    }
    
    

    public function logIn($cin, $mdp)
    {
        $sql = "SELECT * FROM admin WHERE cin = :cin AND mdp = :mdp limit 1";
        $res = $this->connexion->prepare($sql);
        $res->bindValue(':cin', $cin);
        $res->bindValue(':mdp', $mdp);
        $res->execute();
        if ($res->rowCount() > 0) {
            echo "Le nom d'utilisateur existe dans la base de données.";
            session_start();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $_SESSION['idadmin'] = $idadmin;
            $_SESSION['cin'] = $cin;
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['prenom'] = $row['prenom'];
            $_SESSION['mdp'] = $mdp;
            $_SESSION['tlph'] = $row['tlph'];
            $_SESSION['loggedin'] = true;
            header("location:page_administrateur.php");
            return true;
        } else {
            echo "Email ou mot de passe incorrect";
            return false;

        }

    }


    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:../view/acceuil.php");

    }

}
?>