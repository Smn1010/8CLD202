<?php
session_start();

require_once('../Controller/Fonctions.php');

if (!isset($_SESSION['ident'])) {
    // Redirigez l'utilisateur vers la page de connexion ou une autre page de gestion de la session s'il n'est pas connecté.
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['ident'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $nom_fichier = $_FILES['photo']['name'];
        $type_mime = $_FILES['photo']['type'];
        $donnees_image = file_get_contents($_FILES['photo']['tmp_name']);
        insererImage( $user_id, $nom_fichier, $type_mime, $donnees_image);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tooplate's Little Fashion - Sign In Page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="../css/slick.css"/>

        <link href="../css/tooplate-little-fashion.css" rel="stylesheet">
    <title>Modifier la Photo de Profil</title>
</head>
<body>
    <?php
                include('menu_connexion.php');
            ?>
            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto col-12">
                            <h1 class="hero-title text-center mb-5">Modifier la Photo de Profil</h1>
                            <div class="row">
                                    <div class="col-lg-8 col-11 mx-auto">
                                        <form action="modiffie_photo.php" method="post" enctype="multipart/form-data">
                                            <label for="photo">Sélectionnez une nouvelle photo :</label>
                                            </br>
                                            <input type="file" class="form-control" name="photo" accept="image/*">
                                            </br>
                                            <input type="submit" class="btn custom-btn form-control mt-4 mb-3" value="Upload">
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
   



     <!-- JAVASCRIPT FILES -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/Headroom.js"></script>
        <script src="../js/jQuery.headroom.js"></script>
        <script src="../js/slick.min.js"></script>
        <script src="../js/custom.js"></script>
</body>
</html>
