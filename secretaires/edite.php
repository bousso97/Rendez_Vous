<?php
require "fonction.php";
$db=database::connect();
  $ser=$db->prepare("SELECT  *FROM service ");
  $ser->execute();
$us=$_GET['us'];
var_dump($us);
//selection la ligne a modifier
$db=database::connect();
$stm=$db->prepare("SELECT  *FROM secretaire s,service sr WHERE s.id_ser=sr.id and s.matricule_sec=? ");
   $stm->execute(array($us));
   //parcours la ligne
   $list=$stm->fetch();

//action de mise a jours
  if (!empty($_POST)) {
    $Nom=checkInput($_POST['Nom']);
    $Prenom=checkInput($_POST['Prenom']);
    $Genre=checkInput($_POST['Genre']);
    $Situation=checkInput($_POST['Situation']);
    $Email=checkInput($_POST['Email']);
    $Adresse=checkInput($_POST['Adresse']);
    $Telephone=checkInput($_POST['Telephone']);
    $sel=checkInput($_POST['sel']);


    $db=database::connect();
    $stt=$db->prepare("UPDATE secretaire set nom_sec= ?,prenom_sec= ?,genre_sec= ?,situation_sec= ? ,email_sec= ? ,adresse_sec= ? ,tel_sec = ?,id_ser=? WHERE matricule_sec=?");
    $stt->execute(array($Nom,$Prenom,$Genre,$Situation,$Email,$Adresse,$Telephone,$sel,$us));
    $user=$db->prepare("UPDATE user set nom_user=?,prenom_user=?,login=?,profil=? WHERE password=?");
  $user->execute(array($Nom,$Prenom,$Email,'secretaire',$us));
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
<center>
 
 <div class="jumbotron text-center">
  <form class="form-inline" method="POST">
    <div class="form-group">
          <label for="Matricule">Matricule</label><br>
             <input type="text" id="Matricule" class="form-control-sm" name="Matricule" value="<?=$list['matricule_sec']?>" readonly >
        </div><br>
    <label for="code">Nom:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="Nom" name="Nom" required="true" value="<?= $list['nom_sec']?>">
  </div><br>
   <label for="code">Prenom:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="Prenom" name="Prenom" required="true" value="<?= $list['prenom_sec']?>">
  </div><br>
      <label for="Genre">Genre:</label>
          <div class="radio">
             <?php 
             if($list['genre_sec']=='M'){
              ?>

             <input type="radio" name="Genre" value="M" checked>M 
               <input type="radio" name="Genre"value="F" >F  
       
           <?php
            }?>
      </div>
         <div class="radio">
             <?php 
             if($list['genre_sec']=='F'){
              ?>

             <input type="radio" name="Genre" value="F" checked>F
               <input type="radio" name="Genre"  value="M">M 
       
           <?php
            }?>
      </div> 
      <br><br>
  <label for="Situation" >Situation:</label>
     <div class="radio">
             <?php 
             if($list['situation_sec']=='Madame'){
              ?>

             <input type="radio" name="Situation" checked value="Madame">Mm
               <input type="radio" name="Situation" value="Monsieur">Mr
               <input type="radio" name="Situation" value="Celibataire">Cel
       
           <?php
            }?>
      </div> 
        <div class="radio">
             <?php 
             if($list['situation_sec']=='Monsieur'){
              ?>

            <input type="radio" name="Situation"  value="Madame">Mm
               <input type="radio" name="Situation" checked value="Monsieur">Mm
               <input type="radio" name="Situation" value="Celibataire">Cel
       
           <?php
            }?>
      </div> 
         <div class="radio">
             <?php 
             if($list['situation_sec']=='Celibataire'){
              ?>

             <input type="radio" name="Situation" value="Madame">Mm
               <input type="radio" name="Situation" value="Monsieur">Mr
               <input type="radio" name="Situation" checked  value="Celibataire">Cel
       
           <?php
            }?>
      </div> <br>
   <label for="code">Email:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="Email" name="Email" required="true"value="<?= $list['email_sec']?>">
  </div>
<br>
    <label for="libelle">Adresse:</label><br>
     <div class="form-group">
    <input type="text" class="form-control" id="Adresse"name="Adresse" required="true" value="<?= $list['adresse_sec']?>">
  </div><br>
  <label for="libelle">Telephone:</label><br>
     <div class="form-group">
    <input type="text" class="form-control" id="Telephone"name="Telephone" required="true" value="<?= $list['tel_sec']?>">
  </div><br>
 <div class="form-group">
      <label for="sel1">Secretaires:</label><br>
      <select class="form-control" id="sel1" name="sel">
        <option><?php echo $list['libelle_ser'];?></option>
        <?php
              while ($par=$ser->fetch())
            {?>
              <option value="<?=$par['id']?>"<?= $par['id'] === $list['id_ser'] ? " selected='true'" : ""?>><?=$par['libelle_ser']?></option>
        <?php }
         ?>                
      </select>
    </div>
 <br><br>
  <button type="submit" class="btn btn-success">Modifier</button>
  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Retour</span> </a>

</form> 
</div>
<div class="jumbotron text-center">
</div>
 
</center>
</body>
</html>