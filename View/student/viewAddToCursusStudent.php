<?php

	function listeCursus($list) {

$select = '<select name="cursus" class="form-control" required>';
foreach ($list as $li) {
	$select .= '<option value="'.$li->idCursus.'"';
	$select .= '>'.$li->idCursus.'</option>';
}
$select .= '</select>';
echo $select;
}

?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Affecter des étudiants à un cursus</span>
      <div class="description">Permet d'affecter des étudiants à son cursus actuel.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="title">Etape 1 : Choix du cursus</div>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="student.php?action=selectStudentToAffect" enctype="multipart/form-data">

              <div class="form-group">
  							<label for="select_group" class="col-sm-4 control-label">Cursus concerné par l'affectation d'étudiants</label>
                <div class="col-sm-8">
  				       <?php listeCursus($listCursus); ?>
  						 </div>
  				    </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
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
