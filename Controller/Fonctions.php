<?php
require_once(__DIR__ . '/../Connexion/Connexion.php');
require_once(__DIR__ . '/../class/user.class.php');
if (session_status() == PHP_SESSION_NONE) {
    
    session_start();
}
function authentification(string $login, string $password): ?userpro
    { 
        $sql = <<<EOD
            select id,nom,prenom,email,motdepasse,profession,numerotel
            from userpro where email=:email
            EOD;
            $stmt = connectToDatabase()->prepare($sql);
            $stmt->bindValue(':email', $login);
            $stmt->execute();
            $row = $stmt->fetch();
    if ( password_verify($password, $row['motdepasse'])) {
        $user = new userpro();
        $user->setId($row['id']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setEmail($row['email']);
        $user->setProfession($row['profession']);
        $user->setNumerotel($row['numerotel']);
        return $user;
        
        }
        else{
            return null;
        }
        
    }
function insererImage($user_id, $nom_fichier, $type_mime, $donnees_image) {
    try {
        // Connexion à la base de données
        $conn = connectToDatabase();
        
        // Préparation de la requête d'insertion
        $sql = "INSERT INTO images (user_id, nom_fichier, type_mime, donnees_image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Liaison des valeurs
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nom_fichier, PDO::PARAM_STR);
        $stmt->bindParam(3, $type_mime, PDO::PARAM_STR);
        $stmt->bindParam(4, $donnees_image, PDO::PARAM_LOB);
        
        if ($stmt->execute()) {
            echo "L'image a été enregistrée dans la base de données.";
        } else {
            echo "Erreur lors de l'enregistrement de l'image : " . $stmt->errorInfo();
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
}

function addUser(string $nom, string $prenom, string $email, string $password, $profession, $numerotel, $numero_maison, $nom_rue, $code_postal, $ville, $pays): bool
{
     if (exist($email)) 
     {
        echo "cet utilisateur  existe déjà. Veuillez Vous connecter .";
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $db = connectToDatabase();
    $db->beginTransaction();

    $sqlUser = <<<EOD
    INSERT INTO userpro (nom, prenom, email, motdepasse, profession, numerotel)
    VALUES (:nom, :prenom, :email, :motdepasse, :profession, :numerotel)
    EOD;
    $stmtUser = $db->prepare($sqlUser);
    $stmtUser->bindValue(':nom', $nom);
    $stmtUser->bindValue(':prenom', $prenom);
    $stmtUser->bindValue(':email', $email);
    $stmtUser->bindValue(':motdepasse', $hashedPassword);
    $stmtUser->bindValue(':profession', $profession);
    $stmtUser->bindValue(':numerotel', $numerotel);
    try 
    {
        $isUserAdded = $stmtUser->execute();
        if ($isUserAdded) 
        {
            $userId = $db->lastInsertId();
            $sqlAddress = <<<EOD
            INSERT INTO adresse (userpro_id, numero_maison, nom_rue, code_postal, ville, pays)
            VALUES (:userpro_id, :numero_maison, :nom_rue, :code_postal, :ville, :pays)
            EOD;

            $stmtAddress = $db->prepare($sqlAddress);
            $stmtAddress->bindValue(':userpro_id', $userId);
            $stmtAddress->bindValue(':numero_maison', $numero_maison);
            $stmtAddress->bindValue(':nom_rue', $nom_rue);
            $stmtAddress->bindValue(':code_postal', $code_postal);
            $stmtAddress->bindValue(':ville', $ville);
            $stmtAddress->bindValue(':pays', $pays);

            $isAddressAdded = $stmtAddress->execute();

            if ($isAddressAdded) {
                $db->commit(); // Valide les opérations
                return true;
            } else {
                $db->rollBack(); // Annule les opérations en cas d'erreur d'adresse
                return false;
            }
        } else 
        {
            $db->rollBack(); // Annule les opérations en cas d'erreur d'utilisateur
            return false;
        }
    }catch (PDOException $e)
     {
        $db->rollBack(); // Annule les opérations en cas d'exception
        return false;
    }
}

function getUserDataById($user_id) 
{
    $db = connectToDatabase();

    $sql = "SELECT userpro.id, userpro.nom, userpro.prenom, adresse.pays, adresse.numero_maison, adresse.nom_rue, adresse.code_postal,adresse.ville, userpro.email, userpro.profession, userpro.numerotel FROM userpro 
    INNER JOIN adresse ON userpro.id = adresse.userpro_id 
    LEFT JOIN images ON userpro.id = images.user_id
    WHERE userpro.id = :user_id";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function search($query)
    {

        /** Return Variable */
        $result = null;

        /** Get server connection */
        $db = connectToDatabase()->prepare($query);

        /** Send reguest */
        if ($db != null) {
            $request = $db->execute();
        }

        /** Check return request */
        if (!$request) {

            $result = 'error query: ' . $query;
        } else {

            $result = $db->fetchAll();
        }

        return $result;
    }
 function exist($userEmail)
    {
        $exist = false;
        if ($userEmail !== "") 
        {

            /** SELECT request */
            $Qbegin = "SELECT email FROM `userpro` ";
            $Qwhere = "WHERE email='" . $userEmail . "' ";

            /** Send request */
            $data = search($Qbegin . $Qwhere);

            if ($data) {
                $exist = true;
            }
        }
        return $exist;
    }
    function recupererImageUtilisateur($email) 
    {
        try {
            // Préparation de la requête pour récupérer l'image de l'utilisateur par e-mail
            $sql = "SELECT nom_fichier, type_mime, donnees_image FROM images 
                    WHERE user_id = (SELECT id FROM userpro WHERE email = :email)";
            $stmt = connectToDatabase()->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Exécution de la requête
            $stmt->execute();

            // Récupération de l'image
            $image = $stmt->fetch(PDO::FETCH_ASSOC);

            return $image;
        } catch (PDOException $e) {
            // Gestion des erreurs (à personnaliser)
        return false;
    }
}


function rechercherUser($profession, $ville)
{
    try 
    {
        $sql = "SELECT userpro.id, userpro.nom, userpro.prenom, userpro.profession, userpro.email, userpro.numerotel, adresse.numero_maison, adresse.nom_rue, adresse.code_postal, adresse.ville, adresse.pays, images.nom_fichier, images.type_mime, images.donnees_image
                FROM userpro
                INNER JOIN adresse ON userpro.id = adresse.userpro_id
                LEFT JOIN images ON userpro.id = images.user_id
                WHERE userpro.profession = :profession
                AND adresse.ville = :ville";

        $stmt = connectToDatabase()->prepare($sql);
        $stmt->bindValue(':profession', $profession, PDO::PARAM_STR);
        $stmt->bindValue(':ville', $ville, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) 
    {
        echo "Erreur SQL : " . $e->getMessage();
        return false;
    }
}



function modifieruserpro($nom, $prenom, $email, $profession, $numerotel, $numero_maison, $nom_rue, $code_postal, $ville, $pays, $idUser) 
{
    $db = connectToDatabase();
    $db->beginTransaction();

    $sqlUser = <<<EOD
    UPDATE userpro
    SET nom = :nom, prenom = :prenom, email = :email, profession = :profession, numerotel = :numerotel
    WHERE id = :idUser
    EOD;

    $stmtUser = $db->prepare($sqlUser);
    $stmtUser->bindValue(':nom', $nom);
    $stmtUser->bindValue(':prenom', $prenom);
    $stmtUser->bindValue(':email', $email);
    $stmtUser->bindValue(':profession', $profession);
    $stmtUser->bindValue(':numerotel', $numerotel);
    $stmtUser->bindValue(':idUser', $idUser);

    $sqlAddress = <<<EOD
    UPDATE adresse
    SET numero_maison = :numero_maison, nom_rue = :nom_rue, code_postal = :code_postal, ville = :ville, pays = :pays
    WHERE userpro_id = :idUser
    EOD;

    $stmtAddress = $db->prepare($sqlAddress);
    $stmtAddress->bindValue(':numero_maison', $numero_maison);
    $stmtAddress->bindValue(':nom_rue', $nom_rue);
    $stmtAddress->bindValue(':code_postal', $code_postal);
    $stmtAddress->bindValue(':ville', $ville);
    $stmtAddress->bindValue(':pays', $pays);
    $stmtAddress->bindValue(':idUser', $idUser);

    try 
    {
        $isUserUpdated = $stmtUser->execute();
        $isAddressUpdated = $stmtAddress->execute();

        if ($isUserUpdated && $isAddressUpdated) {
            $db->commit(); // Valide les opérations
            return true;
        } else {
            $db->rollBack(); // Annule les opérations en cas d'erreur
            return false;
        }
    }catch (PDOException $e) {
        $db->rollBack(); // Annule les opérations en cas d'exception
        return false;
    }
}


?>
