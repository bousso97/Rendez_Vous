<?php
session_start();
require "fonction.php";
$db=database::connect();
$login=$_SESSION['login'];
  $patient=$db->prepare("SELECT  *FROM patient ");
  $patient->execute();
  $medecin=$db->prepare("SELECT  *FROM medecin ");
  $medecin->execute();
  // $secretaire=$db->prepare("SELECT  *FROM secretaire  WHERE secretaire.email_sec='$login'");
  // $secretaire->execute();
$id=$_GET['id'];
var_dump($id);
//selection la ligne a modifier
$db=database::connect();
$stm=$db->prepare("SELECT  *FROM  rendez_vous rv,secretaire s,medecin m,patient p,service sr WHERE rv.id_sec=s.id and rv.id_med=m.id and rv.id_pt=p.id and s.id_ser=sr.id and rv.id=? ");
   $stm->execute(array($id));
   //parcours la ligne
   $list=$stm->fetch();

//action de mise a jours
  if (!empty($_POST)) {
  $motif=checkInput($_POST['motif']);
  // $sec=checkInput($_POST['sec']);
  $pt=checkInput($_POST['pt']);
  $md=checkInput($_POST['md']);
  $jours=checkInput($_POST['jours']);
  $heur=checkInput($_POST['heur']);
  // $dur=checkInput($_POST['dur']);


    $db=database::connect();
    $stt=$db->prepare("UPDATE rendez_vous set motif=?,id_pt=?,id_med=?,jours=?,heur=? WHERE id=?") or die($db);
    $stt->execute(array($motif,$pt,$md,$jours,$heur,$id));
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
  <title>Rendez_Vous</title>
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
    <label for="motif">Motif:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="motif" name="motif" required="true" value="<?= $list['motif']?>">
  </div><br>
  
  <div class="form-group">
          <label for="pt">Patient</label><br>
          <select name="pt" id="pt">
            <option>---Choix---</option>
              <?php
                    while ($par=$patient->fetch())
                  {?>
                    <option value="<?=$par['id']?>"<?= $par['id'] === $list['id_pt'] ? " selected='true'" : ""?>><?=$par['prenom_pt']?> <?=$par['nom_pt']?></option>
              <?php }
               ?> 
            </select>
        </div><br>
     <div class="form-group">
          <label for="md">Medecin</label><br>
          <select name="md" id="md">
            <option>---Choix---</option>
              <?php
                    while ($par=$medecin->fetch())
                  {?>
                    <option value="<?=$par['id']?>"<?= $par['id'] === $list['id_med'] ? " selected='true'" : ""?>><?=$par['prenom_med']?>  <?=$par['nom_med']?></option>
              <?php }
               ?> 
            </select>
        </div><br><br>
    
          <div class="radio">
              <label for="Horraires">Horraires:</label>

             <?php 
             if($list['jours']=='Lundi'){
              ?>
             <input type="radio" class="form-check-input" id="jour" name="jours" value="Lundi" checked>Lun
             <input type="radio" class="form-check-input" id="jour" name="jours" value="Mardi">Mar
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Mercredi">Mer
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Jeudi">Jeu
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Vendredi">Ven
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Sam
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Dim
           
           <?php
            } 
             if($list['jours']=='Mardi'){
              ?>
              <input type="radio" class="form-check-input" id="jour" name="jours" value="Lundi" >Lun
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Mardi" checked>Mar
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Mercredi">Mer
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Jeudi">Jeu
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Vendredi">Ven
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Sam
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Dim
           
           <?php
            }
             if($list['jours']=='Mercredi'){
              ?>
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Lundi" >Lun
             <input type="radio" class="form-check-input" id="jour" name="jours" value="Mardi">Mar
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Mercredi" checked>Mer
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Jeudi">Jeu
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Vendredi">Ven
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Sam
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Dim
           
           <?php
            }
             if($list['jours']=='Jeudi'){
              ?>
              <input type="radio" class="form-check-input" id="jour" name="jours" value="Lundi" >Lun
             <input type="radio" class="form-check-input" id="jour" name="jours" value="Mardi">Mar
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Mercredi">Mer
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Jeudi" checked>Jeu
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Vendredi">Ven
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Sam
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Dim
           
           <?php
            } 
             if($list['jours']=='Vendredi'){
              ?>
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Lundi" >Lun
             <input type="radio" class="form-check-input" id="jour" name="jours" value="Mardi">Mar
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Mercredi">Mer
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Jeudi">Jeu
            <input type="radio" class="form-check-input" id="jour" name="jours" value="Vendredi" checked>Ven
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Sam
            <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Dim
           
           <?php
            }?>
      </div><br>
       <div class="radio">
         <label for="Heures">Heures:</label>
             <?php 
             if($list['heur']=='8h-12h'){
              ?>
                 
            <input type="radio" class="form-check-input" id="jour" name="heur" value="8h-12h"checked >8h-12h
            <input type="radio" class="form-check-input" id="jour" name="heur" value="15h-17h">15h-17h
           <?php
            }else{
              ?>
            <input type="radio" class="form-check-input" id="jour" name="heur" value="8h-12h" >8h-12h
            <input type="radio" class="form-check-input" id="jour" name="heur" value="15h-17h" checked>15h-17h
          <?php  }


            ?>
      </div> <br><br>
       <!-- <div class="form-group">
          <label for="dur">Duree Par Minute:</label><br>
             <input type="number" id="dur" class="form-control-sm" name="dur" value="<?=$list['duree']?>" readonly="true">
        </div><br><br> -->
  <button type="submit" class="btn btn-success">Modifier</button>
  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Retour</span> </a>

</form> 
</div>
<div class="jumbotron text-center">
</div>
 
</center>
</body>
</html>