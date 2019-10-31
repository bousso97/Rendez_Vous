<?php 
require "fonction.php";
$id=$_GET['id'];
	
if (isset($_POST['sup'])) {
	$id=checkInput($_GET['id']);
	$db=database::connect();
 	$stm=$db->prepare("DELETE FROM specialite WHERE id=?");
 	$stm->execute(array($id));
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
  <title>Services</title>
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
				<h1><strong>Seppimer une Service</strong></h1><br>
	<div class="container" style="width: 35%; background-color: white;">
		<div class="row">
		<form class="form" role="form" method="POST">
			<p class="alert alert-warning">Etes Vous Sur De Voloire Supprimer ?? </p>
			<div class="form-actions">
				<button type="submit" name="sup" class="btn btn-success" >Oui</button>
				<a class="btn btn-default" href="index.php">Non</a>

			</div>
		</form> 
		</div>
</div>
</center>
</body>
