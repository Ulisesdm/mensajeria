<?php

include_once '../app/config.php';
include_once '../Models/model.cliente.php';
$Cliente = new Cliente();

if (isset($_GET['op'])) {
    $Op = $_GET['op'];
    switch ($Op) {
        /* Obtener Descripcion de Una imagen representada del cliente */
        case 'descripcion':


            $Id_Cliente = @$_GET["Id_Cliente"];
            $Cliente->Id_Cliente = $Id_Cliente;
            $Exec = $Cliente->Get_Cliente_Id();
            if(0 == mysqli_num_rows($Exec)){
                http_response_code(404);
                exit;
            }

            $file = "../../img/cliente-carousel/cliente_{$Id_Cliente}";
            if (file_exists($file . ".png")) $imagen = $file . ".png";
            elseif (file_exists($file . ".jpeg")) $imagen = $file . ".jpeg";
            elseif (file_exists($file . ".jpg")) $imagen = $file . ".jpg";
            else $imagen = "";

            if($imagen != ""){
                $type_img = pathinfo($imagen, PATHINFO_EXTENSION); #Obtener la extension del tipo de imagen
                $image_archive = file_get_contents($imagen); #Obtiene la imagen
                $image = "data:image/" . $type_img . ';base64,' . base64_encode($image_archive); #LO transforma a 64 bits
            }

            echo json_encode(
                array(
                    "Nombre" => stripslashes(utf8_decode($Cliente->Nombre)),
                    "Descripcion" => stripslashes(utf8_decode($Cliente->Descripcion)),
                    "Image" => $image
                )
            );
            header('Content-Type: application/json');
            exit;

            break;
        default:
            echo "Parámtetro incorrecto";
            http_response_code(404);
            exit;
            break;
    }
} else {
    echo "Parámtetro faltante";
    http_response_code(404);
    exit;
}
