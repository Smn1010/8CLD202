<?php
session_start();
require_once('Fonctions.php');
if (isset($_POST['save_profile'])) 
{
    $user_id = $_SESSION['ident'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $profession = $_POST['profession'];
    $numerotel = $_POST['numerotel'];
    $numero_maison = $_POST['numero_maison'];
    $nom_rue = $_POST['nom_rue'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $user_id = $_SESSION['ident'];
    $isModified = modifieruserpro($nom, $prenom, $email, $profession, $numerotel, $numero_maison, $nom_rue, $code_postal, $ville, $pays, $user_id);

    if ($isModified) {
        header('Location: ../views/profile.php');
        exit();
    } else {
        $errorMessage = "Une erreur s'est produite lors de la modification du profil.";
    }
}