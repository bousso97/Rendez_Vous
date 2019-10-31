<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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
</body>
</html>