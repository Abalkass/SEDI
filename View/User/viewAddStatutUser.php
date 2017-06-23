<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Ajout d'un utilisateurs</span>
      <div class="description">Permet d'ajouter un utilisateurs au site.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="title">Etape 1 : Selection du statut de l'utilisateur à ajouter</div>
            </div>
          </div>
          <div class="card-body">
          <form class="form-horizontal" method="POST" action="user.php?action=addUser">
            <div class="form-group">
              <label for="select_statut" class="col-sm-2 control-label">Statut de l'utilisateur</label>
              <div class="col-sm-10">
                <select name="statut" class="form-control" id="select_statut">
                  <option value="etudiant">Etudiant</option>
                  <option value="enseignant">Enseignant</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
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
