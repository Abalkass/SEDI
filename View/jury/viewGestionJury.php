
<?php
  function liste($lis) {
    $tableau = '<div class="card-body table-responsive ">
    <table class="datatable table table-hover" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Cursus concerné</th>
        <th>Détail</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Cursus concerné</th>
        <th>Détail</th>
        <th>Supprimer</th>
      </tr>
    </tfoot>
    <tbody>';
    foreach ($lis as $li) {
      $tableau .= '<tr>
      <td>'.$li->idCursus.'</td>';
      $tableau .= '<td><form class="form-horizontal" role="form" method="post" action="jury.php?action=detailJury"><input type="hidden" name="id" value="'.$li->idJury.'" /><button type="submit" class="btn btn-primary btn-xs" ><span class="fa fa-external-link"> Détail</span></button></form></td>
      <td><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal'.$li->idJury.'"><span class="fa fa-times-circle"></span> Supprimer</button></td>
      <div class="modal fade modal-info" id="modal'.$li->idJury.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
            </div>
            <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer définitivement ce jury ?
            </div>
            <div class="modal-footer">
              <form class="form-horizontal" role="form" method="post" action="jury.php?action=deletedJury">
                <input type="hidden" name="id" value="'.$li->idJury.'" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-info">Supprimer</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      </tr>';
    }
    $tableau .= '</tbody></table></div>';
    if ($lis == null) echo "<br/>Il n'y a aucun jury<br/><br/>";
    else echo $tableau;
  }
?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Gestion des Jury</span>
      <div class="description">Permet de gerer les différents Jury.</div>
    </div>
    <?php if($notification != NULL) echo'
    <div class="alert fresh-color alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      '.$notification.'
    </div>';
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <?php liste($listJury); ?>
        </div>
      </div>
    </div>
  </div>
</div>
