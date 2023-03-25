<!DOCTYPE html>
<html class="loading dark-layout" lang="es" data-layout="dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="monocilindrero.com">
    <title>$titulo</title>
    <link rel="apple-touch-icon" href="$url_master/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="$url_master/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="$url_master/app-assets/css/pages/authentication.css">
    $ajax
</head>
<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="brand-logo" >
                                  <img src="img/ferguez.png" style="width: 90%;">
                                </a>
                                <div class="auth-form">
                                    <span>$error</span> 
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="o" value="verificarSession" />
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Correo</strong></label>
                                            <input type="text" name="correo" id="username" class="form-control" placeholder="correo@correo.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Contraseña</strong></label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" onclick="validarSession()" class="btn btn-success btn-block">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="$url_master/app-assets/vendors/js/vendors.min.js"></script>
    <script src="$url_master/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="$url_master/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="$url_master/app-assets/js/core/app-menu.js"></script>
    <script src="$url_master/app-assets/js/core/app.js"></script>
    <script src="$url_master/js/ferguez.js"></script>
    <script src="$url_master/js/asesores/asesores.js"></script>
    <script src="$url_master/js/categorias/categorias.js"></script>
    <script src="$url_master/js/clientes/clientes.js"></script>
    <script src="$url_master/js/familias/familias.js"></script>
    <script src="$url_master/js/productos/productos.js"></script>
    <script src="$url_master/app-assets/js/scripts/pages/auth-login.js"></script>
     <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
</html>