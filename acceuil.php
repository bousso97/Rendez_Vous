<?php
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.hero-image {
  background-image: url("images/bb.jpg");
  margin-top: 0%;
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

</style>
</head>
<body>
<?php require "header.php" ?>
<br><br><br>
<marquee><cite style="color: blue;">“Dimanche : le paradis pour les médecins ! Au golf, au bord de la mer, avec leur maîtresse ou leur épouse, à l’église ou sur un yacht... Des médecins, partout, résolument plus dans le rôle de médecin.”</cite></marquee>
<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:50px; color: black;">I am a Docter <span class="fa fa-stethoscope" ></span></h1>
    <h3 style="font-size:20px; color: white;">And I'm a Protecter</h3>
    <h4 style="font-size:10; background-color:white; color: black;">“Le malade prend l'avis du médecin. Le médecin prend la vie du malade.”</h4>
  
  </div>
</div>
<?php require "footer.php" ?>
</body>
</html>


