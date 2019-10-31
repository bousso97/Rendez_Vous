<?php
session_start();
$nom=$_SESSION['nom_user'];
if(empty($_SESSION['login'])){
  sleep(2);
  echo "<script>window.location.href='../index.php';</script>";
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rendez-Vous</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
  <?php require "header.php"; ?><br><br><br>
     <img src="../images/rv.png" align="right" width="80">
  <center>
  <h1>Welcome <font color="blue"> <?=$_SESSION['prenom_user']. ' ' .$_SESSION['nom_user']?></font></h1>
  </center>
<div class="container">
  <h2>Liste Des Rendez-Vous</h2>
  <div class="row">
    <div class="col-md-4">
        <div class="col-sm-8 mb-8">
            <input type="text" name="rec" id="rec" class="form-control" placeholder="Rechercher" >
        </div>
    </div>
    <script>
    $(document).ready(function(){
      $("#rec").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
        <div class=" col-md-8 text-right">
          <a href="add.php" >
            <?php

            if ($_SESSION['profil']=='medecin') 
            {
              // var_dump($_SESSION['profil']);
            ?>
                <button class="sr-only"  type="button" class="btn btn-success"><p class="sr-only" class="glyphicon glyphicon-plus">Nouvel-RV</p></button>
           <?php }elseif ($_SESSION['profil']=='secretaire') {
               // var_dump($_SESSION['profil']);

                 ?>
                <button type="button" class="btn btn-success"><p  class="glyphicon glyphicon-plus">Nouvel-RV</p></button> 
             <?php   }
                    else{?>
                      <button type="button" class="btn btn-success"><p  class="glyphicon glyphicon-plus">Nouvel-RV</p></button> 

                    <?php }
                 ?>
        </a>
      </div>
    </div><br>
 <table class="table table-striped table-bordered text-center">
  <tr>
    <th style="text-align:  center;">N</th>
    <th  style="text-align: center;">Libelle</th>
    <th  style="text-align: center;">Sevice</th>
    <th  style="text-align: center;">Secretaire</th>
    <th  style="text-align: center;">Patient</th>
    <th  style="text-align: center;">Medecin</th>
<!--     <th  style="text-align: center;">Jours</th>
    <th  style="text-align: center;">Heurs</th>
    <th  style="text-align: center;">Duree</th> -->
    <th  style="text-align: center;">Detailles</th>
    <th  style="text-align: center;">Action</th>
  </tr>
   <tbody id="myTable">
  <?php 
require "fonction.php";
$login=$_SESSION['login'];
  $db=database::connect();
  $tst=$db->prepare("SELECT *FROM medecin m where m.email_med='$login' ");
  $tst->execute();
  $mod =$tst->fetch();
  $mod1=$mod['id'];
    $secr=$db->prepare("SELECT *FROM secretaire s where s.email_sec='$login' ");
  $secr->execute();
  $se =$secr->fetch();
  $se1=$se['id'];
  
  $stm=$db->prepare("SELECT  rv.*, s.nom_sec,s.prenom_sec,m.nom_med,m.prenom_med,m.id,p.nom_pt,p.prenom_pt,sr.libelle_ser FROM rendez_vous rv ,patient p,medecin m,secretaire s,service sr where rv.id_pt=p.id and rv.id_sec=s.id and rv.id_med=m.id and s.id_ser=sr.id and (m.id= '$mod1' || s.id='$se1' )");
  $stm->execute();

  database::deconnect();

    while ($par =$stm->fetch())
    {?>

  <tr>
      <td ><?=$par['id']?></td>
      <td><?=$par['motif']?></td>
      <td ><?=$par['libelle_ser']?></td>
      <td style="color: blue;"><?=$par['nom_sec']?> <?=$par['prenom_sec']?></td>
      <td ><?=$par['nom_pt']?> <?=$par['prenom_pt']?></td>
      <td><?=$par['nom_med']?> <?=$par['prenom_med']?></td>
     <!--  <td ><?=$par['jours']?></td>
      <td><?=$par['heur']?></td>
      <td><?=$par['duree'] .'mns'?></td> -->
  <td><button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#myModal">Voire</button></td>


      <td>
        <a  href="edite.php?id=<?=$par['id']?>" >
                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modd</button>
            </a>
        <a  href="delete.php?id=<?=$par['id']?>" >
                <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Supp</button>
            </a>
      </td>
     </tr>
  
 
<div class="container">

  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: blue;">Rendez-Vous</h4>
        </div>
        <div class="modal-body">
          <p>Bonjours,<font color="blue"> Docteur</font>  <?=$par['prenom_med'].' '.$par['nom_med']?> Vous avez Un Rendez-vous <?=$par['jours'].' a'.$par['heur']?> Avec Le(a) <font color="blue"> Patient(e)</font> <?=$par['prenom_pt'].' '.$par['nom_pt']?> Dans Le Service <?=$par['libelle_ser']?> Pour <?=$par['motif']?> <br><font color="red"> Remarque</font>: Le Rv Dure Strictement <?=$par['duree'].'mns'?></p>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
      
    </div>
  </div>
  
</div>
  <?php }

  ?> 
   </tbody>

</table>
</div>
</body>
</html>
