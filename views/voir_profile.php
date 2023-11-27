<?php
require_once('../Controller/Fonctions.php');
include('menu.php');

// Récupérez l'ID de l'utilisateur à partir de la requête
$user_id = isset($_GET['id']) ? $_GET['id'] : null;

// Assurez-vous que l'ID est valide (non vide et numérique)
if (!empty($user_id) && is_numeric($user_id)) {
    // Utilisez $user_id pour récupérer les informations de l'utilisateur
    $user_data = getUserDataById($user_id);

    if ($user_data) { // Vérifiez si les données de l'utilisateur sont disponibles
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="../css/style-6.css">
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        </head>
        <body>
            <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <?php
                                $image = recupererImageUtilisateur($user_data['email']);
                                if ($image) {
                                    echo '<img src="data:' . $image['type_mime'] . ';base64,' . base64_encode($image['donnees_image']) . '" width="100" class="rounded-circle">';
                                } else {
                                    echo '<img src="https://media.istockphoto.com/vectors/profile-anonymous-face-icon-gray-silhouette-person-male-default-vector-id903053114?k=20&m=903053114&s=170667a&w=0&h=PfLuZ_Q-Yh3Qk3cKq7GLcCQFCsqRL1100YjYz5VF2t4=" width="100" class="rounded-circle">';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <h5><?php echo $user_data['nom']." ".$user_data['prenom']; ?></h5>
                                <h6><?php echo $user_data['profession']?></h6>
                                <p><?php echo $user_data['email']?></p>
                                <p><?php echo $user_data['numerotel']?></p>
                                <p><?php echo $user_data['ville']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row align-items-start">
                                        <div class="col-md-6">
                                            <!-- Ajoutez ici le contenu pour la première moitié de la page -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Ajoutez ici le contenu pour la deuxième moitié de la page -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "ID d'utilisateur non trouvé";
    }
} else {
    // Gérez le cas où l'ID n'est pas valide
    echo "ID d'utilisateur non valide";
}
?>
