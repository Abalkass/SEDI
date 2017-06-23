
<?php
  function listeCSV($tabINE, $tabNom, $tabPrenom) {
    $tableau = '<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>INE</th>
        <th>Nom</th>
        <th>Prenom</th>
      </tr>
    </thead>
    <tbody>';
    for ($c=1; $c < count($tabINE); $c++) {
      $tableau .= '<tr>
      <td>'.$c.'</td>
      <td>'.$tabINE[$c].'</td>
      <td>'.$tabNom[$c].'</td>
      <td>'.$tabPrenom[$c].'</td>
      </tr>';
    }
    $tableau .= '</tbody></table>';
    if ($tabINE == null) echo "<br/>Il n'y a aucun étudiant à insérer<br/><br/>";
    else echo $tableau;
  }
?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Importation d'étudiants à partir d'un CSV</span>
      <div class="description">Permet d'ajouter automatiquement des étudiants.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="title">Etape 3 : Confirmation de l'insertion</div>
            </div>
          </div>
          <div class="card-body">
            <?php listeCSV($colonneINE, $colonneNom, $colonnePrenom); ?>

            <form class="form-horizontal" method="POST" action="student.php?action=addedCSVStudent">

              <input type="hidden" name="File_CSV" value="<?php echo $file_path ?>" />
              <input type="hidden" name="colonneINE" value="<?php echo $data['colonneINE'] ?>" />
              <input type="hidden" name="colonneNom" value="<?php echo $data['colonneNom'] ?>" />
              <input type="hidden" name="colonnePrenom" value="<?php echo $data['colonnePrenom'] ?>" />
              <input type="hidden" name="colonneBirthday" value="<?php echo $data['colonneBirthday'] ?>" />
              <input type="hidden" name="colonneMail" value="<?php echo $data['colonneMail'] ?>" />
              <input type="hidden" name="colonneAdress" value="<?php echo $data['colonneAdress'] ?>" />
              <input type="hidden" name="colonneCpltAdress" value="<?php echo $data['colonneCpltAdress'] ?>" />
              <input type="hidden" name="colonneCodeP" value="<?php echo $data['colonneCodeP'] ?>" />
              <input type="hidden" name="colonneCommune" value="<?php echo $data['colonneCommune'] ?>" />
              <input type="hidden" name="colonneState" value="<?php echo $data['colonneState'] ?>" />
              <input type="hidden" name="colonneTelF" value="<?php echo $data['colonneTelF'] ?>" />
              <input type="hidden" name="colonneTelP" value="<?php echo $data['colonneTelP'] ?>" />

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
