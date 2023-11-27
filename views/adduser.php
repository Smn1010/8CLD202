<?php session_start() ?>
 
   
<!DOCTYPE html>
<html lang="fr">

    <head>
        
    </head>

    <body>
      <section class="add-admin">
           
            <form action="" method="post" class="add-admin-form">
                <div class="flex">
                    <div class="inputBox">
                        <input type="text" placeholder="Nom..." name="nom" required maxlength="25">
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="Prénom..." name="prenom" required maxlength="25">
                    </div>
                    <div class="inputBox">
                        <input type="email" placeholder="Adresse..." name="adresse" required maxlength="60">
                    </div>
                    <div class="inputBox">
                        <input type="email" placeholder="Email..." name="email" required maxlength="30">
                    </div>
                    <div class="inputBox">
                        <input type="password" placeholder="motdepasse..." name="password" required maxlength="25">
                    </div>
                    <div class="inputBox">
                        <input type="password" placeholder="Confirmer votre motdepasse..." name="cpassword" required  maxlength="25">
                    </div>
                    <div class="inputBox">
                         <input type="text" id="telephone" placeholder="Numéro de téléphone..." name="telephone" required  maxlength="10">
                    </div>

                    <script>
                        document.getElementById("telephone").addEventListener("input", function() {
                        this.value = this.value.replace(/[^0-9]/g, "");
                        });
                    </script>
                    <div class="inputBox">
                        <input type="text" placeholder="Votre Profession ..." name="profession" required>
                    </div>
                </div>
                <input type="submit" value="S'inscrire" class="btn" name="S'inscrire">

            </form>

        </section>

        <!-- add-admin section ends -->

    </body>

</html>