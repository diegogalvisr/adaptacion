<?php
require("config/session.php");
require("config/constant.php");
require("config/helper.php");

//redirect to template page if the user is logged in
if (logged_in()) {
    header("Location: home.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesion l Bibliosoft GEMETECH </title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Inicia Sesion</h1>
                    <?php
                    $error_code = @$_GET['error'];
                    if ($error_code == ERROR_CODE_LOGIN) {
                        display_error('alert-danger', ERROR_MSG_LOGIN);
                    } elseif ($error_code == ERROR_CODE_BLOCKED) {
                        display_error('alert-danger', ERROR_MSG_BLOCKED);
                    }
                    ?>
                    <form action="procesoLogeo.php" method="post" style="text-align: center;">
                        <div class="form-group has-feedback">
                            <input type="text" name="email" class="form-control" placeholder="Usuario" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="olvido-clave">No tienes cuenta? <a href="auth-register.html" class="font-bold">Crear cuenta</a>.</p>
                        <p><a class="olvido-clave" href="auth-forgot-password.html">Has olvidado tu contraseña?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>