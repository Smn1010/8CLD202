<?php
session_start();
require_once('Controller/Fonctions.php');
include('views/menu.php');


require_once('views/fonctions.php');// vette fonction se trouve dans le dossier view 
$users = []; // Initialisation de $users pour éviter une erreur si la recherche ne retourne rien

if (isset($_POST['rechercher'])) {
    // Récupérez les valeurs du formulaire
    $profession = $_POST['Profession'];
    $ville = $_POST['ville'];

    // Appelez votre fonction de recherche
    $users = rechercherUser($profession, $ville);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>index </title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
</head>
<body>
    <main>

        <section class="sign-in-form section-padding">
            <div class="container">
            <?php

                afficherFormulaireRecherche();
                if (!empty($users)) {
                afficherResultatsUtilisateurs($users) ;
                } 
            ?>      
                </div>
        </section>

    </main>
           <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>




     
</body>

</html>

