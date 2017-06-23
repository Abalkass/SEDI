<?php
  // On passe une variable à true si on est dans le cas d'une modification d'étudiant
  if ($action=='updat') $bool = true;
  else $bool = false;
?>
<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Ajout d'un enseignant</span>
      <div class="description">Permet d'ajouter un enseignant au département informatique.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="teacher.php?action=<?php echo $action; ?>edTeacher">

            <div class="form-group ">
              <input type="hidden" name="idTeacher" value="<?php echo $idTeacher ?>" /> <!--disabled="disabled"-->
	          </div>

            <div class="form-group">
              <label for="inputNom" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
				      <input type="text" class="form-control" name="nom" id="inputNom" placeholder="Nom" <?php if ($bool) echo 'value="'.$nom.'"'; ?> required/>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
				      <input type="text" class="form-control" name="prenom" id="inputPrenom" placeholder="Prénom"<?php if ($bool) echo 'value="'.$prenom.'"'; ?> required/>
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
				      <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" <?php if ($bool) echo 'value="'.$email.'"'; ?> required/>
              </div>
            </div>

            <div class="form-group">
              <label for="select_statut" class="col-sm-2 control-label">Statut de l'enseignant</label>
              <div class="col-sm-10">
                <select name="statut" class="form-control" id="select_statut">
                  <option value="permanent" <?php if($bool && $teacher->statut == "permanent" )echo 'selected="selected"'; ?>>Permanent</option>
                  <option value="vacataire" <?php if($bool && $teacher->statut == "vacataire" )echo 'selected="selected"'; ?>>Vacataire</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
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
