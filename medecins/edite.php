<?php
require "fonction.php";
 $db=database::connect();
  $spt=$db->prepare("SELECT *FROM specialite");
  $spt->execute();
  $ser=$db->prepare("SELECT *FROM service");
  $ser->execute();
// $id=$_GET['id'];
$us=$_GET['us'];
var_dump($us);

//selection la ligne a modifier
$db=database::connect();
$stm=$db->prepare("SELECT  *FROM medecin m,service sr,specialite sp WHERE m.id_sp=sp.id and m.id_ser=sr.id and m.matricule=? ");
   $stm->execute(array($us));
   //parcours la ligne
   $list=$stm->fetch();

//action de mise a jours
  if (!empty($_POST)) {
    $Nom=checkInput($_POST['Nom']);
    $Prenom=checkInput($_POST['Prenom']);
    $Email=checkInput($_POST['Email']);
    $Adresse=checkInput($_POST['Adresse']);
    $Telephone=checkInput($_POST['Telephone']);
    $sp=checkInput($_POST['sp']);
    $sr=checkInput($_POST['sr']);


    $db=database::connect();
    $stt=$db->prepare("UPDATE medecin set nom_med= ?,prenom_med=?,email_med=?,adresse_med=?,tel_med=?,id_sp=?,id_ser=?
           WHERE matricule=?");
    $stt->execute(array($Nom,$Prenom,$Email,$Adresse,$Telephone,$sp,$sr,$us));
    $user=$db->prepare("UPDATE user set nom_user=?,prenom_user=?,login=?,profil=? WHERE password=? ");
    $user->execute(array($Nom,$Prenom,$Email,'medecin',$us));
      database::deconnect();
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require "header.php";
?><br><br><br>
<center>
 <div class="form-group">
       <form method="post">
        <div class="form-group">
          <label for="Matricule">Matricule</label><br>
             <input type="text" id="Matricule" class="form-control-sm" name="Matricule" value="<?=$list['matricule']?>" readonly>
        </div>
        <div class="form-group">
          <label for="Nom">Nom</label><br>
             <input type="text" id="Nom" class="form-control-sm" name="Nom" value="<?=$list['nom_med']?>">
        </div>
        <div class="form-group">
          <label for="Prenom">Prenom</label><br>
             <input type="text" id="Prenom" class="form-control-sm" name="Prenom"  value="<?=$list['prenom_med']?>">
        </div>
        <div class="form-group">
          <label for="Email">Email</label><br>
             <input type="text" id="Email" class="form-control-sm" name="Email"  value="<?=$list['email_med']?>">
        </div>
        <div class="form-group">
          <label for="Adresse">Adresse</label><br>
             <input type="text" id="Adresse" class="form-control-sm" name="Adresse"  value="<?=$list['adresse_med']?>">
        </div>
        <div class="form-group">
          <label for="Telephone">Telephone</label><br>
             <input type="text" id="Telephone" class="form-control-sm" name="Telephone"  value="<?=$list['tel_med']?>">
        </div>
        <div class="form-group">
          <label for="classe_id">Specialite</label><br>
          <select name="sp" id="sp">
            <option>---Choix---</option>
              <?php
                    while ($par=$spt->fetch())
                  {?>
                    <option value="<?=$par['id']?>"<?= $par['id'] === $list['id_sp'] ? " selected='true'" : ""?>><?=$par['libelle_sp']?></option>
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
                     <option value="<?=$par1['id']?>"<?= $par1['id'] === $list['id_ser'] ? " selected='true'" : ""?>><?=$par1['libelle_ser']?></option>
              <?php }
               ?>      
            </select>
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Retour</span> </a>

      </form>
</div> 
</center>
</body>
</html>