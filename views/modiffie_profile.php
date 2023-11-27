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

$db = connectToDatabase();


$sql = "SELECT userpro.nom, userpro.prenom, adresse.pays, adresse.numero_maison, adresse.nom_rue, adresse.code_postal,adresse.ville, userpro.email, userpro.profession, userpro.numerotel FROM userpro INNER JOIN adresse ON userpro.id = adresse.userpro_id WHERE userpro.id = :user_id";

$stmt = $db->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user_data = $stmt->fetch(PDO::FETCH_ASSOC);




?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

  
  <link rel="stylesheet" href="../css/style-5.css">

  </head>
  <body>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
          <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <a href="modiffie_photo.php">
    <?php
                                $image = recupererImageUtilisateur($user_data['email']);
                                if ($image) {
                                    echo '<img src="data:' . $image['type_mime'] . ';base64,' . base64_encode($image['donnees_image']) . '" width="100" class="rounded-circle">';
                                } else {
                                    echo '<img src="https://media.istockphoto.com/vectors/profile-anonymous-face-icon-gray-silhouette-person-male-default-vector-id903053114?k=20&m=903053114&s=170667a&w=0&h=PfLuZ_Q-Yh3Qk3cKq7GLcCQFCsqRL1100YjYz5VF2t4=" width="100" class="rounded-circle">';
                                }
                                ?>
                            </a>
    <span class="font-weight-bold"><?php echo $user_data['nom']." ".$user_data['prenom']; ?></span>
    <span class="text-black-50"><?php echo $user_data['email']; ?></span>
</div>

        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">modification profile </h4>
                </div>

                <form method="post" action="../Controller/traitement_modification_profile.php">
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nom</label><input type="text" required class="form-control" placeholder="nom" name="nom" value="<?php echo $user_data['nom']?>"></div>
                    <div class="col-md-6"><label class="labels">prenom</label><input type="text" class="form-control" name="prenom" value="<?php echo $user_data['prenom']?>" placeholder="prenom" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Pays</label>
                        <input type="text"  required class="form-control" placeholder="Pays" name="pays" value="<?php echo $user_data['pays']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Address Line 1</label>
                        <input type="text" required  class="form-control" name="numero_maison" placeholder="enter address line 1" value="<?php echo $user_data['numero_maison']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Address Line 2</label>
                        <input type="text" class="form-control" required name="nom_rue" placeholder="enter address line 2" value="<?php echo $user_data['nom_rue']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Code postal</label>
                        <input type="text" class="form-control" required name="code_postal" placeholder="Code postal" value="<?php echo $user_data['code_postal']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">ville</label>
                        <input type="text" class="form-control" required placeholder="ville" value="<?php echo $user_data['ville']?>">
                    </div>
                    
                    <div class="col-md-12">
                        <label class="labels">Email</label>
                        <input type="text" class="form-control" placeholder="Email" value="<?php echo $user_data['email']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Profession</label>
                        <input type="text" class="form-control" required name="ville" placeholder="Profession" value="<?php echo $user_data['profession']?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="labels">Numero telephone</label>
                        <input type="text" class="form-control" required name="numerotel" placeholder="+1*********" value="<?php echo $user_data['numerotel']?>">
                    </div>
                </div>
                <div class="mt-5 text-center"><button  class="btn custom-btn form-control mt-4 mb-3" type="submit" name="save_profile">Save Profile</button></div>
                </form>
            </div>
        </div>

</div>
</div>


</body>
</html>