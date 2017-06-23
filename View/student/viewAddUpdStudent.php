<?php
  // On passe une variable à true si on est dans le cas d'une modification d'étudiant
  if ($action=='updat') $bool = true;
  else $bool = false;
?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Ajout d'un étudiant </span>
      <div class="description">Permet d'ajouter manuellement un étudiant disposant d'un INE.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="student.php?action=<?php echo $action; ?>edStudent">

              <div class="form-group ">
                <input type="hidden" name="INE" value="<?php echo $INE ?>" />
                <label for="inputINE" class="col-sm-2 control-label">Numero INE</label>
                <div class="col-sm-10">
        				  <input type="text" class="form-control" name="INE" id="inputINE" placeholder="INE de l'étudiant" <?php if ($bool) echo 'value="'.$INE.'"'.'disabled="disabled"';?>  required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputNom" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
        				      <input type="text" class="form-control" name="nom" id="inputNom" placeholder="Nom" <?php if ($bool) echo 'value="'.$nom.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>
                <div class="col-sm-10">
        				      <input type="text" class="form-control" name="prenom" id="inputPrenom" placeholder="Prénom" <?php if ($bool) echo 'value="'.$prenom.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputNaissance" class="col-sm-2 control-label">Date de naissance</label>
                <div class="col-sm-10">
        				      <input type="date" class="form-control" name="date_naissance" id="inputNaissance" placeholder="Date de naissance" <?php if ($bool) echo 'value="'.$date_naissance.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
        				  <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" <?php if ($bool) echo 'value="'.$email.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputAdresse" class="col-sm-2 control-label">Adresse</label>
                <div class="col-sm-10">
        				  <input type="text" class="form-control" name="adresse" id="inputAdresse" placeholder="Adresse" <?php if ($bool) echo 'value="'.$adresse.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputcpltAdresse" class="col-sm-2 control-label">Complément d'adresse</label>
                <div class="col-sm-10">
        				  <input type="text" class="form-control" name="complement_adresse" id="inputcpltAdresse" placeholder="Complément d'adresse" <?php if ($bool) echo 'value="'.$complement_adresse.'"'; ?> />
                </div>
              </div>

              <div class="form-group">
                <label for="inputCodePostal" class="col-sm-2 control-label">Code postal</label>
                <div class="col-sm-10">
        				  <input type="text" class="form-control" name="code_postal" id="inputCodePostal" placeholder="Format : 34000" <?php if ($bool) echo 'value="'.$code_postal.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputCommune" class="col-sm-2 control-label">Commune</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="commune" id="inputCommune" placeholder="Commune" <?php if ($bool) echo 'value="'.$commune.'"'; ?> required/>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPays" class="col-sm-2 control-label">Pays</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="pays" id="inputPays" placeholder="Pays" <?php if ($bool) echo 'value="'.$pays.'"'; ?> />
                </div>
              </div>

              <div class="form-group">
                <label for="inputTel1" class="col-sm-2 control-label">Télephone fixe</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" name="tel_fixe" id="inputTel1" placeholder="Format : 04.99.58.50.40" <?php if ($bool) echo 'value="'.$tel_fixe.'"'; ?> />
                </div>
              </div>

              <div class="form-group">
                <label for="inputTel2" class="col-sm-2 control-label">Téléphone portable</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" name="tel_portable" id="inputTel2" placeholder="Format : 04.99.58.50.40" <?php if ($bool) echo 'value="'.$tel_portable.'"'; ?> />
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
