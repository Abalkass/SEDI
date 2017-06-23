
<body class="flat-blue login-page">
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                    <div class="col-sm-12 text-center login-header">
                        <a href="http://www.umontpellier.fr"><img src="<?= VIEW_PATH_BASE; ?>images/LOGO_original_RVB_petit.png" alt="Logo UM"/></a>

                        <h4 class="login-title">Site de suivi des étudiants du département informatique</h4>
                    </div>
                    <div class="col-sm-12">
                      <?php if($notification != NULL) echo'
                      <div class="alert fresh-color alert-info alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        '.$notification.'
                      </div>';
                      ?>
                        <div class="login-body">
                            <div class="progress hidden" id="login-progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    Log In...
                                </div>
                            </div>
                            <form method="POST" action="index.php?action=connect" class="form">
                                <div class="control">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required />
                                </div>
                                <div class="control">
                                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required/>
                                </div>
                                <div class="login-button text-center">
                                    <input type="submit" class="btn btn-primary" value="Connexion">
                                </div>
                            </form>
                        </div>
                        <div class="login-footer">
                            <span class="text-right"><a href="#" class="color-white">Mot de passe oublié?</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
