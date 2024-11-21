<?php
if (isset($_GET['op'])) {
    $Op = $_GET['op'];
    switch ($Op) {

            /*Obtener cuerpo HTML de los sliders */
        case 'ObtenerSlider':
            $Slider =  $_REQUEST['tipo'];
            $dir = "../../img/";
            switch ($Slider) {
                    /* Parametros para obtener las imagenes del slider de unidades */
                case 'Unidad':
                    $dir .= "carousel-unidades/";
                    $class = "col-md-4";
                    $nombre = "Unidad";
                    break;
                case 'Principal':
                    $dir .= "carousel-principal/";
                    $class = "col-md-6";
                    $nombre = "Principal";
                    break;
                default:
                    echo "Parámtetro incorrecto";
                    http_response_code(404);
                    exit;
                    break;
            }


            /*Muestra el cuerpo HTML */
            if ($handler = opendir($dir)) {
                $i = 1;
                while (false !== ($file = readdir($handler))) {
                    if (
                        strpos($file, ".jpg") || strpos($file, ".JPG") ||
                        strpos($file, ".jpeg") || strpos($file, ".JPEG") ||
                        strpos($file, ".png") || strpos($file, ".PNG")
                    ) /*Solo las imagenes con la extension a verificar*/ {
                        $type_img = pathinfo($dir . "/" . $file, PATHINFO_EXTENSION); /*Obtener la extension del tipo de imagen*/
                        $image_archive = file_get_contents($dir . "/" . $file); /*Obtiene la imagen*/
                        $image = "data:image/" . $type_img . ';base64,' . base64_encode($image_archive); /*LO transforma a 64 bits*/
?>
                        <figure class="<?= $class ?>" id="imagen<?=$nombre?>_<?= $i ?>">
                            <img src="<?= $image ?>" id="num<?=$nombre?>_<?= $i ?>" class="imagen<?=$nombre?>" width="100%">
                            <figcaption style="width: 100%;text-align:center;"><a onclick="EliminarSlider('<?=$nombre?>','<?= $i ?>')"><i class="fa-solid fa-trash" style="color: red;"></i></a></figcaption>
                        </figure>
<?php
                        $i++;
                    }
                }
            }
            /*Muestra el cuerpo HTML */

            break;
            /*Obtener cuerpo HTML de los sliders */

        case 'AgregarSlider':
            $Slider =  $_GET['tipo'];
            $dir = "../../img/";

            switch ($Slider) {
                    /* Parametros para obtener las imagenes del slider de unidades */
                case 'Unidad':
                    $dir .= "carousel-unidades/";
                    $nombre = "cliente";
                    break;
                case 'Principal':
                    $dir .= "carousel-principal/";
                    $nombre = "principal";
                    break;
                default:
                    echo "Parámtetro incorrecto";
                    http_response_code(404);
                    exit;
                    break;
            }

            /* Registrar Imagenes para el slider */
            if (isset($_FILES['Imagenes'])) {
                $size = count($_FILES['Imagenes']['name']);/* Obtener número de imagenes que se van a cargar */

                /* crea el directorio si no existe */
                if (!is_dir($dir)) {
                    mkdir($dir, 0777);
                }

                /* Borra los archivos del fichero */
                foreach (glob($dir . "/*") as $archive) {
                    if (is_file($archive)) unlink($archive);
                }

                /* Inserta las imagenes */
                for ($i = 0; $i < $size; $i++) {

                    $name_Imagenes = $_FILES['Imagenes']['name'][$i];
                    $temp_Imagenes = $_FILES['Imagenes']['tmp_name'][$i];
                    $type_Imagenes = $_FILES['Imagenes']['type'][$i];

                    /* Pone la extención */
                    switch (true) {
                        case (strpos($type_Imagenes, 'jpeg') !== false) || (strpos($type_carousel, 'jpg') !== false):
                            $ext_Imagenes = "jpg";
                            break;
                        case (strpos($type_Imagenes, 'png') !== false):
                            $ext_Imagenes = "png";
                            break;
                        default:
                            $ext_Imagenes = "jpg";
                            break;
                    }

                    /* Guarda el archivo */
                    move_uploaded_file($temp_Imagenes,($dir."/".$nombre."_".($i+1).".".$ext_Imagenes));
                }
            }
            /* Registrar Imagenes para el slider */

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
?>