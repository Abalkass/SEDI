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
      <span class="title">Création d'un jury</span>
      <div class="description">Permet de crée un jury pour un cursus.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body">
						<form class="form-horizontal" method="POST" action="jury.php?action=<?php echo $action; ?>edJury">

              <div class="form-group">
  							<label for="select_group" class="col-sm-3 control-label">Cursus concerné par le jury</label>
                <div class="col-sm-9">
  				       <?php listeCursus($listCursus); ?>
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
