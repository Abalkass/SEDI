
<?php
  function listeCSV($tabINE, $tabNom, $tabPrenom) {
    $tableau = '<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Prenom</th>
      </tr>
    </thead>
    <tbody>';
    for ($c=1; $c < count($tabNom); $c++) {
      $tableau .= '<tr>
      <td>'.$c.'</td>
      <td>'.$tabNom[$c].'</td>
      <td>'.$tabPrenom[$c].'</td>
      </tr>';
    }
    $tableau .= '</tbody></table>';
    if ($tabNom == null) echo "<br/>Il n'y a aucune note à inserer<br/><br/>";
    else echo $tableau;
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
              <div class="title">Etape 3 : Confirmation de l'insertion des notes pour ces étudiants</div>
            </div>
          </div>
          <div class="card-body">
            <?php listeCSV($colonneINE, $colonneNom, $colonnePrenom); ?>

            <form class="form-horizontal" method="POST" action="student.php?action=addedCSVNote">

              <input type="hidden" name="File_CSV" value="<?php echo $file_path ?>" />
              <input type="hidden" name="colonneNom" value="<?php echo $colNom ?>" />
              <input type="hidden" name="colonnePrenom" value="<?php echo $colPrenom ?>" />
              <input type="hidden" name="nbUECursus" value="<?php echo $nbUECursus ?>" />
              <input type="hidden" name="cursus" value="<?php echo $cursus ?>" />
              <input type="hidden" name="colonneUE1" value="<?php echo $UE1 ?>" />
              <input type="hidden" name="colonneUE2" value="<?php echo $UE2 ?>" />
              <input type="hidden" name="colonneUE3" value="<?php echo $UE3 ?>" />


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="submit" class="btn btn-info btn-lg btn-block">Confirmer l'insertion</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
