

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medecins</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require"header.php"; ?><br><br><br>
<div class="container">
  <h2>Liste Des Medecins</h2>
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
				<button type="button" class="btn btn-success"><p class="glyphicon glyphicon-plus">Nouvel-Medecin</p></button> 
				</a>
			</div>
		</div><br>
 
 <table class="table table-striped table-bordered text-center">
	<tr>
    <th style="text-align: center;">Matricule</th>
    <th style="text-align: center;">Nom</th>
		<th  style="text-align: center;">Prenom</th>
    <th  style="text-align: center;">Email</th>
    <th  style="text-align: center;">Adresse</th>
    <th  style="text-align: center;">Telephone</th>
    <th  style="text-align: center;">Specialite</th>
    <th  style="text-align: center;">Service</th>
		<th  style="text-align: center;">Action</th>
	</tr>
   <tbody id="myTable">
	<?php 
require "fonction.php";
	$db=database::connect();
 	$stm=$db->prepare("SELECT  m.*,sp.libelle_sp,sr.libelle_ser  FROM medecin m,specialite sp,service sr where m.id_sp=sp.id and m.id_ser=sr.id");
 	$stm->execute();

 	database::deconnect();

		while ($par =$stm->fetch())
		{?>

	<tr>
      <td ><?=$par['matricule']?></td>
     	<td ><?=$par['nom_med']?></td>
      <td ><?=$par['prenom_med']?></td>
      <td ><?=$par['email_med']?></td>
      <td ><?=$par['adresse_med']?></td>
      <td ><?=$par['tel_med']?></td>
      <td ><?=$par['libelle_sp']?></td>
     	<td><?=$par['libelle_ser']?></td>

     	<td>
     		<a  href="edite.php?us=<?=$par['matricule']?>">
                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modd</button>
            </a>
     		<a  href="delete.php?us=<?=$par['matricule']?>" >
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
