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
              <div class="title">Etape 1 : Chargement du fichier CSV</div>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="student.php?action=selectColumnCSV" enctype="multipart/form-data">

              <div class="form-group text-center">
                <div class="col-sm-offset-2 col-sm-8">
                <label for="InputFile">Veuillez charger le fichier de type CSV contenant la liste des étudiants avec leurs informations.</label>
                <input style="margin: auto;" id="InputFile" type="file"  name="CSV_File" required >
                </div>
              </div>

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
