<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sign up Page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="../css/slick.css"/>

        <link href="../css/tooplate-little-fashion.css" rel="stylesheet">
        
    </head>
    
    <body>
         <?php
                include('menu.php');
            ?>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Sign Up</h1>

                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form role="form" method="post" action="../Controller/adduser.php">
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text" name="nom" id="nom"  class="form-control" placeholder="Votre nom" required>

                                            <label for="nom">Votre nom</label>
                                        </div>
                                         <div class="form-floating mb-4 p-0">
                                            <input type="text" name="prenom" id="prenom"  class="form-control" placeholder="Votre prenom" required>

                                            <label for="nom">Votre prenom</label>
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <select name="pays" id="pays" required class="form-control" placeholder="Sélectionnez un pays">
                                                <option value="">Sélectionnez un pays</option>
                                            </select>
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text"  name="numeromaison" required  class="form-control" placeholder="Adresse line 1">
                                            
                                            <label for="">Adresse line 1 </label>
                            
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text"  name="nomRue" placeholder="Adresse line 2" required  class="form-control">
                                            <label for="">Adresse line 2 </label>
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text"  name="code_postal" placeholder="Code postal" required  class="form-control">
                                            <label for="">Code postal </label>
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text"  name="ville" placeholder="ville" required  class="form-control">
                                            <label for="ville">Ville </label>
                                        </div>

                                        <div class="form-floating mb-4 p-0">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>

                                            <label for="email">Email address</label>
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text" name="telephone"  placeholder="Votre numero de telephone " class="form-control" required  maxlength="10">
                                             <label for="">Numéro de téléphone</label>
                                        </div>
                                        <div class="form-floating mb-4 p-0">
                                            <input type="text" name="profession" class="form-control"  required placeholder="Votre Profession">
                                            <label for="profession">Votre Profession</label>
                                        </div>

                                        <div class="form-floating p-0">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

                                            <label for="password">Password</label>
                                        </div>
                                        <div class="form-floating p-0">
                                            <input type="password" name="cpassword" id="password" class="form-control" placeholder="Password" required>

                                            <label for="password"> confirme Password</label>
                                        </div>

                                        <button type="submit" name="ajoutercompte" class="btn custom-btn form-control mt-4 mb-3">
                                           Create account
                                        </button>

                                        <p class="text-center">Already have an account? Please <a href="sign-in.php">Sign In</a></p>

                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.html">Little</a> Fashion</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                        <br>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>

                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Products</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy policy</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">FAQs</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>

                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

         <!-- JAVASCRIPT FILES -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/Headroom.js"></script>
        <script src="../js/jQuery.headroom.js"></script>
        <script src="../js/slick.min.js"></script>
        <script src="../js/custom.js"></script>

    </body>
</html>
<script>
             document.getElementById("telephone").addEventListener("input", function() {
                this.value = this.value.replace(/[^0-9]/g, "");
                        });
        </script>
        <script>
            // Sélectionnez la liste déroulante des pays
            const selectPays = document.getElementById("pays");

            // Fonction pour remplir la liste déroulante avec les pays
            function remplirListeDeroulante() {
                // Effectuez une requête à l'API Restcountries pour obtenir la liste des pays
                fetch("https://restcountries.com/v2/all")
                    .then(response => response.json())
                    .then(data => {
                        // Parcourez les données pour ajouter chaque pays à la liste déroulante
                        data.forEach(pays => {
                            const option = document.createElement("option");
                            option.value = pays.name;
                            option.textContent = pays.name;
                            selectPays.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error("Erreur lors de la récupération des pays :", error);
                    });
            }

            // Appelez la fonction pour remplir la liste déroulante au chargement de la page
            remplirListeDeroulante();
        </script>
            

        </section>
