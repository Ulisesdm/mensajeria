<?php
include '../session_validation.php';
date_default_timezone_set('America/Mexico_City');
$titulo_pagina = "SOLICITUD DE MENSAJERIA";
/*Cabecera y estilos */
include '../Complements/content_styles_header.php';
$fechahoy = strftime('%Y-%m-%d %H:%M:%S', time() - 3600); 
?>
<div class="container-fluid">
                    <div id="lista">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>MENSAJERIA</h5>
                            </div>
                            <div class="col-md-8" align="right">
                            <a href="#" onclick="nuevo()" class="btn-futurista">
  <i class="fas fa-plus-circle"></i>&nbsp; NUEVO MENSAJE
</a>

<style>
  .btn-futurista {
    background-color: #72A0CA; /* Color de fondo */
    color: #fff; /* Color del texto */
    font-size: 16px; /* Tamaño de fuente */
    padding: 12px 20px; /* Espaciado interno */
    border-radius: 50px; /* Bordes redondeados */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease; /* Transición suave */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra suave */
    text-decoration: none; /* Sin subrayado */
    font-family: 'Arial', sans-serif;
  }

  .btn-futurista:hover {
    background-color: #4D7E9C; /* Color de fondo al pasar el cursor */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* Sombra más pronunciada */
    transform: translateY(-5px); /* Efecto de elevarse */
  }

  .btn-futurista i {
    margin-right: 8px; /* Espaciado entre el ícono y el texto */
    transition: transform 0.3s ease; /* Efecto de animación en el ícono */
  }

  .btn-futurista:hover i {
    transform: rotate(15deg); /* Rotar el ícono al pasar el cursor */
  }
</style>

                               
                            </div>
                        </div>
                        <hr class="colorhr">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table table-sm">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <div class="panel-body">
                                                <div id="list">
                                                    <table id="jqGrid"></table>
                                                    <div id="jqGridPager" style="height: 40px; width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

  

                   
                </form>
            </section>
            <!-- Formulario -->
            <div class="formulario" id="formulario" style="display: none">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>SOLICITUD DE MENSAJERIA</h5>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <hr class="colorhr">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table table-sm">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <form id="FormularioCliente" enctype="multipart/form-data" method="POST"
                                                role="form">
                                                <div class="row">
                                                    <input type="hidden" id="id_val" name="id_val" />
                                                    <input type="hidden" id="fecha_alt" name="fecha_alt"  />
                                                    <table class="table table-borderless">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th   scope="col"></th>
      <th style="width: 33%;" scope="col"><div class="col-xl-12">
     
                                                
     <div class="input-group-prepend">
         <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
         <input type="input" name="fecha" id="fecha" class="form-control"  value="<?php echo $fechahoy ?>"  required>
     </div>
     <label class="letra">FECHA </label>
 </div</th>
    </tr>
  </thead>
  <tbody>
   
 
    <tr>
      <th colspan="2" style="width: 33%;" scope="row"><div class="col-xl-12">
                                                    <div class="input-group-prepend" >
                                                        <span class="input-group-text" style="color:dimgrey; border: none;" id="inputGroupPrepend2"><i class="fa fa-map-marker"></i></span>
                                                        <select  class="form-control" name="solicitud" id="solicitud">
                                                            <option value="">SELECCIONE SOLICITUD</option>
                                                            <option value="ENTREGA">ENTREGA</option>
                                                            <option value="RECOLECTAR">RECOLECTAR</option> 
                                                            <option value="DEPOSITO BANCARIO">DEPOSITO BANCARIO</option> 
                                                            <option value="MENSAJERIA INTERNA">MENSAJERIA INTERNA</option> 
                                                     </select>
                                                    </div>
                                                    <label for="" class="letra"><b>TIPO DE SOLICITUD</b></label>
                                                </div></th>
      
      <th  style="width: 33%;"><div class="col-xl-12">
                        <div class="input-group-prepend">
                            <input type="text" value="" style="resize: none;" class="form-control" id="contacto" name="contacto" placeholder="Contacto" rows="5" required>
</input>
                        </div>
                        <label for="" class="letra"><b> NOMBRE DE CONTACTO</b> </label>
                    </div></th>

                    <th  style="width: 33%;"><div class="col-xl-12">
                        <div class="input-group-prepend">
                            <input type="number" value="" style="resize: none;" class="form-control" maxlength="10" id="telefono" name="telefono"  pattern="[0-9]+" placeholder="TELEFONO" rows="5" required  oninput="validarNumeros(this)">
</input>
                        </div>
                        <label for="" class="letra"><b>TELEFONO</b> </label>
                    </div></th>
      
    </tr> 
   
      
    
    <tr>
      
      <th colspan="3"><div  class="col-xl-12">
                        <div class="input-group-prepend">
                            <textarea  cols="40" rows="2" style="resize: both; type="text" class="form-control" id="descripcion" name="descripcion"   required><?php echo $valor ?>     </textarea>
                        </div>
                        <label for="" class="letra"><b>DESCRIPCION</b> </label>
                    </div></th>
      
      
      <td></td>
    </tr>
    <tr>
      <th colspan="2" scope="row"><div class="col-xl-12">
                        <div class="input-group-prepend">
                            <input type="text"  style="resize: none;" class="form-control" id="diligencia" name="diligencia" placeholder="Diligencia" rows="5" required>
                        </input>
                        </div>
                        <label for="" class="letra"><b>DILIGENCIA REALIZADA POR</b> </label>
                    </div></th>
      <td></td>
      <td></td>
    </tr>
    <tr>
 
      <th colspan="3" scope="row"><div class="col-xl-12">
                        <div class="input-group-prepend">
                            <textarea cols="40" rows="2" style="resize: both; type="text" value="" style="resize: none;" class="form-control" id="observaciones" name="observaciones"  rows="5" required><?php echo $valor ?>    </textarea>
                        </div>
                        <label for="" class="letra"><b>OBSERVACIONES</b> </label>
                    </div></th>
      <td></td>
    </tr>
    <td></td>
  </tbody>
</table>

                                               
                    
          

                                                    <div class=" col-md-12" align="right">
                                                        <button type="reset" class="btn btn-default"
                                                        href='Administracion/index.php'  id="botoncancelar"> <span
                                                                class="fa fa-reply" aria-hidden="true"></span>
                                                            Listado</button>
                                                        <button style=" background-color: #72A0CA;" type="submit" class="btn btn-primary"
                                                            onclick="guardar();" id="botonguardar"> <span
                                                                class="far fa-check-circle" aria-hidden="true"></span>
                                                            Guardar</button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="validarUpdate()" style="display: none"
                                                            id="botoneditar"> <span class="fas fa-redo"></span>
                                                            Actualizar</button>
                                                    </div>
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
        </div>
    </div>




            <!-- Tabla -->
            <div id="divTabla">
                <section class="panel panel-primary">
                    <div class="panel-body">
                        <table id="jqGrid"></table>
                        <div id="jqGridPager"></div>
                    </div>
                </section>
            </div>
            <!-- Tabla -->
        </section>
    </main>
</div>
<?php
/*Script's JS y los terminos*/
include '../Complements/content_scriptJS.php';
?>

<!-- Resultado de CRUD de Producto -->
<div id="Modalmen" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-user-tie"></i>&nbsp;&nbsp;Clientes | Confirmación</h5>
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
<div id="Modalcon" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" align="center">CLIENTES</h4>
                </div>
                <div class="modal-body">
                    <div id='mensajecon' align="center"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="no-con"><i
                            class="far fa-times-circle"></i> No</button>
                            <button class="btn btn-primary" id="confirmardelete" onclick="eliminar()" data-dismiss="modal"><i
                            class="far fa-check-circle"></i> SI</button>
                
                    <button class="btn btn-primary" id="confirmarupdate" onclick="editar(id)" data-dismiss="modal"><i
                            class="far fa-check-circle"></i> SI</button>
                    <button class="btn btn-primary" id="confirmarupdates" onclick="guardaredit()"
                        data-dismiss="modal"><i class="far fa-check-circle"></i> SI</button>
                </div>
            </div>
        </div>
    </div>
<script>


function generar_excel(id) {
    $.ajax({
        type: "GET",
        url: "../Controllers/reportepdf.php?id=" + id,
        dataType: "text",
        beforeSend: function() {},
        success: function(r) {
            window.open("../GuiasR/" + id + ".pdf", "_blank"); 
        }
    });
}

function nuevo(x) {

$("#FormularioCliente")[0].reset();
$("#formulario").show();
$("#lista").hide();
$("#botoneditar").hide();
$("#botonguardar").show();
$("#rfc").prop("readonly", false);


}

function cancelar(x) {

$("#formulario").hide();
$("#lista").show();


}
    const Controlador = "../Controllers/controller.cliente.php";

    $(document).ready(function(a) {

$("#jqGrid").jqGrid({
    url: '../Controllers/controller.listmensajes.php',
    datatype: "json",
    styleUI: 'Bootstrap',
    height: 280,
    rowList: [5, 10, 15],
    colModel: [{
            label: 'ID',
            name: 'id',
            hidden: true,
            key: true
        },
        {
            label: 'Folio',
            name: 'id',
            autowidth: true
        },
       
        {
            label: 'Tipo de Solicitud',
            name: 'solicitud',
            autowidth: true
        },
        {
            label: 'Descripcion',
            name: 'descripcion',
            autowidth: true
        },
        {
            label: 'Contacto',
            name: 'contacto',
            autowidth: true
        },
        {
            label: 'Fecha',
            name: 'fecha',
            autowidth: true
        },
     
        {
            label: 'Opciones',
            name: 'opciones',
            autowidth: true
        },

    ],
    viewrecords: true, // show the current page, data rang and total records on the toolbar
    autowidth: true,
    height: 390,
    rowNum: 10,
    sortname: 'id',
    gridview: true,
    altclass: 'myAltRowClass',
    loadonce: true,
    pager: "#jqGridPager",
});
$("#jqGrid").jqGrid('filterToolbar', {
    stringResult: true,
    searchOnEnter: false,
    autosearch: true
});

$(".ui-pg-selbox").removeClass("ui-pg-selbox");
$(".glyphicon-backward").addClass("fa fa-chevron-left");
$(".fa-chevron-left").removeClass("glyphicon-backward");

$(".glyphicon-forward").addClass("fa fa-chevron-right");
$(".fa-chevron-right").removeClass("glyphicon-forward");

$(".glyphicon-step-backward").addClass("fa fa-step-backward");
$(".fa-step-backward").removeClass("glyphicon-step-backward");

$(".glyphicon-step-forward").addClass("fa fa-step-forward");
$(".fa-step-forward").removeClass("glyphicon-step-forward");

$("#jqGridPager_center").css("width", "400px");

$('#modal_direcciones').on('shown.bs.modal', function() {
    $("#jqGrid2").setGridWidth($('#home').width());
});

});

    /*Editar o Crear un Cliente */
    function Nuevo_Editar(Id_Cliente = null) {

        /* Nuevo Cliente */
        if (Id_Cliente == null || Id_Cliente == 0) {

            $("#Tipo").val("Nuevo");
            $("#botoneditar").hide();
            $("#botonnuevo").show();

        } else {
            /*Editar Cliente */

            $.get(Controlador, {
                    op: "obtener",
                    Id_Cliente: Id_Cliente
                },
                function(Response, Status, XHR) {

                    $("#Id_Cliente").val(Response.Id_Cliente);
                    $("#Descripcion").val(Response.Descripcion);
                    $("#Nombre").val(Response.Nombre);

                    /*Mostrar Vista previa de Imagen  Si es que la hay*/
                    if (Response.Imagen != "") {
                        $("#img").attr("src", Response.Imagen);
                        $("#divImagenText").hide();
                        $("#divImagenForm").show();
                    }

                    $("#Tipo").val("Actualizar");
                    $("#botonnuevo").hide();
                    $("#botoneditar").show();
                },
                "json"
            ).fail(function(XHR) {
                return;
            });

        }

        $("#divTabla").hide();
        $("#divFormulario").show();

    }
    

    /*Editar o Crear un Cliente */

    /*Regresar a la tabla */
    function cancelar() {
        $("#divFormulario").hide();
        $("#divTabla").show();

        $("#img").removeAttr("src");
        $("#divImagenForm").hide();
        $("#divImagenText").show();
    }
    /*Regresar a la tabla */

    /*Cambiar Estatus */
    function Estatus(Id_Cliente, Estatus) {
        $.post(Controlador + "?op=estatus", {
                Id_Cliente: Id_Cliente,
                Estatus: Estatus
            },
            function(Response, Status, XHR) {
                $("#jqGrid").setGridParam({
                    datatype: 'json',
                    page: 1
                }).trigger('reloadGrid');
            },
            "html"
        );
    }
    /*Cambiar Estatus */

    /* Mostrar vista previa de la imagen*/
    $("#Imagen").change(function(e) {
        e.preventDefault();
        var file = document.getElementById($(this).attr("id")).files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $("#img").attr("src", e.target.result);
        }
        $("#divImagenText").hide();
        $("#divImagenForm").show();
        reader.readAsDataURL(file);
    });
    /* Mostrar vista previa de la imagen*/

    function validarUpdate() {
        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        var f = document.forms["FormularioCliente"]["fecha"].value;
        var g = document.forms["FormularioCliente"]["solicitud"].value;
        var h = document.forms["FormularioCliente"]["contacto"].value;
        var i = document.forms["FormularioCliente"]["descripcion"].value;
        var j = document.forms["FormularioCliente"]["diligencia"].value;
        var k = document.forms["FormularioCliente"]["observaciones"].value;
         var l = document.forms["FormularioCliente"]["telefono"].value;
     
        if (f == "") {
            $("#mtituvalidar").css({
                "background-color": "#d9534f",
                "font-weight": "bold",
                "color": "white"
            });
            $("#mensajevalidar").html("Debe escoger la fecha");
            $("#ModalValidar").modal("show");
            document.getElementById("fecha").style.borderColor = "red";
        } else if (g == "") {
            $("#mtituvalidar").css({
                "background-color": "#d9534f",
                "font-weight": "bold",
                "color": "white"
            });
            $("#mensajevalidar").html("Debe escoger la solicitud");
            $("#ModalValidar").modal("show");
            document.getElementById("solicitud").style.borderColor = "red";
        } else if (h == "") {
            $("#mtituvalidar").css({
                "background-color": "#d9534f",
                "font-weight": "bold",
                "color": "white"
            });
            $("#mensajevalidar").html("Escribe el contacto");
            $("#ModalValidar").modal("show");
            document.getElementById("contacto").style.borderColor = "red";
        } else if (i == "") {
            $("#mtituvalidar").css({
                "background-color": "#d9534f",
                "font-weight": "bold",
                "color": "white"
            });
            $("#mensajevalidar").html("Falta la descripcion");
            $("#ModalValidar").modal("show");
            document.getElementById("descripcion").style.borderColor = "red";
        } else if(j == "")
        {
        	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
        	$("#mensajevalidar").html("falta la diligencia");
        	$("#ModalValidar").modal("show");
        	document.getElementById("diligencia").style.borderColor = "red";
        }else if(k == "")
        {
        	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
        	$("#mensajevalidar").html("falta la observaciones");
        	$("#ModalValidar").modal("show");
        	document.getElementById("observaciones").style.borderColor = "red";
        }
        else if (l == "") {
            $("#mtituvalidar").css({
                "background-color": "#d9534f",
                "font-weight": "bold",
                "color": "white"
            });
            $("#mensajevalidar").html("Escribe el Telefono");
            $("#ModalValidar").modal("show");
            document.getElementById("telefono").style.borderColor = "red";
        } 
   
        else {
            modal(2);
        }
    }

    function descpdf(id){

//var id =$("#jqGrid").jqGrid('getGridParam','selrow');
var ret = $("#jqGrid").jqGrid('getRowData',id);
var u= ret.folio_fiscal;

var concepto=ret.folioconcepto;
var folio=ret.folio_fiscal;


if ((folio!="" || folio!=null) && (concepto=="" || concepto==null)){

  visualizarArchivo(ret.folio_fiscal);
  return false;

}

var tipo= ret.tipo_documento;//agregado nuevo

var parametros = {"id" : id,  "folio" : u };
r="../controllers/controller.funcion_MPDF.php";
console.log(id+'|'+u);
// if(id){
 $.ajax({
    data:  parametros,
    url:   r,
    type:  'post',
    async: false,
    // beforeSend: function () {
    //      $('#myModalMensajes').modal('show');
    //      $('#mensaje10').text("Procesando pdf, espere por favor...");
    // },
    success:  function (response) {
     // console.log(response);
      var dato=ret.folio_fiscal;
      visualizarArchivo(dato);
      // downloadpdf(dato);
    }

});
//}else{
//alert("Seleccione un registro");
//}
}

///para descargar el pdf
function descpdf2(id){

//var id =$("#jqGrid").jqGrid('getGridParam','selrow');
var ret = $("#jqGrid").jqGrid('getRowData',id);
var u= ret.folio_fiscal;

var tipo= ret.tipo_documento;//agregado nuevo

var parametros = {"id" : id };
r="../controllers/controller.funcion_MPDF.php";
console.log(id);
// if(id){
 $.ajax({
    data:  parametros,
    url:   r,
    type:  'post',
    async: false,
});
//}else{
//alert("Seleccione un registro");
//}
}

function validarNumeros(input) {
        // Permite solo números y limita a un máximo de 11 caracteres
        input.value = input.value.replace(/[^0-9]/g, '').substring(0, 10);

    }

   
function guardar() {
        $("#FormularioCliente").on("submit", function(e) {
            e.preventDefault();
            //var f = $(this);
            var formData = new FormData(document.getElementById("FormularioCliente"));
            formData.append("dato", "valor");
            $.ajax({
                url: "../Controllers/controller.registarmensaje.php",
                type: "POST",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res) {
                console.log(res);
                if (res == "1") {
                    $("#formulario").hide();
                    $("#lista").show();
                    $("#mensaje").html("El mensaje ha sido registrado"); //texto que lleva la modal
                    $('#jqGrid').jqGrid('setGridParam', {
                        url: '../Controllers/controller.listacotizaciones.php',
                        datatype: 'json',
                        type: 'POST'
                    }).trigger('reloadGrid');
                    $("#FormularioCliente")[0].reset();
                    $("#Modalmen").modal("show");
                    location.reload();
                } else {
                    $("#mtitu").css({
                        "background-color": "#d9534f",
                        "font-weight": "bold",
                        "color": "white"
                    });
                    $("#mensaje").html("Ocurrio un error, El mensaje no se registro");
                    $("#Modalmen").modal("show");
                }
            });

           e.preventDefault(); //stop default action
         
        });
    }

    function editar(id) {
        var grid = $("#jqGrid");
        var ret = grid.jqGrid('getGridParam', "selrow",id);
        $("#botoneditar").show();
        $("#botonguardar").hide();
        $("#formulario").show();
        $("#lista").hide(); 
        $("#rfc").prop("readonly", true);

        if (ret != null) {
            $.getJSON('../Controllers/controller.buscardatosmensaje.php?id=' + ret,
                function(data) {
                    $.each(data, function(objeto, item) {

                        $('#fecha').val(item.fecha);
                        $('#solicitud').val(item.solicitud);
                        $('#contacto').val(item.contacto);
                        $('#telefono').val(item.telefono);
                        $('#descripcion').val(item.descripcion);
                        // $('#genesis').val(item.cliente);
                        // $('#comboDestino3').val(item.direccion);
                        $('#diligencia').val(item.diligencia);
                        $('#observaciones').val(item.observaciones);


                        var estado = item.estado;
                        var muni = item.municipio;
                        var cp = item.codigopostal;
                        var colonia = item.colonia;

                        if (estado) {

                            $.ajax({
                                type: 'POST',
                                url: '../Controllers/controller.fillCombosEstadosMunicipios2.php',
                                data: 'estadoupdate=' + estado,
                                success: function(update) {

                                    $('#resMunicipios').html(update);

                                    function setSelectValue(id, val) {
                                        document.getElementById(id).value = val;
                                    }
                                    setSelectValue('resMunicipios', muni);


                                    if (estado && muni) {

                                        $.ajax({
                                            type: 'POST',
                                            url: '../Controllers/controller.fillCombosEstadosMunicipios2.php',
                                            data: 'municipioupdate=' + muni +
                                                '&estadomunupdate=' + estado,
                                            success: function(update2) {
                                                $('#resCodigoPostal').html(update2);

                                                function setSelectValue(id, val) {
                                                    document.getElementById(id)
                                                        .value = val;
                                                }
                                                setSelectValue('resCodigoPostal',
                                                    cp);

                                                if (cp) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '../Controllers/controller.fillCombosEstadosMunicipios2.php',
                                                        data: 'codigopostalupdate=' +
                                                            cp,
                                                        success: function(
                                                            update3) {
                                                            console.log(
                                                                colonia
                                                            );
                                                            console.log(
                                                                update3
                                                            );

                                                            $('#resColonia')
                                                                .html(
                                                                    update3
                                                                );

                                                            function setSelectValue(
                                                                id, val
                                                            ) {
                                                                document
                                                                    .getElementById(
                                                                        id
                                                                    )
                                                                    .value =
                                                                    val;
                                                            }
                                                            setSelectValue
                                                                ('resColonia',
                                                                    colonia
                                                                );

                                                        }
                                                    });
                                                }

                                            }
                                        });
                                    }

                                }
                            });
                        }
                    });
                });
        } else {
            $("#mtitu").css({
                "background-color": "#d9534f",
                "font-weight": "bold",
                "color": "white"
            });
            // $("#mensaje").html("Debe seleccionar una fila para editar");
            // $("#Modalmen").modal("show");
        }
    }


    function guardaredit() {
        var grid = $("#jqGrid");
        var ret = grid.jqGrid('getGridParam', "selrow");

        var formData = new FormData(document.getElementById("FormularioCliente"));


        //e.preventDefault();
        formData.append("id", ret);

        $.ajax({
            url: "../Controllers/controller.editarmensaje.php?id=" + ret,
            type: "POST",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(res) {
            if (res == 1) {
                $("#formulario").hide();
                $("#lista").show();
                $("#mtitu").css({
                    "background-color": "#3173ac",
                    "font-weight": "bold",
                    "color": "white"
                });
                $("#mensaje").html("el mesaje se ha editado correctamente");
                $('#jqGrid').jqGrid('setGridParam', {
                    url: '../Controllers/controller.listacotizaciones2.php',
                    datatype: 'json',
                    type: 'POST'
                }).trigger('reloadGrid');
                $("#FormularioCliente")[0].reset();
                $("#Modalmen").modal("show");
                $("#botoneditar").hide();
                $("#botonguardar").show();
            } else {
                $("#mtitu").css({
                    "background-color": "#d9534f",
                    "font-weight": "bold",
                    "color": "white"
                });
                $("#mensaje").html("Ocurrio un error, el mesaje no se pudo editar");
                $("#Modalmen").modal("show");
            }
        });



    }
    
    $('#Modalmen').on('hidden.bs.modal', function() {
        location.reload();
    })

    function modal(x) {
        var inde = x;
        //alert(inde)
        var grid = $("#jqGrid");
        var ret = grid.jqGrid('getGridParam', "selrow");
        if (ret != null) {
            if (inde == 1) {
                //$("#confirmarupdate").show();
                //$("#confirmardelete").hide();
                //$("#modalwarning").css({"background-color":"#3173ac","font-weight":"bold","color":"white"});
                //$("#mensajecon").html("¿Está seguro de Editar ésta Fila?");
                //$("#Modalcon").modal("show");
                editar();


            } else if (inde == 0) {
                $("#confirmarupdate").hide();
                $("#confirmardelete").show();
                $("#confirmarupdates").hide();
                $("#modalwarning").css({
                    "background-color": "#d9534f",
                    "font-weight": "bold",
                    "color": "white"
                });

                $("#mensajecon").html("¿Está seguro de Eliminar ésta Fila?");
                $("#Modalcon").modal("show");
            } else if (inde == 2) {


                $("#confirmarupdates").show();
                $("#confirmardelete").hide();
                $("#confirmarupdate").hide();
                $("#modalwarning").css({
                    "background-color": "#3173ac",
                    "font-weight": "bold",
                    "color": "white"
                });
                $("#mensajecon").html("¿Está seguro de Actualizar la Información?");
                $("#Modalcon").modal("show");



            }
        } else {
            //$("#mtitu").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
            // $("#mensaje").html("Debe seleccionar una fila para continuar");
            // $("#Modalmen").modal("show");
        }
    }

    function eliminar() {
        var grid = $("#jqGrid");
        var ret = grid.jqGrid('getGridParam', "selrow");
        if (ret != null) {
            $.ajax({
                url: "../Controllers/controller.eliminarmensaje.php?id=" + ret,
                type: "POST",
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res) {
                if (res == "1") {
                    $("#mensaje").html("El mensaje ha sido borrado");
                    $("#Modalmen").modal("show");
                    $('#jqGrid').jqGrid('setGridParam', {
                        url: '../Controllers/controller.listacotizaciones2.php',
                        datatype: 'json',
                        type: 'POST'
                    }).trigger('reloadGrid');
                } else {
                    $("#mensaje").html("Ocurrio un error, El mensaje no se pudo borrar");
                    $("#Modalmen").modal("show");
                }
            });
        }
    }

    
</script>
