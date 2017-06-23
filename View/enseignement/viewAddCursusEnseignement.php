<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Ajout d'un cursus</span>
      <div class="description">Permet de crée un nouveau Cursus.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body">
						<form class="form-horizontal" method="POST" action="enseignement.php?action=<?php echo $action; ?>edCursus">

      			<div class="form-group">
							<label for="domaine" class="col-sm-3 control-label">Choix du domaine</label>
							<div class="col-sm-9">
      				<select name="domaine" id="domaine" class="form-control select select-primary" data-toggle="select" required>
            		<option value="DUT">DUT Production</option>
            		<option value="AS">DUT Production (année spéciale)</option>
            		<option value="APIDAE">Licence professionelle APIDAE</option>
            		<option value="ACPI">Licence professionelle ACPI</option>
            		<option value="PSGI">Licence professionelle PSGI</option>
            		<option value="DU">DU</option>
      				</select>
							</div>
    				</div>

      			<div class="form-group">
							<label for="domaine" class="col-sm-3 control-label">Année du cursus</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="annee" placeholder="ex: 2015" required/>
							</div>
	    			</div>

      			<div class="form-group">
							<label for="annee_domaine" class="col-sm-3 control-label">Choix du l'année de la formation</label>
							<div class="col-sm-9">
      				<select name="annee_domaine" id="annee_domaine" class="form-control select select-primary" data-toggle="select" required>
            		<option value="A1">Première année</option>
            		<option value="A2">Seconde année</option>
      				</select>
							</div>
    				</div>

      			<div class="form-group">
							<label for="select_semestre" class="col-sm-3 control-label">Choix du semestre</label>
							<div class="col-sm-9">
      				<select name="semestre" id="select_semestre" class="form-control select select-primary" data-toggle="select" required>
            		<option value="S1">Semestre 1</option>
            		<option value="S2">Semestre 2</option>
      				</select>
							</div>
    				</div>

            <div class="form-group">
							<label for="nbUE" class="col-sm-3 control-label">Nombre d'UE dans ce cursus</label>
							<div class="col-sm-9">
      				  <input type="number" class="form-control" id="nbUE" name="nbUE" min="0" max="3">
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
