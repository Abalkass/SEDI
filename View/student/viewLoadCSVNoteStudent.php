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
      <span class="title">Importation des notes à partir d'un CSV</span>
      <div class="description">Permet d'importer les notes des etudiants d'un cursus.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="title">Etape 1 : Chargement du fichier CSV</div>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="student.php?action=selectColumnCSVNote" enctype="multipart/form-data">

              <div class="form-group">
  							<label for="select_group" class="col-sm-3 control-label">Cursus concerné par l'ajout des notes</label>
                <div class="col-sm-9">
  				       <?php listeCursus($listCursus); ?>
  						 </div>
  				    </div>
              
              <div class="form-group text-center">
                <div class="col-sm-offset-2 col-sm-8">
                <label for="InputFile">Veuillez charger le fichier de type CSV contenant la liste des notes des étudiants.</label>
                <input style="margin: auto;" id="InputFile" type="file"  name="CSV_File" required >
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
