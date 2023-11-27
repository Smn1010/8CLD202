<?php
session_start();
include('menu_connexion.php');
require_once('../Controller/Fonctions.php');

if (!isset($_SESSION['ident'])) {
    // Redirigez l'utilisateur vers la page de connexion ou une autre page de gestion de la session s'il n'est pas connecté.
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['ident']; 

$user_data = getUserDataById($user_id);




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
                <div class="col-md-2">
                    <a href="modiffie_profile.php"class="profile-edit-btn">Editer  Profile  </a>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="row align-items-start">
        <div class="col-md-6">
        
        </div>
        <div class="col-md-6">
    
            
        </div>
    </div>
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
