<?php


function afficherResultatsUtilisateurs($users) {
    echo '<div class="container mt-5">';
    echo '<div class="row d-flex justify-content-center">';

    foreach ($users as $user) {
        echo '<div class="col-md-7">';
        echo '<div class="card p-3 py-4">';
        echo '<div class="text-center">';
        
        $image = recupererImageUtilisateur($user['email']);
        $imageSource = $image ? 'data:' . $image['type_mime'] . ';base64,' . base64_encode($image['donnees_image']) : 'https://media.istockphoto.com/vectors/profile-anonymous-face-icon-gray-silhouette-person-male-default-vector-id903053114?k=20&m=903053114&s=170667a&w=0&h=PfLuZ_Q-Yh3Qk3cKq7GLcCQFCsqRL1100YjYz5VF2t4=';
        
        echo '<img src="' . $imageSource . '" width="100" class="rounded-circle">';
        echo '</div>';
        echo '<div class="text-center mt-3">';
        echo '<h5 class="mt-2 mb-0">' . $user['nom'] . ' ' . $user['prenom'] . '</h5>';
        echo '<span>' . $user['profession'] . '</span>';
        echo '<div class="buttons">';
        echo '<a class="btn btn-primary px-4 ms-3" href="views/voir_profile.php?id=' . $user['id'] . '">Profile</a>';
        echo '<a class="btn btn-primary px-4 ms-3" href="views/contactprofessionnel.php?id=' . $user['id'] . '">Contact</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
}

function afficherFormulaireRecherche() {
    echo '<form method="POST" action="" style="display: flex; justify-content: center; align-items: center; height: 10vh;">
        <div class="search">
            <input type="text" placeholder="Profession" name="Profession">
            <input type="text" placeholder="Adresse" name="ville">
            <button type="submit" name="rechercher" >Recherche</button>
        </div>
    </form>';
}



?>
