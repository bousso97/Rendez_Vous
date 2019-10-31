<?php
require "fonction.php";
if (!empty($_POST))
 {
  $Nom=checkInput($_POST['Nom']);
  $Prenom=checkInput($_POST['Prenom']);
  $Age=checkInput($_POST['Age']);
  $sexe=checkInput($_POST['sexe']);
  $Adresse=checkInput($_POST['Adresse']);
  $Telephone=checkInput($_POST['Telephone']);

 

  $db=database::connect();
  $stm=$db->prepare("INSERT INTO patient(nom_pt,prenom_pt,age_pt,sexe,adresse_pt,tel_pt) values(?,?,?,?,?,?)");
  $stm->execute(array($Nom,$Prenom,$Age,$sexe,$Adresse,$Telephone));
  database::deconnect();
  echo "<script>alert('Insertion Reussite');</script>";
  header("location:index.php");
}

  function checkInput($data){
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);

    return $data;

  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Patients</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body >
<?php
require "header.php";
?><br><br><br>
<img src="../images/ton.png" align="right">
<center>
  <div class="form-group">
     <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="Nom">Nom</label><br>
               <input type="text" id="Nom" class="form-sm" name="Nom" placeholder="Nom SVP">
          </div>
           <div class="form-group">
            <label for="Prenom">Prenom</label><br>
               <input type="text" id="Prenom" class="form-sm" name="Prenom" placeholder="Prenom SVP">
           </div>
           <div class="form-group">
            <label for="Age">Age</label><br>
               <input type="text" id="Age" class="form-sm" name="Age" placeholder="Age SVP">
          </div>
           <label for="sexe">Sexe:</label>
       <div class="form-check-inline">
        <input type="radio" class="form-check-input" id="sexe" name="sexe" value="Masculin" checked>M
        <input type="radio" class="form-check-input" id="sexe" name="sexe" value="Feminin">F
      </div><br>
           <div class="form-group">
            <label for="Adresse">Adresse</label><br>
               <input type="text" id="Adresse" class="form-sm" name="Adresse" placeholder="Adresse SVP">
          </div>
          <div class="form-group">
            <label for="Telephone">Telephone</label><br>
               <input type="text" id="Telephone" class="form-sm" name="Telephone"placeholder="Telephone SVP">
          </div>
        <div class="btn">
          <button type="submit" class="btn btn-success">Ajouter</button>
           <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>
           </div>
    </form>
</div>

</body>
</html>