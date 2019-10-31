<?php

session_start();

if(empty($_SESSION['login'])){
  sleep(2);
  echo "<script>window.location.href='../index.php';</script>";
}
 ?>
<!DOCTYPE html>
<html>
<head>
</head>
<html lang="en">
<head>
  <title>Specialistes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar bg-primary" style="position:fixed;top: 0;
  width: 100%; ">

  <div class="container-fluid">
    <div class="navbar-header">
  <font color="white" size="4"><i class=" fa fa-medkit" style="font-size:48px;color:white"></i></span></font> 
     
    </div>
    <ul class="nav navbar-nav">
      <li class="active text-body"><a href="../acceuil.php" style="color:black;"><span class="glyphicon glyphicon-home">  <font color="black" size="4"> Home</font></span></a></li>
      <?php
      if ($_SESSION['profil']=='admin') {?>
      <li><a href="../services/index.php"style="color: black;"><font color="black" size="4"> Service</font></a></li>
      <li><a href="../secretaires/index.php"style="color: black;"><font color="black" size="4"> Secretaires</font></a></li>
      <li><a href="../medecins/index.php"  style="color: black;"><font color="black" size="4"> Medecins</font></a></li>
      <li><a href="../patients/index.php"style="color: black;"><font color="black" size="4"> Patients</font></a></li>
      <li><a href="index.php"style="color: black;"><font color="black" size="4"> Specialites</font></a></li>
      <li class="disabled" title="Acces Non Autorise"><a href=""style="color: black;"><font color="black" size="4"> Rendez_Vous</font></a></li>
    </ul>
     <?php  }?>
     <ul class="nav navbar-nav navbar-right">
    <li><a style="color: black;"  title="<?=$_SESSION['prenom_user'].' '.$_SESSION['nom_user']?>"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['profil'];?></a></li>
      <li><a href="../deconnexion.php" style="color: black;"><span class="glyphicon glyphicon-lock"></span> Deconnexion</a></li>
      
    </ul>
  </div>
</nav> 
</body>
</html>
