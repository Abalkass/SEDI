<?php
	// On passe une variable à true si on est dans le cas d'une modification de groupe
	if ($action=='updat') $bool = true;
	else $bool = false;
?>

<div class="container-fluid">
  <div class="side-body">
    <div class="page-title">
      <span class="title">Ajout d'un groupe</span>
      <div class="description">Permet de crée un nouveau groupe permission et de lui affecter des droits.</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body">
						<form class="form-horizontal" method="POST" action="group.php?action=<?php echo $action; ?>edGroup">

							<div class="form-group ">
								<?php if ($bool) echo '<input type="hidden" name="id" value="'.$id.'" />
								<input type="hidden" name="oldnom" value="'.$nom.'" />'; ?>
                <label for="inputNom" class="col-sm-3 control-label">Nom du groupe</label>
                <div class="col-sm-9">
        				  <input type="text" class="form-control login-field" name="nom" placeholder="Nom du groupe" id="nom_id" <?php if ($bool) echo 'value="'.$nom.'"'; ?> required/>
                </div>
              </div>

							<legend>Droits concernant les utilisateurs</legend>
							<div class="form-group">
								<label for="Dsp_User" class="col-sm-3 control-label">Afficher la liste des utilisateurs</label>
								<div class="col-sm-9">
									<select name="Dsp_User" id="Dsp_User" class="form-control " required>
            				<option value="dsp_User_non" <?php if($bool && $selected_dsp_User == 0 )echo 'selected="selected"'; ?>>Afficher les utilisateurs - Non</option>
										<option value="dsp_User_oui"<?php if($bool && $selected_dsp_User == 1 ) echo 'selected="selected"'; ?>>Afficher les utilisateurs - Oui</option>
      						</select>
								</div>
    					</div>

							<div class="form-group">
								<label for="Add_User" class="col-sm-3 control-label">Ajouter un utilisateur</label>
								<div class="col-sm-9">
								<select name="Add_User" id="Add_User" class="form-control" required>
            			<option value="add_User_non" <?php if($bool && $selected_add_User == 0 )echo 'selected="selected"'; ?>>Ajouter un utilisateur - Non</option>
									<option value="add_User_oui"<?php if($bool && $selected_add_User == 1 ) echo 'selected="selected"'; ?>>Ajouter un utilisateur - Oui</option>
								</select>
								</div>
    					</div>

    					<div class="form-group">
								<label for="Dsp_User" class="col-sm-3 control-label">Supprimer un utilisateur</label>
								<div class="col-sm-9">
      					<select name="Del_User" id="Del_User" class="form-control" required>
            			<option value="del_User_non" <?php if($bool && $selected_del_User == 0) echo 'selected="selected"'; ?>>Supprimer un utilisateur - Non</option>
									<option value="del_User_oui" <?php if($bool && $selected_del_User == 1) echo 'selected="selected"';?>>Supprimer un utilisateur - Oui</option>
      					</select>
								</div>
    					</div>

							<legend>Droits concernant les groupes de permissions</legend>
							<div class="form-group">
								<label for="Dsp_Group" class="col-sm-3 control-label">Afficher la liste des groupes</label>
								<div class="col-sm-9">
      					<select name="Dsp_Group" id="Dsp_Group" class="form-control" required>
            			<option value="dsp_Group_non" <?php if($bool && $selected_dsp_Group == 0 )echo 'selected="selected"'; ?>>Afficher les groupes - Non</option>
									<option value="dsp_Group_oui"<?php if($bool && $selected_dsp_Group == 1 ) echo 'selected="selected"'; ?>>Afficher les groupes - Oui</option>
      					</select>
								</div>
    					</div>

							<div class="form-group">
								<label for="Add_Group" class="col-sm-3 control-label">Ajouter un groupe de permission</label>
								<div class="col-sm-9">
      					<select name="Add_Group" id="Add_Group" class="form-control" required>
            			<option value="add_Group_non" <?php if($bool && $selected_add_Group == 0) echo 'selected="selected"'; ?>>Ajouter un groupe de permission - Non</option>
									<option value="add_Group_oui" <?php if($bool && $selected_add_Group == 1) echo 'selected="selected"';?>>Ajouter un groupe de permission - Oui</option>
      					</select>
								</div>
    				</div>

						<div class="form-group">
							<label for="Del_Group" class="col-sm-3 control-label">Supprimer un groupe de permission</label>
							<div class="col-sm-9">
      					<select name="Del_Group" id="Del_Group" class="form-control" required>
            			<option value="del_Group_non" <?php if($bool && $selected_del_Group == 0) echo 'selected="selected"'; ?>>Supprimer un groupe de permission - Non</option>
									<option value="del_Group_oui" <?php if($bool && $selected_del_Group == 1) echo 'selected="selected"';?>>Supprimer un groupe de permission - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Upd_Group" class="col-sm-3 control-label">Modifier un groupe de permission</label>
							<div class="col-sm-9">
      					<select name="Upd_Group" id="Upd_Group" class="form-control" required>
            			<option value="upd_Group_non" <?php if($bool && $selected_upd_Group == 0) echo 'selected="selected"'; ?>>Modifier un groupe de permission - Non</option>
									<option value="upd_Group_oui" <?php if($bool && $selected_upd_Group == 1) echo 'selected="selected"';?>>Modifier un groupe de permission - Oui</option>
      					</select>
							</div>
    				</div>

						<legend>Droits concernant les étudiants</legend>
						<div class="form-group">
							<label for="Dsp_Student" class="col-sm-3 control-label">Afficher la liste des étudiants</label>
							<div class="col-sm-9">
      					<select name="Dsp_Student" id="Dsp_Student" class="form-control" required>
            			<option value="dsp_Student_non" <?php if($bool && $selected_dsp_Student == 0 )echo 'selected="selected"'; ?>>Afficher les étudiants - Non</option>
									<option value="dsp_Student_oui"<?php if($bool && $selected_dsp_Student == 1 ) echo 'selected="selected"'; ?>>Afficher les étudiants - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Add_Student" class="col-sm-3 control-label">Ajouter un étudiant</label>
							<div class="col-sm-9">
      					<select name="Add_Student" id="Add_Student" class="form-control" required>
            			<option value="add_Student_non" <?php if($bool && $selected_add_Student == 0) echo 'selected="selected"'; ?>>Ajouter un étudiant - Non</option>
									<option value="add_Student_oui" <?php if($bool && $selected_add_Student == 1) echo 'selected="selected"';?>>Ajouter un étudiant - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Del_Student" class="col-sm-3 control-label">Supprimer un étudiant</label>
							<div class="col-sm-9">
      					<select name="Del_Student" id="Del_Student" class="form-control" required>
            			<option value="del_Student_non" <?php if($bool && $selected_del_Student == 0) echo 'selected="selected"'; ?>>Supprimer un étudiant - Non</option>
									<option value="del_Student_oui" <?php if($bool && $selected_del_Student == 1) echo 'selected="selected"';?>>Supprimer un étudiant - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Upd_Student" class="col-sm-3 control-label">Modifier un étudiant</label>
							<div class="col-sm-9">
      					<select name="Upd_Student" id="Upd_Student" class="form-control" required>
            			<option value="upd_Student_non" <?php if($bool && $selected_upd_Student == 0) echo 'selected="selected"'; ?>>Modifier un étudiant - Non</option>
									<option value="upd_Student_oui" <?php if($bool && $selected_upd_Student == 1) echo 'selected="selected"';?>>Modifier un étudiant - Oui</option>
      					</select>
							</div>
    				</div>

						<legend>Droits concernant les Enseignants</legend>
						<div class="form-group">
							<label for="Dsp_Teacher" class="col-sm-3 control-label">Afficher la liste des enseignants</label>
							<div class="col-sm-9">
      					<select name="Dsp_Teacher" id="Dsp_Teacher" class="form-control" required>
            			<option value="dsp_Teacher_non" <?php if($bool && $selected_dsp_Teacher == 0 )echo 'selected="selected"'; ?>>Afficher les enseignants - Non</option>
									<option value="dsp_Teacher_oui"<?php if($bool && $selected_dsp_Teacher == 1 ) echo 'selected="selected"'; ?>>Afficher les enseignants - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Add_Teacher" class="col-sm-3 control-label">Ajouter un enseignant</label>
							<div class="col-sm-9">
      					<select name="Add_Teacher" id="Add_Teacher" class="form-control" required>
            			<option value="add_Teacher_non" <?php if($bool && $selected_add_Teacher == 0) echo 'selected="selected"'; ?>>Ajouter un enseignant - Non</option>
									<option value="add_Teacher_oui" <?php if($bool && $selected_add_Teacher == 1) echo 'selected="selected"';?>>Ajouter un enseignant - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Del_Teacher" class="col-sm-3 control-label">Supprimer un enseignant</label>
							<div class="col-sm-9">
      					<select name="Del_Teacher" id="Del_Teacher" class="form-control" required>
            			<option value="del_Teacher_non" <?php if($bool && $selected_del_Teacher == 0) echo 'selected="selected"'; ?>>Supprimer un enseignant - Non</option>
									<option value="del_Teacher_oui" <?php if($bool && $selected_del_Teacher == 1) echo 'selected="selected"';?>>Supprimer un enseignant - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Upd_Teacher" class="col-sm-3 control-label">Modifier un enseignant</label>
							<div class="col-sm-9">
      					<select name="Upd_Teacher" id="Upd_Teacher" class="form-control" required>
            			<option value="upd_Teacher_non" <?php if($bool && $selected_upd_Teacher == 0) echo 'selected="selected"'; ?>>Modifier un enseignant - Non</option>
									<option value="upd_Teacher_oui" <?php if($bool && $selected_upd_Teacher == 1) echo 'selected="selected"';?>>Modifier un enseignant- Oui</option>
      					</select>
							</div>
    				</div>

						<legend>Droits concernant les Cursus</legend>
						<div class="form-group">
							<label for="Dsp_Cursus" class="col-sm-3 control-label">Afficher la liste des cursus</label>
							<div class="col-sm-9">
      					<select name="Dsp_Cursus" id="Dsp_Cursus" class="form-control" required>
            			<option value="dsp_Cursus_non" <?php if($bool && $selected_dsp_Cursus == 0 )echo 'selected="selected"'; ?>>Afficher les cursus - Non</option>
									<option value="dsp_Cursus_oui"<?php if($bool && $selected_dsp_Cursus == 1 ) echo 'selected="selected"'; ?>>Afficher les cursus - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Add_Cursus" class="col-sm-3 control-label">Ajouter un cursus</label>
							<div class="col-sm-9">
      					<select name="Add_Cursus" id="Add_Cursus" class="form-control" required>
            			<option value="add_Cursus_non" <?php if($bool && $selected_add_Cursus == 0) echo 'selected="selected"'; ?>>Ajouter un cursus - Non</option>
									<option value="add_Cursus_oui" <?php if($bool && $selected_add_Cursus == 1) echo 'selected="selected"';?>>Ajouter un cursus - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Del_Cursus" class="col-sm-3 control-label">Supprimer cursus</label>
							<div class="col-sm-9">
      					<select name="Del_Cursus" id="Del_Cursus" class="form-control" required>
            			<option value="del_TCursus_non" <?php if($bool && $selected_del_Cursus == 0) echo 'selected="selected"'; ?>>Supprimer un cursus - Non</option>
									<option value="del_Cursus_oui" <?php if($bool && $selected_del_Cursus == 1) echo 'selected="selected"';?>>Supprimer un cursus - Oui</option>
      					</select>
							</div>
    				</div>

						<legend>Droits concernant les modules</legend>
						<div class="form-group">
							<label for="Dsp_Module" class="col-sm-3 control-label">Afficher la liste des modules</label>
							<div class="col-sm-9">
      					<select name="Dsp_Module" id="Dsp_Module" class="form-control" required>
            			<option value="dsp_Module_non" <?php if($bool && $selected_dsp_Module == 0 )echo 'selected="selected"'; ?>>Afficher les modules - Non</option>
									<option value="dsp_Module_oui"<?php if($bool && $selected_dsp_Module == 1 ) echo 'selected="selected"'; ?>>Afficher les modules - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Add_Module" class="col-sm-3 control-label">Ajouter un module</label>
							<div class="col-sm-9">
      					<select name="Add_Module" id="Add_Module" class="form-control"  required>
            			<option value="add_Module_non" <?php if($bool && $selected_add_Module == 0 )echo 'selected="selected"'; ?>>Ajouter un module - Non</option>
									<option value="add_Module_oui"<?php if($bool && $selected_add_Module == 1 ) echo 'selected="selected"'; ?>>Ajouter un module - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Del_Module" class="col-sm-3 control-label">Supprimer un module</label>
							<div class="col-sm-9">
      					<select name="Del_Module" id="Del_Module" class="form-control" required>
            			<option value="del_Module_non" <?php if($bool && $selected_del_Module == 0 )echo 'selected="selected"'; ?>>Supprimer un module - Non</option>
									<option value="del_Module_oui"<?php if($bool && $selected_del_Module == 1 ) echo 'selected="selected"'; ?>>Supprimer un module - Oui</option>
      					</select>
							</div>
    				</div>

						<div class="form-group">
							<label for="Upd_Module" class="col-sm-3 control-label">Modifier un module</label>
							<div class="col-sm-9">
      					<select name="Upd_Module" id="Upd_Module" class="form-control" required>
            			<option value="upd_Module_non" <?php if($bool && $selected_upd_Module == 0 )echo 'selected="selected"'; ?>>Modifier un module - Non</option>
									<option value="upd_Module_oui"<?php if($bool && $selected_upd_Module == 1 ) echo 'selected="selected"'; ?>>Modifier un module - Oui</option>
      					</select>
    					</div>
						</div>

						<legend>Droits concernant les Jurys</legend>
						<div class="form-group">
							<label for="Dsp_Jury" class="col-sm-3 control-label">Afficher la liste des jurys</label>
							<div class="col-sm-9">
      					<select name="Dsp_Jury" id="Dsp_Jury" class="form-control" required>
            			<option value="dsp_Jury_non" <?php if($bool && $selected_dsp_Jury == 0 )echo 'selected="selected"'; ?>>Afficher les jurys - Non</option>
									<option value="dsp_Jury_oui"<?php if($bool && $selected_dsp_Jury == 1 ) echo 'selected="selected"'; ?>>Afficher les jurys - Oui</option>
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
</div>
