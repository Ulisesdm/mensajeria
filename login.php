<?php
/*Login de sesion, se pude ingresar siempre y cuando la session no este iniciada */
include 'app/config.php';
if (isset($_SESSION["fa_login"])) {
    header("Location:acceso.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/L_MAKICOP.png">
    <title>MENSAJERIA</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/color.css" rel="stylesheet">
    <link href="css/afacturacss.css" rel="stylesheet">
<style>
    /* Estilo general para campos de entrada y selección */
    .form-control {
        border: none;
        border-bottom: 1px solid #555; /* Gris oscuro */
        font-size: 14px;
        background-color: transparent;
        color: #dbe0e6; /* Color suave para texto */
        transition: border-bottom 0.3s ease, color 0.3s ease;
    }

    input,
    select {
        border: none;
        border-bottom: 1px solid #555; /* Gris oscuro */
        background-color: transparent;
        color: #dbe0e6; /* Color suave para texto */
        font-size: 14px;
    }

    /* Efecto cuando el campo tiene foco */
    .form-control:focus {
        outline: none !important;
        box-shadow: 0 0 10px rgba(0, 255, 255, 0.5); /* Sombra futurista azul turquesa */
        border-bottom: 2px solid #00bcd4; /* Azul futurista */
        color: #ffffff; /* Blanco cuando está enfocado */
    }

    input,
    select:focus {
        outline: none !important;
        box-shadow: 0 0 10px rgba(0, 255, 255, 0.5); /* Sombra futurista azul turquesa */
        border-bottom: 2px solid #00bcd4; /* Azul futurista */
        color: #ffffff; /* Blanco cuando está enfocado */
    }

    /* Estilo de los botones */
    .btn-azul {
        background-color: #00bcd4; /* Azul brillante */
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        color: #ffffff;
        height: 45px;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-azul:hover {
        background-color: #008c99; /* Azul más oscuro al pasar el ratón */
        transform: translateY(-2px); /* Efecto de elevación */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    /* Estilo del pie de página */
    footer {
        background-color: #1c1c1c; /* Gris muy oscuro */
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #dbe0e6; /* Color suave para texto */
        font-size: 14px;
    }

    .btn.btn-red {
        background: #f44336; /* Rojo vibrante */
        color: #ffffff;
        font-size: 14px;
        border-radius: 30px;
        padding: 10px 20px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn.btn-red:hover {
        background: #d32f2f; /* Rojo más oscuro al pasar el ratón */
        transform: translateY(-2px); /* Efecto de elevación */
    }
</style>

</head>

<body style="background-color: white; background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <!-- Outer Row -->
        <div class="row justify-content-center w-100">
            <div class="col-xl-8 col-lg-10 col-md-12">
                <div class="card o-hidden border-0 shadow-lg" style="max-width: 600px; border-radius: 20px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="img/c.gif" width="200" alt="Logo">
                                    </div><br>
                                    <form id="FormularioUno" class="form-horizontal form-material" method="POST">
                                        <div class="form-group">
                                            <input id="email" type="text" class="form-control" name="email" placeholder="Usuario" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
                                        </div>
                                        <button type="submit" class="btn btn-red btn-block" id="botonSolicitud" onclick="ejecuta();">Iniciar</button>
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


    <!-- Modal de Resultado de Sesion  -->
    <div id="divModalErrorLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="divModalErrorLoginTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="#divModalErrorLoginTitle"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Mensaje | MAKICOP</h5>
                </div>
                <div class="modal-body">
                    <p class="text-center" id="pNoIngreso"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i>&nbsp;&nbsp;Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Footer -->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.1.3.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        function ejecuta() {
            $("#FormularioUno").on("submit", function(event) {
                event.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("FormularioUno"));

                if ($("#email").val() == "" || $("#password").val() == "") {
                    $("#pNoIngreso").text("Favor de llenar los campos correspondientes.");
                    $("#divModalErrorLogin").modal('show');
                    return;
                }

                $.ajax({
                    url: "validaDatos.php",
                    type: "POST",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response, status, XHR) {
                        <?php #Aceptado 
                        ?>
                        if (XHR.status == 202) {
                            window.location.href = "acceso.php";
                            return;
                        }
                        $("#pNoIngreso").text("Hubo un error intente más tarde.");
                        $("#divModalErrorLogin").modal('show');
                    },
                    error: function(XHR) {
                        if (XHR.status == 401) {
                            $("#pNoIngreso").text("El Usuario/Contraseña no son válidos prueba.");
                            $("#divModalErrorLogin").modal('show');
                        } else {
                            $("#pNoIngreso").text("Hubo un error intente más tarde.");
                            $("#divModalErrorLogin").modal('show');
                        }
                    }
                });
            });
        }
    </script>
</body>

</html>