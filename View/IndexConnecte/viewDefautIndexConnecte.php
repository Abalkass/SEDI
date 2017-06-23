<div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">

      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a href="student.php?action=gestionStudent">
          <div class="card blue summary-inline">
            <div class="card-body">
              <i class="icon fa fa-graduation-cap fa-4x"></i>
                <div class="content">
                  <div class="title"><?php echo sizeof($listEtudiants); ?></div>
                  <div class="sub-title">Etudiants</div>
                </div>
              <div class="clear-both"></div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a href="teacher.php?action=gestionTeacher">
          <div class="card blue summary-inline">
            <div class="card-body">
              <i class="icon fa fa-pencil fa-4x"></i>
                <div class="content">
                  <div class="title"><?php echo sizeof($listTeachers); ?></div>
                  <div class="sub-title">Enseignants</div>
                </div>
              <div class="clear-both"></div>
            </div>
          </div>
        </a>
      </div>

    </div>
    <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class="thumbnail no-margin-bottom">
          <img src="<?= VIEW_PATH_BASE; ?>images/Logo_SEDI.png" style="width:80%; padding: 20px"class="img-responsive">
            <div class="caption">
              <h3 id="thumbnail-label" class="text-center">Bienvenue sur SEDI</h3>
              <p class="text-center">Outil de suivi des étudiant du département info</p>
              <p><a href="#" class="btn btn-primary btn-block" role="button">En savoir plus</a></p>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
