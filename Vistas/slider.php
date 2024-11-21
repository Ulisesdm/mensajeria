<?php
include '../session_validation.php';
$titulo_pagina = "Slider";
/*Cabecera y estilos */
include '../Complements/content_styles_header.php';
?>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-2">
            <h5>Slider</h5>
        </div>
        
    </div>
    <hr class="linea-row" style="border-top: 1px #292c33  outset;margin-top:4px;margin-left:1px;margin-right:1px;" />

    
    <!-- Tabs de Sliders -->
    <section class="tabbable">
        <ul class="nav nav-tabs" id="tabSlider" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tabPrincipal" data-toggle="tab" href="#sectionPrincipal" role="tab" aria-controls="sectionPrincipal" aria-selected="true" style="color: #051542 !important;">Principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabUnidades" data-toggle="tab" href="#sectionUnidades" role="tab" aria-controls="sectionUnidades" aria-selected="false" style="color: #051542 !important;">Unidades</a>
            </li>
        </ul>
    </section>
    <!-- Tabs de Sliders -->
    <main class="card shadow mb-4">
        <div class="card-body">
            <div class="tab-content">
            <section style="padding: 0%;" class="card-body tab-pane fade active show" id="sectionPrincipal">
                <h5 style="width: 100%; text-align:center;">Slider Principal</h5>
                <div class="mb-1 mt-1">
                    <input type="file" name="ImagenPrincipal" id="ImagenPrincipal" class="btn btn-secondary btn-sm" accept="image/png, image/jpeg, image/jpg" disabled>
                    <button class="btn btn-primary" id="buttonAgregarImagenPrincipal" disabled><i class="fa-solid fa-circle-plus"></i>&nbsp;Agregar</button>
                    <button class="btn btn-danger" id="buttonGuardarImagenPrincipal" disabled><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    &nbsp;&nbsp;Medidas recomendadas <b>(1520 x 750)px</b>
                </div>
                <div class="row" id="divSliderPrincipal">

                </div>
            </section>
            <!-- Section de Unidades -->
            <section style="padding: 0%;" class="card-body tab-pane fade" id="sectionUnidades">
                <h5 style="width: 100%; text-align:center;">Slider Unidades</h5>
                <div class="mb-1 mt-1">
                    <input type="file" name="ImagenUnidad" id="ImagenUnidad" class="btn btn-secondary btn-sm" accept="image/png, image/jpeg, image/jpg" disabled>&nbsp;&nbsp;
                    <button class="btn btn-primary" id="buttonAgregarImagenUnidad" disabled><i class="fa-solid fa-circle-plus"></i>&nbsp;Agregar</button>
                    <button class="btn btn-danger" id="buttonGuardarImagenUnidad" disabled><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                    &nbsp;&nbsp;Medidas recomendadas <b>(450 x 492)px</b>
                </div>
                <div class="row mt-1 mb-1" id="divSliderUnidades">

                </div>
            </section>
            <!-- Section de Unidades -->
            </div>
        </div>
    </main>
</div>
<?php
/*Script's JS y los terminos*/
include '../Complements/content_scriptJS.php';
?>

<!-- Resultado -->
<div id="Modalmen" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="far fa-images"></i>&nbsp;&nbsp;Slider | Confirmación</h5>
            </div>
            <div class="modal-body">
                <div id='mensaje' class="text-center"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="noconfirmar"><i class="far fa-times-circle"></i> CERRAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    const Controlador = "../Controllers/controller.slider.php";

    $(document).ready(function () {

        /* Obtener images de slider de unidades actuales */
        $.get(Controlador,
            {
                op: "ObtenerSlider",
                tipo: "Unidad"
            },
            function (Response, Status, XHR) {
                $("#divSliderUnidades").html(Response);

                /* Habilitar botones */
                $("#buttonAgregarImagenPrincipal").prop('disabled', false);
                $("#buttonGuardarImagenPrincipal").prop('disabled', false);
                $("#ImagenUnidad").prop('disabled', false);
            },
            "html"
        );
        /* Obtener images de slider de unidades actuales */

        /* Obtener images de slider de imagenes de Principal */
        $.get(Controlador,
            {
                op: "ObtenerSlider",
                tipo: "Principal"
            },
            function (Response, Status, XHR) {
                $("#divSliderPrincipal").html(Response);

                /* Habilitar botones */
                $("#buttonAgregarImagenUnidad").prop('disabled', false);
                $("#buttonGuardarImagenUnidad").prop('disabled', false);
                $("#ImagenPrincipal").prop('disabled', false);
            },
            "html"
        );
        /* Obtener images de slider de imagenes de Principal */

        /* Agregar Imagenes de Unidades */
        $("#buttonAgregarImagenUnidad").click(function (e) { 
            e.preventDefault();
            var file = document.getElementById("ImagenUnidad").files[0];
            var reader = new FileReader();

            reader.onload = function(e) {

                /* Genera el HTML y lo agrega al resto de imagenes */

                var i = 1;
                var id;
                $(".imagenUnidad").each(function (index, element) {
                    id = $(element).attr("id");
                    i = id.replace("numUnidad_","");
                    i++;
                });

                var html ="";
                html = 
                "<figure class=\"col-md-4\" id=\"imagenUnidad_"+i+"\">"+
                    "<img id=\"numUnidad_"+i+"\" src=\""+e.target.result+"\" class=\"imagenUnidad\" width=\"100%\">"+
                    "<figcaption style=\"width: 100%;text-align:center;\">"+
                        "<a onclick=\"EliminarSlider('Unidad','"+i+"')\">"+
                            "<i class=\"fa-solid fa-trash\" style=\"color: red;\"></i>"+
                        "</a>"+
                    "</figcaption>"+
                "</figure>";
                
                $("#divSliderUnidades").append(html);
                document.getElementById("ImagenUnidad").value = "";
            }

            reader.readAsDataURL(file);
        });
        /* Agregar Imagenes de Unidades */

        /* Agregar Imagenes de Principal */
        $("#buttonAgregarImagenPrincipal").click(function (e) { 
            e.preventDefault();
            var file = document.getElementById("ImagenPrincipal").files[0];
            var reader = new FileReader();

            reader.onload = function(e) {

                /* Genera el HTML y lo agrega al resto de imagenes */

                var i = 1;
                var id;
                $(".imagenPrincipal").each(function (index, element) {
                    id = $(element).attr("id");
                    i = id.replace("numPrincipal_","");
                    i++;
                });

                var html ="";
                html = 
                "<figure class=\"col-md-4\" id=\"imagenPrincipal_"+i+"\">"+
                    "<img id=\"numPrincipal_"+i+"\" src=\""+e.target.result+"\" class=\"imagenPrincipal\" width=\"100%\">"+
                    "<figcaption style=\"width: 100%;text-align:center;\">"+
                        "<a onclick=\"EliminarSlider('Principal','"+i+"')\">"+
                            "<i class=\"fa-solid fa-trash\" style=\"color: red;\"></i>"+
                        "</a>"+
                    "</figcaption>"+
                "</figure>";
                
                $("#divSliderPrincipal").append(html);
                document.getElementById("ImagenPrincipal").value = "";
            }

            reader.readAsDataURL(file);
        });
        /* Agregar Imagenes de Principal */

        /* Guardar Imagenes de Unidades */
        $("#buttonGuardarImagenUnidad").click(function (e) { 
            e.preventDefault();
            formData = new FormData();
            $(".imagenUnidad").each(function (index, element) {

                /* Obtener Numero */
                id = $(element).attr("id");
                id = id.replace("numUnidad_","");
                src = $(element).attr("src");

                formData.append("Imagenes[]", convert_64Blob(src), "cliente_"+id);

                
            });

            $.ajax({
                type: "POST",
                url: Controlador+"?op=AgregarSlider&tipo=Unidad",
                data: formData,
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function() {
                    $("#mensaje").text("Cargando...");
                    $("#Modalmen").modal("show");
                },
                success: function (response) {
                    $("#mensaje").text("Cambio hecho con éxito.");
                }
            });


        });
        /* Guardar Imagenes de Unidades */

        /* Guardar Imagenes de Principal */
        $("#buttonGuardarImagenPrincipal").click(function (e) { 
            e.preventDefault();
            formData = new FormData();
            $(".imagenPrincipal").each(function (index, element) {

                /* Obtener Numero */
                id = $(element).attr("id");
                id = id.replace("numPrincipal_","");
                src = $(element).attr("src");

                formData.append("Imagenes[]", convert_64Blob(src), "cliente_"+id);

                
            });

            $.ajax({
                type: "POST",
                url: Controlador+"?op=AgregarSlider&tipo=Principal",
                data: formData,
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function() {
                    $("#mensaje").text("Cargando...");
                    $("#Modalmen").modal("show");
                },
                success: function (response) {
                    $("#mensaje").text("Cambio hecho con éxito.");
                }
            });


        });
        /* Guardar Imagenes de Principal */
    });

    /* Eliminar Imagen de Slider Unidad/Principal */
    function EliminarSlider(Tipo,Id) {
        if(Tipo == 'Unidad'){
            $("#imagenUnidad_"+Id).remove();
        }else if(Tipo == 'Principal'){
            $("#imagenPrincipal_"+Id).remove();
        }
    }
    /* Eliminar Imagen de Slider Unidad/Principal */

    /*Convertir de 64bits a Blob */
    function convert_64Blob(dataURI) {
      var byteString = atob(dataURI.split(',')[1]);
      
      var ab = new ArrayBuffer(byteString.length);
      var ia = new Uint8Array(ab);
      var type_image = ((dataURI.split(',')[0]).replace("data:","")).replace(";base64","");
      
      for (var i = 0; i < byteString.length; i++) {
          ia[i] = byteString.charCodeAt(i);
      }
      return new Blob([ab], { type: type_image });
    }
    /*Convertir de 64bits a Blob */

</script>