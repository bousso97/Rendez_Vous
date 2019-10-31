<?php
require "fonction.php";
  $db=database::connect();
  $spt=$db->prepare("SELECT *FROM specialite");
  $spt->execute();
  $ser=$db->prepare("SELECT *FROM service");
  $ser->execute();
  $Matricule=generer_matricule();

if (!empty($_POST))
 {
 	$Nom=checkInput($_POST['Nom']);
 	$Prenom=checkInput($_POST['Prenom']);
  $Email=checkInput($_POST['Email']);
  $Adresse=checkInput($_POST['Adresse']);
  $Telephone=checkInput($_POST['Telephone']);
  $sp=checkInput($_POST['sp']);
  $sr=checkInput($_POST['sr']);
  $Matricule=checkInput($_POST['Matricule']);


 

 	$db=database::connect();
 	$stm=$db->prepare("INSERT INTO medecin(matricule,nom_med,prenom_med,email_med,adresse_med,tel_med,id_sp,id_ser) values(?,?,?,?,?,?,?,?)");
 	$stm->execute(array($Matricule,$Nom,$Prenom,$Email,$Adresse,$Telephone,$sp,$sr));
  $user=$db->prepare("INSERT INTO user(nom_user,prenom_user,login,password,profil) values(?,?,?,?,?)");
  $user->execute(array($Nom,$Prenom,$Email,$Matricule,'medecin'));
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
  <title>Medecins</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body background="../images/ppp.jpg" style="border-radius: 50%;">
<?php
require "header.php";
?><br><br><br>
<center>
  <div class="form-group">
       <form method="post">
        <div class="form-group">
          <label for="Matricule">Matricule</label><br>
             <input type="text" id="Matricule" class="form-control-sm" name="Matricule" value="<?=$Matricule?> " readonly>
        </div>
        <div class="form-group">
          <label for="Nom">Nom</label><br>
             <input type="text" id="Nom" class="form-control-sm" name="Nom" placeholder="Nom SVP">
        </div>
        <div class="form-group">
          <label for="Prenom">Prenom</label><br>
             <input type="text" id="Prenom" class="form-control-sm" name="Prenom" placeholder="Prenom SVP">
        </div>
        <div class="form-group">
          <label for="Email">Email</label><br>
             <input type="text" id="Email" class="form-control-sm" name="Email"placeholder="Emqil SVP">
        </div>
        <div class="form-group">
          <label for="Adresse">Adresse</label><br>
             <input type="text" id="Adresse" class="form-control-sm" name="Adresse" placeholder="Adresse SVP">
        </div>
        <div class="form-group">
          <label for="Telephone">Telephone</label><br>
            <i class="  call" ></i> <input type="text" id="Telephone" class="form-control-sm" name="Telephone" placeholder="Telephone SVP">
        </div>
        <div class="form-group">
          <label for="classe_id">Specialite</label><br>
          <select name="sp" id="sp">
            <option>---Choix---</option>
              <?php
                    while ($par=$spt->fetch())
                  {?>
                    <option value="<?=$par['id']?>"><?=$par['libelle_sp']?></option>
              <?php }
               ?> 
            </select>
        </div>
       <div class="form-group">
          <label for="classe_id">Service</label><br>
          <select name="sr" id="sr">
            <option>---Choix---</option>

             <?php
                    while ($par1=$ser->fetch())
                  {?>
                    <option value="<?=$par1['id']?>"><?=$par1['libelle_ser']?></option>
              <?php }
               ?>      
            </select>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>

      </form>
</div>
</center>
</body>
</html>