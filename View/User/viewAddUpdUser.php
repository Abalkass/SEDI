<?php
	//ucwords jsute esthétique poura voir majsucule
	function listeEtudiant($list) {

$select = '<select name="utilisateur" class="form-control" required>';
foreach ($list as $li) {
	$select .= '<option value="'.$li->INE.'"';
	$select .= '>'.ucwords($li->nom).' '.$li->prenom.'</option>';
}
$select .= '</select>';
echo $select;
}


	function listeUtilisateur($list) {

  $select = '<select name="utilisateur" class="form-control" required>';
  foreach ($list as $li) {
    $select .= '<option value="'.$li->idTeacher.'"';
    $select .= '>'.$li->nom.' '.$li->prenom.'</option>';
  }
  $select .= '</select>';
  echo $select;
}


	function GroupPerm($list) {

		$select = '<select name="groupe" class="form-control select" required>';
		foreach ($list as $li) {
			$select .= '<option value="'.$li->idPermission.'"';
			$select .= '>'.ucwords($li->nom).'</option>';
		}
		$select .= '</select>';
		echo $select;
	}
 ?>
 <div class="container-fluid">
   <div class="side-body">
     <div class="page-title">
       <span class="title">Ajout d'un utilisateurs</span>
       <div class="description">Permet d'ajouter un utilisateurs au site.</div>
     </div>
     <div class="row">
       <div class="col-xs-12">
         <div class="card">
					 <div class="card-header">
             <div class="card-title">
               <div class="title">Etape 2 : Selection du l'utisateur et selection du groupe de permission à affecter</div>
             </div>
           </div>
           <div class="card-body">
					 <form class="form-horizontal" method="POST" action="user.php?action=addedUser" >

						 <div class="form-group">
				 			<input type="hidden" name="statut" value="<?php echo $statut ?>" />
						</div>

				 		<div class="form-group">
							<label for="select_user" class="col-sm-3 control-label">Choisir l'utilisateur à ajouter</label>
              <div class="col-sm-9">
				 			<?php
				 			if($statut == 'etudiant'){
				 				listeEtudiant($listEtudiant);
				 			}
				 			else{
				 				listeUtilisateur($listEnseignant);
				 			}
				 			?>
						</div>
				 		</div>

				 		<div class="form-group">
							<label for="select_group" class="col-sm-3 control-label">Groupe de permission à affecter</label>
              <div class="col-sm-9">
				       <?php GroupPerm($listGroup); ?>
						 </div>
				    </div>

						 <div class="form-group">
               <div class="col-sm-offset-3 col-sm-9">
                 <button type="submit" class="btn btn-info btn-lg btn-block">Valider</button>
               </div>
             </div>

					 </form>
         </div>
         </div>
       </div>
     </div>
   </div>
 </div>
