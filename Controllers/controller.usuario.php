<?php
	include_once '../app/config.php';
	include_once '../Models/model.usuario.php';
    $usuario = new usuario();

    if(isset($_GET['op'])){
        $Op = $_GET['op'];
        switch ($Op) {

            /* Obtener todos los Usuarios */
            case 'listado':
                $Exec = $usuario->Get_Usuarios();
                $Response = array();


                while ($Row = mysqli_fetch_array($Exec)) {

                    /*Etiqueta de Status */
                    if($Row["Estatus"] == 1){
                        $Estatus = "<span class=\"badge bg-success\" style=\"color:white;\">Activo</span>";
                        $Opciones = "<a style=\"color:red;cursor:pointer;\" onclick=\"Estatus(".$Row["Id_Usuario"].",0)\"><i class=\"fa-regular fa-circle-xmark\"></i></a>&nbsp;&nbsp;<a style=\"color:#A58B12;cursor:pointer;\" onclick=\"Nuevo_Editar(".$Row["Id_Usuario"].")\"><i class=\"fa-solid fa-pen-to-square\"></i></a>";
                    }else{
                        $Estatus = "<span class=\"badge bg-danger\" style=\"color:white;\">Inactivo</span>";
                        $Opciones = "<a style=\"color:green;cursor:pointer;\" onclick=\"Estatus(".$Row["Id_Usuario"].",1)\"><i class=\"fa-regular fa-circle-up\"></i></a>";
                    }

                    $Response[] = array(
                        "Id_Usuario" => $Row["Id_Usuario"],
                        "Nombre" => stripslashes(utf8_decode($Row["Nombre"])),
                        "Login" => stripslashes(utf8_decode($Row["Login"])),
                        "Estatus" => $Estatus,
                        "Opciones" => $Opciones
                    );
                }

                if(count($Response) == 0){
                    echo json_encode(
                        array(
                            "Id_Usuario" => "",
                            "Nombre" => "",
                            "Login" => "",
                            "Estatus" => "",
                            "Opciones" =>  "",
                        )
                    );
                }else{
                    echo json_encode($Response);
                }

                
                header('Content-Type: application/json');
                
                exit;
                break;
            /* Obtener todos los Usuarios */

            /*Obtener Datos de un Usuario */
            case 'obtener':
                $Id_Usuario = @$_REQUEST['Id_Usuario'];
                $usuario->Id_Usuario = $Id_Usuario;
                $Exec = $usuario->Get_Usuario_Id();

                if(0<mysqli_num_rows($Exec)){
                    echo json_encode(array(
                        "Id_Usuario" => $usuario->Id_Usuario,
                        "Nombre" => stripslashes(utf8_decode($usuario->Nombre)),
                        "Login" => $usuario->Login,
                        "Perfil" => $usuario->Perfil
                    ));
                    header('Content-Type: application/json');
                    exit;
                }else{
                    http_response_code(404);
                    echo "Este usuario no existe";
                    exit;
                }

                break;
            /*Obtener Datos de un Usuario */

            /*Cambiar Estatus */
            case 'estatus':
                if($_POST){
                    $Id_Usuario = @$_POST['Id_Usuario'];
                    $Estatus = @$_POST['Estatus'];

                    $usuario->Id_Usuario = $Id_Usuario;
                    $usuario->Estatus = $Estatus;
                    $usuario->Set_Estatus_Id();

                }else{
                    echo "Metódo incorrecto.";
                    http_response_code(404);
                    exit;
                }
                break;
            /*Cambiar Estatus */

            /*Registrar Editar */
            case 'RegistrarEditar':
                if($_POST){

                    $Tipo = @$_POST["Tipo"];
                    $Id_Usuario = @$_POST["Id_Usuario"];
                    $Nombre = @$_POST["Nombre"];
                    $Login = @$_POST["Login"];
                    $Perfil = @$_POST["Perfil"];
                    $Clave_Seguridad = @$_POST["Clave_Seguridad"];


                    $usuario->Nombre = addslashes(utf8_encode($Nombre));
                    $usuario->Login = $Login;
                    $usuario->Perfil = $Perfil;

                    /*Edicion */
                    if($Tipo != "Nuevo"){

                        /*Actualizar Datos BD */
                        $usuario->Id_Usuario = $Id_Usuario;

                        if($Clave_Seguridad == "") $usuario->Update_DatosSinPass_Id();
                        else{
                            $usuario->Clave_Seguridad = addslashes(utf8_encode(sha1(md5($Clave_Seguridad))));
                            $usuario->Update_DatosConPass_Id();
                        }

                    }else{
                        $usuario->Clave_Seguridad = addslashes(utf8_encode(sha1(md5($Clave_Seguridad))));
                        $Exec = $usuario->Set_Usuario();
                        if($Row = mysqli_fetch_array($Exec)){
                            $Id_Usuario = $Row[0];
                        }else{
                            http_response_code(400);
                            exit;
                        }
                    }
                    
                }else{
                    echo "Metódo incorrecto.";
                    http_response_code(404);
                    exit;
                }
                break;
            /*Registrar Editar */

            /* Número de Usuarios */
            case 'Conteo':
                $Exec = $usuario->Get_Usuarios();
                echo mysqli_num_rows($Exec);
                break;
            /* Número de Usuarios */


            default:
                echo "Parámtetro incorrecto";
                http_response_code(404);
                exit;
                break;
        }
    }else{
        echo "Parámtetro faltante";
        http_response_code(404);
        exit;
    }
