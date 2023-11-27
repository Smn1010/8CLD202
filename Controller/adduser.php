<?php
/* Add a new user */
if (isset($_POST['ajoutercompte'])) {


  require_once("../Controller/Fonctions.php");
 
  $name =  htmlentities($_POST['nom']);
  $firstname = htmlentities($_POST['prenom']);
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $email =  filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $profession=$_POST['profession'];
  $numerotel=$_POST['telephone'];
   $numeromaison=$_POST['numeromaison'];
   $nomrue=$_POST['nomRue'];
   $codepostal=$_POST['code_postal'];
   $ville=$_POST['ville'];
   $pays=$_POST['pays'];
  if (strcmp($password, $cpassword) == 0) {
    $res = addUser($name, $firstname, $email, $password,$profession,$numerotel,$numeromaison,$nomrue,$codepostal,$ville,$pays);
    if ($res == true) {
      header("Location: ../views/sign-in.php");
    } else {
      
    }
  } else {
    $_SESSION['params'] = true;
  }
}
?>