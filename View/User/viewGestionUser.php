
<?php
  function liste($lis) {
    $tableau = '<div class="card-body table-responsive ">
    <table class="datatable table table-striped" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>E-mail</th>
        <th>Statut</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>E-mail</th>
        <th>Statut</th>
        <th>Supprimer</th>
      </tr>
    </tfoot>
    <tbody>';
    foreach ($lis as $li) {
      $tableau .= '<tr>
      <td>'.ucfirst ($li->nom).'</td>
      <td>'.ucfirst ($li->prenom).'</td>
      <td>'.$li->email.'</td>
      <td>'.ucfirst ($li->statut).'</td>';
      $tableau .= '<td><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal'.$li->idUser.'"><span class="fa fa-times-circle"></span> Supprimer</button></td>
      <div class="modal fade modal-info" id="modal'.$li->idUser.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
            </div>
            <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer définitivement l\'utilisateur '.$li->prenom." ".$li->nom.' ?
            </div>
            <div class="modal-footer">
              <form class="form-horizontal" role="form" method="post" action="user.php?action=deletedUser">
                <input type="hidden" name="id" value="'.$li->idUser.'" />
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
    if ($lis == null) echo "<br/>Il n'y a aucun utilisateur<br/><br/>";
    else echo $tableau;
  }
?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Gestion des utilisateurs</span>
      <div class="description">Permet de gerer les utilisateurs du site.</div>
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
          <?php liste($listUsers); ?>
        </div>
      </div>
    </div>
  </div>
</div>
