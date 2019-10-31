 <?php
   session_start();

  require "fonctions/fonction.php";
  //Partie connexion
  $db=database::connect();
 if (isset($_POST['btn'])) 
{
    $login=$_POST['login'];
    $pwd=$_POST['pwd'];
    $profil=$_POST['profil'];

        if(empty($login)or empty($pwd))
       {
       echo "<script>alert('Veuillez renseigner tous les champs');</script>";
        }
    else
    {
      $list=$db->query("SELECT *FROM user WHERE login='$login' and password='$pwd' and profil='$profil' ");
        if ($list==true) {
                  $par =$list->fetch();
            if ($par['login']==$login and $par['password']==$pwd )
            {
              $_SESSION['login']=$par['login'];
              $_SESSION['nom_user']=$par['nom_user'];
              $_SESSION['prenom_user']=$par['prenom_user'];
              $_SESSION['profil']=$par['profil'];
              if ($_SESSION['profil']==$_POST['profil'])
               {
                header("location:acceuil.php") ;
               }
      
                else
                {
                 echo "<script>alert('le profil n'est pas bon ');</script>";
                  }
                
            }
             else
                {
                echo "<script>alert('login ou mot de passe incorrect');</script>";
              }
   
              } else
                    {
                     echo "<script>alert('Veuillez contactez votre fournisseur de produit');</script>";  

                   }
        
    }
}

?> 
<?php
//Partie Inscription
if (isset($_POST['ins']))
 {
  $nom=checkInput($_POST['nom']);
  $prenom=checkInput($_POST['prenom']);
  $email=checkInput($_POST['email']);
  $password=checkInput($_POST['password']);
  $pro=checkInput($_POST['pro']);


  $db=database::connect();
  $stm=$db->prepare("INSERT INTO user(nom_user,prenom_user,login,password,profil) values(?,?,?,?,?)");
  $stm->execute(array($nom,$prenom,$email,$password,$pro));
  database::deconnect();
  header("location:header.php");
}

  function checkInput($data){
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);

    return $data;

  }
?>

<!DOCTYPE html>
<head>
  <title>Gestion Rendez_Vous</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body  background="images/aa.jpg" style="margin-top: 2%;">
    <div class="hero">
      <div class="form-box">
        <div class="button-box">
          <div id="btn"> </div>
          <button type="button" class="toggle-btn" onclick="login()">Connecte</button>
          <button type="button" class="toggle-btn" onclick="Inscription()">Inscription</button>
        </div>
         <div class="social-icon">
              <img src="images/aa.png">
              <img src="images/tw.png">
              <img src="images/ln.png">
          </div>
          <form class="input-group" id="login" method="POST"> 
            <input type="text" name="login" class="input-field" placeholder="Login" style="color: black;">
            <input type="password" name="pwd" class="input-field" placeholder="Password" style="color: black;">
            <input type="text" name="profil" class="input-field" placeholder="Profil" style="color: black;">
            <button type="submit" class="submit-btn" name="btn">Connexion</button>
          </form>
          <form class="input-group"  id="Inscription" method="POST"> 
            <input type="text" name="nom" class="input-field" placeholder="Nom">
            <input type="text" name="prenom" class="input-field" placeholder="Prenom">
            <input type="text" name="email" class="input-field" placeholder="Login">
            <input type="text" name="password" class="input-field" placeholder="Password">
            <input type="text" name="pro" class="input-field" placeholder="Profil">
            <button type="submit" class="submit-btn" name="ins">Inscrir</button>
          </form>

      </div>
           
    </div>
    <script>
      
      var x=document.getElementById("login");
      var y=document.getElementById("Inscription");
      var z=document.getElementById("btn");

        function Inscription(){
          x.style.left="-400px";
          y.style.left="50px";
          z.style.left="110px";

        }
         function login(){
          x.style.left="50px";
          y.style.left="450px";
          z.style.left="0px";

        }

    </script>
</body>
</html>