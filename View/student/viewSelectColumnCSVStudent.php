<?php

  function lectureEnteteCSV($file_path) {
    $ligne = 1;
    if (($handle = fopen("$file_path", "r")) !== FALSE) {
      if (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
          $nbChamps = count($data); // Nombre de champ dans la ligne en question
      }
      fclose($handle);
    }
    return $data;
  }

  $entete = lectureEnteteCSV($file_path);

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
              <div class="title">Etape 2 : Selection des colonnes du CSV à importer</div>
            </div>
          </div>
          <div class="card-body">
          <form class="form-horizontal" method="POST" action="student.php?action=checkCSVStudent">

            <input type="hidden" name="File_CSV" value="<?php echo $file_path ?>" />

            <div class="form-group ">
              <label for="colINE" class="col-sm-3 control-label">Colonne de l'INE</label>
              <div class="col-sm-9">
              <select name="colonneINE" id="colINE" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colNom" class="col-sm-3 control-label">Colonne du nom</label>
              <div class="col-sm-9">
              <select name="colonneNom" id="colNom" class="form-control"  required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colPrenom" class="col-sm-3 control-label">Colonne du Prénom</label>
              <div class="col-sm-9">
              <select name="colonnePrenom" id="colPrenom" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colbirthday" class="col-sm-3 control-label">Colonne de la date de naissance</label>
              <div class="col-sm-9">
              <select name="colonneBirthday" id="colbirthday" class="form-control " required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colMail" class="col-sm-3 control-label">Colonne de l'email</label>
              <div class="col-sm-9">
              <select name="colonneMail" id="colMail" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colAdress" class="col-sm-3 control-label">Colonne de l'adresse</label>
              <div class="col-sm-9">
              <select name="colonneAdress" id="colAdress" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colAdressBis" class="col-sm-3 control-label">Colonne du complément d'adresse</label>
              <div class="col-sm-9">
              <select name="colonneCpltAdress" id="colAdressBis" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colCodep" class="col-sm-3 control-label">Colonne du code postal</label>
              <div class="col-sm-9">
              <select name="colonneCodeP" id="colCodep" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colCommune" class="col-sm-3 control-label">Colonne de la commune</label>
              <div class="col-sm-9">
              <select name="colonneCommune" id="colCommune" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colState" class="col-sm-3 control-label">Colonne du pays</label>
              <div class="col-sm-9">
              <select name="colonneState" id="colState" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
            </div>
            </div>

            <div class="form-group ">
              <label for="colTelf" class="col-sm-3 control-label">Colonne du téléphone fixe</label>
              <div class="col-sm-9">
              <select name="colonneTelF" id="colTelf" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
              </div>
            </div>

            <div class="form-group ">
              <label for="colTelp" class="col-sm-3 control-label">Colonne du téléphone portable</label>
              <div class="col-sm-9">
              <select name="colonneTelP" id="colTelp" class="form-control" required>
                <?php
                  for ($c=0; $c < count($entete); $c++) {
                    echo "<option value=$c>".$entete[$c]."</option>";
                  }
                 ?>
              </select>
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
