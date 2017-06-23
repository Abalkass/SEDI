
<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Détails du jury</span>
      <div class="description">Permet d'analyser les résultat d'un jury</div>
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
          <div class="card-header">
            <div class="card-title">
            <div class="title">Récapitulatif du jury <?= $cursus ?></div>
            </div>
          </div>
          <div class="card-body">
            <div class="sub-title">Bilan de l'arbre de décision !!! demo statique</div>
              <div>
                <ul class="list-group">
                  <li class="list-group-item list-group-item-success">
                    <span class="badge">14</span> Etudiants ayant validé le cursus
                  </li>
                  <li class="list-group-item list-group-item-warning">
                    <span class="badge">2</span> Etudiants en attente d'une décision de jury
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
