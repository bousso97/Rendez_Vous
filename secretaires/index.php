<?php
require "fonction.php";

$db=database::connect();
 	$stm=$db->prepare("SELECT  sr.*,s.libelle_ser FROM secretaire sr,service s where sr.id_ser=s.id");
 	$stm->execute();
 	database::deconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Secretaires</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require"header.php"; ?><br><br><br>
<div class="container">
  <h2>Liste Des Secretaires</h2>
  <div class="row">
    <div class="col-md-4">
        <div class="col-sm-8 mb-8">
            <input type="text" name="rec" id="rec" class="form-control" placeholder="Rechercher" >
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
    </div>
		    <div class=" col-md-8 text-right">
		    	<a href="add.php" >
				<button type="button" class="btn btn-success"><p class="glyphicon glyphicon-plus">Nouvel-Secretaire</p></button> 
				</a>
			</div>
		</div><br>
 <table class="table table-striped table-bordered text-center">
	<tr>
		<th style="text-align: center;">Matricule</th>
		<th style="text-align: center;">Nom</th>
		<th  style="text-align: center;">Prenom</th>
		<th  style="text-align: center;">Genre</th>
		<th  style="text-align: center;">Situation</th>
		<th  style="text-align: center;">Email</th>
		<th style="text-align: center;">Adresse</th>
		<th  style="text-align: center;">Telephone</th>
		<th  style="text-align: center;">Service</th>
		<th  style="text-align: center;">Actions</th>

	</tr>
	<?php 


		while ($par =$stm->fetch())
		{?>
<tbody id="myTable">
	<tr>
     	<td ><?=$par['matricule_sec']?></td>
     	<td ><?=$par['nom_sec']?></td>
     	<td><?=$par['prenom_sec']?></td>
       	<td><?=$par['genre_sec']?></td>
     	<td><?=$par['situation_sec']?></td>
     	<td ><?=$par['email_sec']?></td>
     	<td><?=$par['adresse_sec']?></td>
     	<td ><?=$par['tel_sec']?></td>
     	<td><?=$par['libelle_ser']?></td>
     	<td>
     		<a  href="edite.php?us=<?=$par['matricule_sec']?>" >
                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modd</button>
            </a>
     		<a  href="delete.php?us=<?=$par['matricule_sec']?>" >
                <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Supp</button>
            </a>
     	</td>
     </tr>
		<?php }

	?> 
	
</tbody>
</table>
</div>

</body>
</html>
