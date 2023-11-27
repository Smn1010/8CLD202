<?php

    require_once('../Connexion/Connexion.php');
    require_once('../Controller/Fonctions.php');
    //session_start();
    if (isset($_SESSION['ident']))
     {
        header('Location: ../views/accueil.php');
        exit();
    }

    if (!empty($_POST)) {
   

    $email =  filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $userident = null;

    if (isset($email) && isset($password)) {
        $userident = authentification($email, $password);
       
    }
    if ($userident == null) {
        $_SESSION['echec'] = true;
        echo"bonjour";
    } else {
        $_SESSION['ident'] = $userident->getId();
        $_SESSION['nom'] = $userident->getNom();
        $_SESSION['prenom'] = $userident->getPrenom();
        $_SESSION['email'] = $userident->getEmail();
        $_SESSION['profession'] = $userident->getProfession();
        $_SESSION['email'] = $userident->getEmail();
        unset($_SESSION['echec']);
        header('Location: ../views/accueil.php');
    }
}
?>