<?php 
session_start();
require "fonction.php";
$db=database::connect();
// $ses=$_SESSION['prenom_user'].' '.$_SESSION['nom_user'];
$login=$_SESSION['login'];
echo $_SESSION['login'];
 $select=$db->prepare("SELECT *FROM patient");
  $select->execute();
   $med=$db->prepare("SELECT *FROM medecin");
  $med->execute();
  $tst=$db->prepare("SELECT *FROM secretaire s where s.email_sec='$login'");
  $tst->execute();
  
  
if (isset($_POST['btn']))
 {
  $Motif=checkInput($_POST['Motif']);
  $sec=checkInput($_POST['sec']);
  $pat=checkInput($_POST['pat']);
  $med1=checkInput($_POST['med1']);
  $jours=checkInput($_POST['jours']);
  $heur=checkInput($_POST['heur']);
  $dur=checkInput($_POST['dur']);

// foreach ($tst as $tab){
//   if ( $tab['email_sec']==$_SESSION['login']) {
    
//     var_dump($tab['id']);
//     $tab1=$tab['id'];
//   }
//   }

 

  $db=database::connect();
  $stm=$db->prepare("INSERT INTO rendez_vous(motif,id_sec,id_pt,id_med,jours,heur,duree)values(?,?,?,?,?,?,?)");

  $stm->execute(array($Motif,$sec,$pat,$med1,$jours,$heur,$dur));
  echo "<script>alert('Insertion Reussite');</script>";
  header("location:index.php");
}

  function checkInput($data){
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);

    return $data;

  }


// var_dump($ses);
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Rendez-Vous</title>
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
<center>
  <div class="form-group">
       <form method="POST">
        <div class="form-group">
          <label for="Motif">Motif:</label><br>
             <input type="text" id="Motif" class="form-control-sm" name="Motif" placeholder="Motif SVP">
        </div>
            <div class="form-group">
          <label for="sec">Secretaire:</label><br>
          <select class="form-control-sm-sm" id="sec" name="sec">
            <option>Choix</option> 
            <?php
                while ($tst1=$tst->fetch()) {
                  ?>
              <option value="<?=$tst1['id']?>"><?=$tst1['prenom_sec']?> <?=$tst1['nom_sec']?></option>
                  
             <?php   }

            ?>           
          </select>
          </div>
         <div class="form-group">
          <label for="pat">Patient:</label><br>
          <select class="form-control-sm-sm" id="pat" name="pat">
            <option>Choix</option> 
            <?php
                while ($patt=$select->fetch()) {
                  ?>
              <option value="<?=$patt['id']?>"><?=$patt['prenom_pt']?> <?=$patt['nom_pt']?></option>
                  
             <?php   }

            ?>           
          </select>
          </div>
      <div class="form-group">
          <label for="med1">Medecin:</label><br>
          <select class="form-control-sm-sm" id="med1" name="med1">
            <option>Medecins</option> 
            <?php
                while ($doc=$med->fetch()) {
                  ?>
              <option value="<?=$doc['id']?>"><?=$doc['prenom_med']?> <?=$doc['nom_med']?></option>
                  
             <?php   }

            ?>           
          </select>
      </div><br>
      <label for="jour">Horraires:</label>
       <div class="form-check-inline">
        <input type="radio" class="form-check-input" id="jour" name="jours" value="Lundi" >Lun
        <input type="radio" class="form-check-input" id="jour" name="jours" value="Mardi">Mar
        <input type="radio" class="form-check-input" id="jour" name="jours" value="Mercredi">Mer
        <input type="radio" class="form-check-input" id="jour" name="jours" value="Jeudi">Jeu
        <input type="radio" class="form-check-input" id="jour" name="jours" value="Vendredi">Ven
        <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Sam
        <input type="radio" class="form-check-input" title="Jours Non Ouvrable" disabled>Dim
      </div>
        <br>
       <label for="heur">Heurs:</label>
       <div class="form-check-inline">
        <input type="radio" class="form-check-input" id="jour" name="heur" value="8h-12h" >8h-12h
        <input type="radio" class="form-check-input" id="jour" name="heur" value="15h-17h">15h-17h
      </div><br>
       <div class="form-group">
          <label for="dur">Duree Par Minute:</label><br>
             <input type="number" id="dur" class="form-control-sm" name="dur" value="15" readonly="true">
        </div>
        <div class="form-btn">
        <button type="submit" class="btn btn-success" name="btn">Pustuler</button>
   <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>
        </div>
     </form>
</div>

</body>
</html>