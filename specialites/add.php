<?php
require "fonction.php";
if (!empty($_POST))
 {
 	$code=checkInput($_POST['code']);
 	$libelle=checkInput($_POST['libelle']);

 

 	$db=database::connect();
 	$stm=$db->prepare("INSERT INTO specialite(code_sp,libelle_sp) values(?,?)");
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
  <title>Specialités</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body background="../images/ch.jpg">
<?php
require "header.php";
?><br><br><br>
<marquee direction="up"> <h1 align="right" style="color: green;">“Dans cette ère, où tout n’est<br> que spécialisation, un médecin <br>sur cinq que vous consulterez <br>vous renverra vers<br> un autre médecin.”</h1></marquee>
<center>
  <form class="form-inline" method="POST">

    <label for="code" style="color: green;">Code:</label><br>
      <div class="form-group">
    <input type="text" class="form-control" id="code" name="code" required="true" placeholder="Code Svp">
  </div>
<br>
    <label for="libelle" style="color: green;">Libelle:</label><br>
     <div class="form-group">
    <input type="text" class="form-control" id="libelle"name="libelle" required="true" placeholder="Nom Svp">
  </div>
 <br><br>
  <button type="submit" class="btn btn-success">Ajouter</button>
  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>

</form> 
</center>
</body>
</html>