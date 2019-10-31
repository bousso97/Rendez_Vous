<?php
require "fonction.php";
if (!empty($_POST))
 {
 	$code=checkInput($_POST['code']);
 	$libelle=checkInput($_POST['libelle']);


 

 	$db=database::connect();
 	$stm=$db->prepare("INSERT INTO service(code_ser,libelle_ser) values(?,?)");
 	$stm->execute(array($code,$libelle));
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
  <title>Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(../images/ser.jpg); background-repeat: round;">
<?php
require "header.php";
?><br><br><br>
<center>
  <div class="form-group">
 <form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="code" style="color: green;">Code</label><br>
       <input type="text" id="code" class="form-sm" name="code" placeholder="Code SVP">
  </div>
  <div class="form-group">
    <label for="disque" style="color: green;">Nom</label><br>
       <input type="text" id="libelle" class="form-sm" name="libelle"placeholder="Nom SVP">
  </div>
<div class="btn">
  <button type="submit" class="btn btn-success">Ajouter</button>
   <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>
   </div>
</form>
</div>

</body>
</html>