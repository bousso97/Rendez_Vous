<?php
require "fonction.php";
$id=$_GET['id'];
//selection la ligne a modifier
$db=database::connect();
$stm=$db->prepare("SELECT  *FROM service WHERE id=? ");
   $stm->execute(array($id));
   //parcours la ligne
   $list=$stm->fetch();

//action de mise a jours
  if (!empty($_POST)) {
    $code=checkInput($_POST['code']);
    $libelle=checkInput($_POST['libelle']);
    $db=database::connect();
    $stt=$db->prepare("UPDATE service set code_ser= ?,libelle_ser=? WHERE id=?");
    $stt->execute(array($code,$libelle,$id));
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
 <form class="form-inline" method="POST">
  <div class="form-group">
    <label for="code">Code:</label>
    <input type="text" class="form-control" id="code" name="code" value="<?php echo $list['code_ser'];?>">
  </div>
  <div class="form-group">
    <label for="libelle">Libelle:</label>
    <input type="text" class="form-control" id="libelle"name="libelle" value="<?php echo $list['libelle_ser'];?>">
  </div>
 <br><br>
  <button type="submit" class="btn btn-success" value="Modifier">Modifier</button>
  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Retour</span> </a>

</form> 
</center>
</body>
</html>