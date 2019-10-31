<?php
require "fonction.php";
$id=$_GET['id'];
//selection la ligne a modifier
$db=database::connect();
$stm=$db->prepare("SELECT  *FROM patient WHERE id=? ");
   $stm->execute(array($id));
   //parcours la ligne
   $list=$stm->fetch();

//action de mise a jours
  if (!empty($_POST)) {
    $Nom=checkInput($_POST['Nom']);
    $Prenom=checkInput($_POST['Prenom']);
    $Age=checkInput($_POST['Age']);
    $sexe=checkInput($_POST['sexe']);
    $Adresse=checkInput($_POST['Adresse']);
    $Telephone=checkInput($_POST['Telephone']);
    $db=database::connect();
    $stt=$db->prepare("UPDATE patient set nom_pt= ?,prenom_pt= ?,age_pt= ?,sexe=?,adresse_pt= ? ,tel_pt= ?  WHERE id=?");
    $stt->execute(array($Nom,$Prenom,$Age,$sexe,$Adresse,$Telephone,$id));
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
  <title>Patients</title>
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
     <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="Nom">Nom</label><br>
               <input type="text" id="Nom" class="form-sm" name="Nom" value="<?=$list['nom_pt']?>">
          </div>
           <div class="form-group">
            <label for="Prenom">Prenom</label><br>
               <input type="text" id="Prenom" class="form-sm" name="Prenom" value="<?=$list['prenom_pt']?>">
           </div>
           <div class="form-group">
            <label for="Age">Age</label><br>
               <input type="text" id="Age" class="form-sm" name="Age" value="<?=$list['age_pt']?>">
          </div>
             <label for="sexe">Sexe:</label>
           <div class="form-check-inline">
            <?php 
                  if ($list['sexe']=='Masculin') {?>
                     <input type="radio" class="form-check-input" id="sexe" name="sexe" value="Masculin"  checked="">M
                      <input type="radio" class="form-check-input" id="sexe" name="sexe" value="Feminin">F
                <?php  }else{
                  ?>
                       <input type="radio" class="form-check-input" id="sexe" name="sexe" value="Feminin" checked="">F
                     <input type="radio" class="form-check-input" id="sexe" name="sexe" value="Masculin" >M

               <?php }

            ?>
           
           
          </div><br>
               <div class="form-group">
            <label for="Adresse">Adresse</label><br>
               <input type="text" id="Adresse" class="form-sm" name="Adresse" value="<?=$list['adresse_pt']?>">
          </div>
          <div class="form-group">
            <label for="Telephone">Telephone</label><br>
               <input type="text" id="Telephone" class="form-sm" name="Telephone" value="<?=$list['tel_pt']?>">
          </div>
        <div class="btn">
          <button type="submit" class="btn btn-success">Modifier</button>
           <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left">Annuler</span> </a>
           </div>
    </form>
</div>
</body>
</html>