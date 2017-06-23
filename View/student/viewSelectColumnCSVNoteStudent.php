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

  function gen_Form_Group($entete, $id) {
    $form = '<div class="form-group ">
      <label for="UE'.$id.'" class="col-sm-3 control-label">Colonne des notes de l\'UE'.$id.'</label>
      <div class="col-sm-9">
      <select name="UE'.$id.'" id="UE'.$id.'" class="form-control" required>';
          for ($c=0; $c < count($entete); $c++) {
            $form .= "<option value=$c>".$entete[$c]."</option>";
          }
      $form .= '</select>
      </div>
    </div>';
    echo $form;
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
              <div class="title">Etape 2 : Selection des colonnes du CSV à importer</div>
            </div>
          </div>
          <div class="card-body">
          <form class="form-horizontal" method="POST" action="student.php?action=checkCSVNote">

            <input type="hidden" name="File_CSV" value="<?= $file_path ?>" />
            <input type="hidden" name="cursus" value="<?= $cursus ?>" />
            <input type="hidden" name="nbUECursus" value="<?php echo $nbUECursus ?>" />

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

            <?php
            for ($c=1; $c <= $nbUECursus; $c++) {
              gen_Form_Group($entete, $c);
            }
            ?>

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
