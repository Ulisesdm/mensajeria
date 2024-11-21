<?php
	include_once '../app/config.php';
	include_once '../Models/model.cliente.php';
    $Cliente = new Cliente();

    if(isset($_GET['op'])){
        $Op = $_GET['op'];
        switch ($Op) {

            /* Obtener todos los clientes */
            case 'listado':
                $Exec = $Cliente->Get_Clientes();
                $Response = array();


                while ($Row = mysqli_fetch_array($Exec)) {

                    /*Etiqueta de Status */
                    if($Row["Estatus"] == 1){
                        $Estatus = "<span class=\"badge bg-success\" style=\"color:white;\">Activo</span>";
                        $Opciones = "<a style=\"color:red;cursor:pointer;\" onclick=\"Estatus(".$Row["Id_Cliente"].",0)\"><i class=\"fa-regular fa-circle-xmark\"></i></a>&nbsp;&nbsp;<a style=\"color:#A58B12;cursor:pointer;\" onclick=\"Nuevo_Editar(".$Row["Id_Cliente"].")\"><i class=\"fa-solid fa-pen-to-square\"></i></a>";
                    }else{
                        $Estatus = "<span class=\"badge bg-danger\" style=\"color:white;\">Inactivo</span>";
                        $Opciones = "<a style=\"color:green;cursor:pointer;\" onclick=\"Estatus(".$Row["Id_Cliente"].",1)\"><i class=\"fa-regular fa-circle-up\"></i></a>";
                    }

                    $Response[] = array(
                        "Id_Cliente" => $Row["Id_Cliente"],
                        "Nombre" => stripslashes(utf8_decode($Row["Nombre"])),
                        "Descripcion" => stripslashes(utf8_decode($Row["descripcion"])),
                        "Estatus" => $Estatus,
                        "Opciones" => $Opciones
                    );
                }

                if(count($Response) == 0){
                    echo json_encode(
                        array(
                            "Id_Cliente" => "",
                            "Nombre" => "",
                            "Descripcion" => "",
                            "Opciones" =>  "",
                        )
                    );
                }else{
                    echo json_encode($Response);
                }

                
                header('Content-Type: application/json');
                
                exit;
                break;
            /* Obtener todos los clientes */

            /*Obtener Datos de un Cliente */
            case 'obtener':
                $Id_Cliente = @$_REQUEST['Id_Cliente'];
                $Cliente->Id_Cliente = $Id_Cliente;
                $Exec = $Cliente->Get_Cliente_Id();

                /*Obtiene direccion de imagen */
                if(file_exists("../../img/cliente-carousel/cliente_{$Id_Cliente}.png")) $imagen = "../../img/cliente-carousel/cliente_{$Id_Cliente}.png";
                else if(file_exists("../../img/cliente-carousel/cliente_{$Id_Cliente}.jpg")) $imagen = "../../img/cliente-carousel/cliente_{$Id_Cliente}.jpg";
                else if(file_exists("../../img/cliente-carousel/cliente_{$Id_Cliente}.jpeg")) $imagen = "../../img/cliente-carousel/cliente_{$Id_Cliente}.jpeg";
                else $imagen = "";

                /*Si se encontro la imagen */
                if($imagen != ""){
                    $type_img = pathinfo($imagen, PATHINFO_EXTENSION); /*Obtener la extension del tipo de imagen*/
                    $image_archive = file_get_contents($imagen);/*Obtiene la imagen*/
                    $archivo = "data:image/".$type_img.';base64,'.base64_encode($image_archive);/*LO transforma a 64 bits*/
                }
                else $archivo = "";

                if(0<mysqli_num_rows($Exec)){
                    echo json_encode(array(
                        "Id_Cliente" => $Cliente->Id_Cliente,
                        "Nombre" => stripslashes(utf8_decode($Cliente->Nombre)),
                        "Descripcion" => stripslashes(utf8_decode($Cliente->Descripcion)),
                        "Imagen"=> $archivo
                    ));
                    header('Content-Type: application/json');
                    exit;
                }else{
                    http_response_code(404);
                    echo "Este cliente no existe";
                    exit;
                }

                break;
            /*Obtener Datos de un Cliente */

            /*Cambiar Estatus */
            case 'estatus':
                if($_POST){
                    $Id_Cliente = @$_POST['Id_Cliente'];
                    $Estatus = @$_POST['Estatus'];

                    $Cliente->Id_Cliente = $Id_Cliente;
                    $Cliente->Estatus = $Estatus;
                    $Cliente->Set_Estatus_Id();

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
                    $Id_Cliente = @$_POST["Id_Cliente"];
                    $Nombre = @$_POST["Nombre"];
                    $Descripcion = @$_POST["Descripcion"];

                    /*Ubicar Imagen en fichero */
                    if(isset($_FILES['Imagen'])){
                        $tipo_archivo   = $_FILES['Imagen']['type'];
                        $tamano_archivo = $_FILES['Imagen']['size'];
                        $tmp_archivo    = $_FILES['Imagen']['tmp_name'];
                        $ext = pathinfo($_FILES['Imagen']['name'], PATHINFO_EXTENSION);
                    }else $ext = "";

                    $Cliente->Nombre = addslashes(utf8_encode($Nombre));
                    $Cliente->Descripcion = addslashes(utf8_encode($Descripcion));
                    /*Edicion */
                    if($Tipo != "Nuevo"){

                        /*Actualizar Datos BD */
                        $Cliente->Id_Cliente = $Id_Cliente;
                        $Cliente->Update_Cliente_Datos_Id();

                    }else{
                       
                        $Exec = $Cliente->Set_Cliente();
                        if($Row = mysqli_fetch_array($Exec)){
                            $Id_Cliente = $Row[0];
                        }else{
                            http_response_code(400);
                            exit;
                        }

                    }

                    /* Poner Imagen */
                    if($ext!=""){
                        $dir= "../../img/cliente-carousel/cliente_{$Id_Cliente}.{$ext}";
                        if(is_file($dir)) unlink($dir);
                        move_uploaded_file($tmp_archivo,$dir);
                    }
                    
                }else{
                    echo "Metódo incorrecto.";
                    http_response_code(404);
                    exit;
                }
                break;
            /*Registrar Editar */

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
