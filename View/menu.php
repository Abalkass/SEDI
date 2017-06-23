<body class="flat-blue">
    <div class="app-container">
      <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="'active'">Tableau de bord</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                      <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                      </button>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo ucwords($_SESSION['prenom']." ".$_SESSION['nom']) ?><span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="<?= VIEW_PATH_BASE; ?><?php echo $_SESSION['img_profile'] ?>" class="profile-img">
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"><?php echo ucwords($_SESSION['prenom']." ".$_SESSION['nom']) ?></h4>
                                        <p><?php echo $_SESSION['email']?></p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <a href="#" class="btn btn-default"><i class="fa fa-user"></i> Mon compte</a>
                                            <a href="index.php?action=deconnexion" class="btn btn-default"><i class="fa fa-sign-out"></i> Se déconnecter</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title">SEDI V.1.2</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="<?php if($controller == "IndexConnecte") echo 'active' ?>">
                                <a href="indexConnecte.php">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Tableau de Bord</span>
                                </a>
                            </li>
                            <li class="panel panel-default dropdown <?php if($controller == "Group") echo 'active' ?>">
                                <a data-toggle="collapse" href="#dropdown-element">
                                    <span class="icon fa fa-users"></span><span class="title">Groupes de permissions</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-element" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="group.php?action=gestionGroup">Gestion des groupes</a>
                                            </li>
                                            <li><a href="group.php?action=addGroup">Ajouter un groupe de permission</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="panel panel-default dropdown <?php if($controller == "User") echo 'active' ?>">
                                <a data-toggle="collapse" href="#dropdown-table">
                                    <span class="icon fa fa-user"></span><span class="title">Utilisateurs</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-table" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="user.php?action=gestionUser">Gestion des utilisateurs</a>
                                            </li>
                                            <li><a href="user.php?action=addUserStatut">Ajouter un utilisateur</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="panel panel-default dropdown <?php if($controller == "Student") echo 'active' ?>">
                                <a data-toggle="collapse" href="#dropdown-form">
                                    <span class="icon fa fa-graduation-cap"></span><span class="title">Etudiants</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-form" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="student.php?action=gestionStudent">Gestion des étudiants</a>
                                            </li>
                                            <li><a href="student.php?action=loadCSVStudent">Importer des étudiants à partir d'un CSV</a>
                                            </li>
                                            <li><a href="student.php?action=addStudent">Ajouter un étudiant avec INE</a>
                                            </li>
                                            <li><a href="student.php?action=loadCSVNote">Importer des notes à partir d'un CSV</a>
                                            </li>
                                            <li><a href="student.php?action=addStudentCursus">Affecter des étudiants à un cursus</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown-->
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#component-example">
                                    <span class="icon fa fa-pencil"></span><span class="title">Enseignants</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="component-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="teacher.php?action=gestionTeacher">Gestion des enseignants</a>
                                            </li>
                                            <li><a href="teacher.php?action=addTeacher">Ajouter un enseignant</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown-->
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-example">
                                    <span class="icon fa fa-tasks"></span><span class="title">Enseignements</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="enseignement.php?action=gestionCursus">Gestion des cursus</a>
                                            </li>
                                            <li><a href="enseignement.php?action=addCursus">Ajouter un cursus</a>
                                            </li>
                                            <li><a href="enseignement.php?action=gestionUE">Gestion des UE</a>
                                            </li>
                                            <li><a href="enseignement.php?action=addUE">Ajouter une UE</a>
                                            </li>
                                            <!--<li><a href="#">Gestion des modules</a>
                                            </li>
                                            <li><a href="#">Ajouter un module</a>
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Dropdown-->
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-icon">
                                    <span class="icon fa fa-calendar-o"></span><span class="title">Jurys</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-icon" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="jury.php?action=gestionJury">Gestion des jurys</a>
                                            </li>
                                            <li><a href="jury.php?action=addJury">Créer un Jury</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
