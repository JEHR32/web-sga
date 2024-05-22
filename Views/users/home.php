<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <title><?php echo $data['title']; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/plugins/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/plugins/perfectscroll/perfect-scrollbar.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/plugins/pace/pace.css'; ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <link href="<?php echo BASE_URL . 'Assets/css/main.css'; ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/plugins/DataTables/datatables.min.css'; ?>" />
    <link href="<?php echo BASE_URL . 'Assets/css/custom.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/css/select2.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'Assets/css/select2-bootstrap-5-theme.rtl.min.css'; ?>" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL . 'Assets/images/favicon.ico'; ?>">
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <!--Nombre y correo de quien inicio la sesion-->
        <div class="app-sidebar">
            <div class="logo">
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="#">
                        <img src="<?php echo BASE_URL . 'Assets/images/logo.png'; ?>">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text"><?php echo $_SESSION['nombre']; ?><br><span class="user-state-info"><?php echo $_SESSION['correo']; ?></span></span>
                    </a>
                </div>
            </div>
            <!--
            Este menu de opciones del panel lateral tiene muchas 
            funciones que se deben de configurar
            Menu de opciones panel lateral izquierdo... 
            ver las opciones de pagina dentro de hader
        -->
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Ver carpetas por estudio de:
                    </li>
                    <li class="<?php echo ($data['menu'] == 'usuarios') ? 'active-page' : ''; ?>">
                        <a href="#" class="<?php echo ($data['menu'] == 'usuarios') ? 'active' : ''; ?>">
                            <i class="material-icons">hearing</i>Audiometrias</a>
                    </li>
                    <li class="<?php echo ($data['menu'] == 'usuarios') ? 'active-page' : ''; ?>">
                        <a href="#" class="<?php echo ($data['menu'] == 'usuarios') ? 'active' : ''; ?>">
                            <i class="material-icons">record_voice_over</i>Espirometrias</a>
                    </li>
                    <li class="<?php echo ($data['menu'] == 'usuarios') ? 'active-page' : ''; ?>">
                        <a href="#" class="<?php echo ($data['menu'] == 'usuarios') ? 'active' : ''; ?>">
                            <i class="material-icons">charging_station</i>Rayos X</a>
                    </li>
                    <li class="<?php echo ($data['menu'] == 'usuarios') ? 'active-page' : ''; ?>">
                        <a href="#" class="<?php echo ($data['menu'] == 'usuarios') ? 'active' : ''; ?>">
                            <i class="material-icons">bloodtype</i>Estudios de laboratorio</a>
                    </li>
                    <li class="<?php echo ($data['menu'] == 'usuarios') ? 'active-page' : ''; ?>">
                        <a href="#" class="<?php echo ($data['menu'] == 'usuarios') ? 'active' : ''; ?>">
                            <i class="material-icons">medication</i>Otro tipo de estudio</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Toda la seccion de header -->
        <div class="app-container">
            <!-- Barra de busqueda -->
            <div class="search">
                <form>
                    <input class="form-control" id="inputBusqueda" type="text" placeholder="Buscar..." aria-label="Search">
                    <div id="container-result"></div>
                </form>
                <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
            </div>
            <!-- Edicion de perfil y cerrar sesion -->
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                                </li>
                                <li class="nav-item dropdown hidden-on-mobile"></li>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link toggle-search" href="#"><i class="material-icons">search</i></a>
                                </li>
                                <li class="nav-item hidden-on-mobile">
                                    <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"><img src="<?php echo BASE_URL . 'Assets/images/logo.png'; ?>" alt=""></a>
                                    <ul class="dropdown-menu dropdown-menu-end language-dropdown" aria-labelledby="languageDropDown">
                                        <li><a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/profile'; ?>">
                                                <i class="material-icons">
                                                    account_circle
                                                </i> Perfil</a>
                                        </li>
                                        <li><a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/salir'; ?>"><i class="material-icons">
                                                    power_settings_new
                                                </i> Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Body de gestion de archivos-->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="app-content">
                        <a href="#" class="content-menu-toggle btn btn-primary"><i class="material-icons">menu</i> content</a>
                        <div class="content-wrapper">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <div class="page-description d-flex align-items-center">
                                            <div class="page-description-content flex-grow-1">
                                                <h1>Resultados medicos.</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Muestro de carpetas que se van a compartir... se debe de configurar -->
                                <div id="container_progress" class="mb-3"></div>
                                <div class="row">
                                    <?php foreach ($data['carpetas'] as $carpeta) { ?>
                                        <div class="col-md-4">
                                            <div class="card file-manager-group">
                                                <div class="card-body d-flex align-items-center">
                                                    <i class="material-icons" style="color: #<?php echo $carpeta['color']; ?>;">folder</i>
                                                    <div class="file-manager-group-info flex-fill">
                                                        <a href="#" id="<?php echo $carpeta['id']; ?>" class="file-manager-group-title carpetas"><?php echo $carpeta['nombre']; ?></a>
                                                        <span class="file-manager-group-about"><?php echo $carpeta['fecha']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL . 'Assets/plugins/jquery/jquery-3.5.1.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/bootstrap/js/popper.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/perfectscroll/perfect-scrollbar.min.js'; ?>"></script>
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
    <script src="<?php echo BASE_URL . 'Assets/plugins/pace/pace.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/main.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/sweetalert2@11.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/select2.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . 'Assets/plugins/DataTables/datatables.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/custom.js'; ?>"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <?php if (!empty($data['script'])) { ?>
        <script src="<?php echo BASE_URL . 'Assets/js/pages/' . $data['script']; ?>"></script>
    <?php } ?>

</body>

</html>