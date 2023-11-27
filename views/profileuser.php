<?php
require_once('../Controller/Fonctions.php');
//include('menu_no_connexion.php');
// Récupérez l'ID de l'utilisateur à partir de la requête
$user_id = isset($_GET['id']) ? $_GET['id'] : null;

// Assurez-vous que l'ID est valide (non vide et numérique)
if (!empty($user_id) && is_numeric($user_id)) {
    // Utilisez $user_id pour récupérer les informations de l'utilisateur et afficher le profil
    // ...
} else {
    // Gérez le cas où l'ID n'est pas valide
    echo "ID d'utilisateur non valide";
}
$user_data = getUserDataById($user_id);
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styleprofileuser.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<div class="container">

    <div class="row">
        <div class="col-md-4">
            <div class="card user-card">
                <div class="card-header">
                    <h5>Profile</h5>
                </div>
                <div class="card-block">
                    <div class="user-image">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image">
                    </div>
                    <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                    <p class="text-muted">Active | Male | Born 23.05.1992</p>
                    <hr>
                    <p class="text-muted m-t-15">Activity Level: 87%</p>
                    <ul class="list-unstyled activity-leval">
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                    </ul>
                    

        </div>
	</div>
</div>
</div>
</body>
</html>