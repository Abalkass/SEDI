
<?php

  function listeStudentCheckbox($list) {
    $checkbox = '';
      foreach ($list as $li) {
      $checkbox .= '<div class="checkbox3  checkbox-check checkbox-light">';
      $checkbox .= '<input type="checkbox" name="INE[]" value="'.$li->INE.'" id="'.$li->INE.'">';
      $checkbox .= '<label for="'.$li->INE.'">'.ucfirst ($li->nom).' '.ucfirst ($li->prenom).'</label>';
      $checkbox .= '</div>';
      }
    echo $checkbox;
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
              <div class="title">Etape 2 : Selection des étudiants à affecter au cursus <?= $cursus ?></div>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="student.php?action=affectedStudent" enctype="multipart/form-data">

              <input type="hidden" name="cursus" value="<?php echo $cursus ?>" />

  				    <?php listeStudentCheckbox($listStudent); ?>

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
