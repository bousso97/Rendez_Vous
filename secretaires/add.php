<?php
require "fonction.php";
$db=database::connect();

  $select=$db->prepare("SELECT *FROM service");
  $select->execute();
  $Matricule=generer_matricule();
if (!empty($_POST))
 {
 	$Nom=checkInput($_POST['Nom']);
 	$Prenom=checkInput($_POST['Prenom']);
  $Genre=checkInput($_POST['Genre']);
  $Situation=checkInput($_POST['Situation']);
  $Email=checkInput($_POST['Email']);
  $Adresse=checkInput($_POST['Adresse']);
  $Telephone=checkInput($_POST['Telephone']);
  $sel=checkInput($_POST['sel']);
  $Matricule=checkInput($_POST['Matricule']);

 

 	$db=database::connect();
 	$stm=$db->prepare("INSERT INTO secretaire(matricule_sec,nom_sec,prenom_sec,genre_sec,situation_sec,email_sec,adresse_sec,tel_sec,id_ser) values(?,?,?,?,?,?,?,?,?)");
 	$stm->execute(array($Matricule,$Nom,$Prenom,$Genre,$Situation,$Email,$Adresse,$Telephone,$sel));
  $user=$db->prepare("INSERT INTO user(nom_user,prenom_user,login,password,profil) values(?,?,?,?,?)");
  $user->execute(array($Nom,$Prenom,$Email,$Matricule,'secretaire'));
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
  function generer_matricule()
    {
       $c=mysqli_connect("loCalhost","lamine","774847102","Gestion_RV") or die(mysqli_error($c));
      $mat="SR-0";
      $date=Date('y');
      $req=("SELECT MAX(id) AS id FROM secretaire");
      $exe=mysqli_query($c,$req) or die(mysqli_error($c));
      if($exe==true)
      {
        if(mysqli_num_rows($exe)>0)
        {
          $tab=mysqli_fetch_array($exe);
          $max_id=$tab['id'];
        }
        else
        {
          $max_id=1;
        }

        return $mat."".$date."".($max_id+1);
      }
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Secretaires</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require "header.php";
?><br><br><br>
<img src="../images/secr.jpg" align="right" style="margin-top: 5%;">
<center>

 <div class="form-group">
  <form class="form-inline" method="POST">
    <div class="form-group">
          <label for="Matricule">Matricule</label><br>
             <input type="text" id="Matricule" class="form-control-sm" name="Matricule" value="<?=$Matricule?>" readonly >
        </div><br>
    <label for="Nom">Nom:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="Nom" name="Nom" required="true" placeholder="Nom Svp">
  </div><br>
   <label for="Prenom">Prenom:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="Prenom" name="Prenom" required="true" placeholder="Prenom Svp">
  </div><br><br>
            <label for="Genre">Genre:</label>
          <div class="radio">
        <label><input type="radio" name="Genre" value="M">M</label>
        </div>
         <div class="radio">
        <label><input type="radio" name="Genre" value="F">F</label>
         </div> 
      <br><br>
  <label for="Situation">Situation:</label>
      <div class="radio">
        <label><input type="radio" name="Situation" value="Monsieur">Mr</label>
        </div>
         <div class="radio">
        <label><input type="radio" name="Situation" value="Madame">Mm</label>
         </div> 
          <div class="radio">
        <label><input type="radio" name="Situation" value="Celebataire">Cel</label>
         </div><br>
   <label for="Email">Email:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="Email" name="Email" required="true" placeholder="Email Svp">
  </div>
<br>
    <label for="Adresse">Adresse:</label><br>
     <div class="form-group">
    <input type="text" class="form-control" id="Adresse"name="Adresse" required="true" placeholder="Adresse Svp">
  </div><br>
  <label for="Telephone">Telephone:</label><br>
     <div class="form-group">
    <input type="text" class="form-control" id="Telephone"name="Telephone" required="true" placeholder="Telephone Svp">
  </div><br>
    <div class="form-group">
      <label for="sel1">Service:</label><br>
      <select class="form-control" id="sel1" name="sel">
        <option>Choix</option>
        <?php
              while ($par=$select->fetch())
            {?>
              <option value="<?=$par['id']?>"><?=$par['libelle_ser']?></option>
        <?php }
         ?>                
      </select>
    </div>
 <br>
 <br>
  <button type="submit" class="btn btn-success">Ajouter</button>
   <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>

</form> 
</div>

</body>
</html>