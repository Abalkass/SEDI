
<?php
  function liste($lis) {
    $tableau = '<div class="card-body table-responsive">
    <table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Statut</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Statut</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </tfoot>
    <tbody>';
    foreach ($lis as $li) {
      $tableau .= '<tr>
      <td>'.ucfirst ($li->nom).'</td>
      <td>'.ucfirst ($li->prenom).'</td>
      <td>'.ucfirst ($li->statut).'</td>';
      $tableau .= '<td><form class="form-horizontal" role="form" method="post" action="teacher.php?action=updateTeacher"><input type="hidden" name="id" value="'.$li->idTeacher.'" /><button type="submit" class="btn btn-primary btn-xs" ><span class="fa fa-refresh"> Modifier</span></button></form></td>
      <td><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal'.$li->idTeacher.'"><span class="fa fa-times-circle"></span> Supprimer</button></td>
      <div class="modal fade modal-info" id="modal'.$li->idTeacher.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
            </div>
            <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer définitivement l\'étudiant '.$li->prenom." ".$li->nom.' ?
            </div>
            <div class="modal-footer">
              <form class="form-horizontal" role="form" method="post" action="teacher.php?action=deletedTeacher">
                <input type="hidden" name="id" value="'.$li->idTeacher.'" />
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
    if ($lis == null) echo "<br/>Il n'y a aucun enseignant dans la base de données<br/><br/>";
    else echo $tableau;
  }
?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Gestion des enseignants</span>
      <div class="description">Permet de gerer les enseignants du département informatique.</div>
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
          <?php liste($listTeacher); ?>
          <div>

        </div>
      </div>
    </div>
  </div>
</div>
