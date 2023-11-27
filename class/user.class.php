
<?php

class Userpro
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $motdepasse;
    public $profession;
    public $numerotel;

    

    /***************** ID ******************/
    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    /***************** nom ******************/
    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function getNom()
    {
        return $this->nom;
    }

    /***************** prenom ******************/
    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }
  
 /***************** EMAIL ******************/
    function setEmail($email)
    {
        $this->email = $email;
    }

    function getEmail()
    {
        return $this->Email;
    }

    /***************** motdepasse******************/
    function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
    }

    function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /***************** profession ******************/
    function setProfession($profession)
    {
        $this->profession = $profession;
    }

    function getProfession()
    {
        return $this->profession;
    }
    /*****************numerotel ******************/
    function setNumerotel($numerotel)
    {
        $this->numerotel = $numerotel;
    }

    function getNumerotel()
    {
        return $this->numerotel;
    }
        /**
     * @return bool indiquant si l'ajout a été réalisé
     */
    function addUser(string $nom, string $prenom, string $email, string $password, $permission = 1): bool
    {
        $salt = password_hash($password, CRYPT_BLOWFISH);
        $sql = <<<EOD
        INSERT INTO Account (firstName,name,mail,password,permission)
        values (:firstname, :nom, :email, :salt, :permission)
EOD;
        $stmt = $this->getServerLink()->prepare($sql);
        $stmt->bindValue(':firstname', $prenom);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':salt', $salt);
        $stmt->bindValue(':permission', $permission);

        $exist = $this->exist($email);
        $isAdded = false;
        if (!$exist) {
            try {
                $isAdded = $stmt->execute();
            } catch (PDOException $e) {
                $isAdded = false;
            }
        }
        return $isAdded;
    }
}

?>