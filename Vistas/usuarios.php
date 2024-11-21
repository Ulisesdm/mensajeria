<?php
include '../session_validation.php';
$titulo_pagina = "Usuarios";
/*Cabecera y estilos */
include '../Complements/content_styles_header.php';
?><div class="container-fluid">
<div id="lista">
    <div class="row">
        <div class="col-md-4">
            <h5>USUARIOS</h5>
        </div>
        <div class="col-md-8" align="right">
            <a href="#" onclick="nuevo()" style=" background-color: #72A0CA;" class="btn btn-primary"><i
                    class="fas fa-plus-circle"></i>&nbsp; NUEVO USUARIO</a>
            <!-- <a href="#" onclick="modal(1)" class="btn btn-secondary"><i
                    class="far fa-pencil-square-o"></i>&nbsp; EDITAR</a>
            <a href="#" onclick="modal(0)" class="btn btn-danger"><i
                    class="fa fa-minus-circle"></i>&nbsp; ELIMINAR</a> -->
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
            <h5>REGISTRO DE USUARIO</h5>
        </div>
        <div class="col-md-4"></div>
    </div><br>
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
                                <input type="hidden" id="fecha_alt" name="fecha_alt" />
                                <article class="col-xl-6">
                        <div class="input-group-prepend">
                            <input type="hidden" name="Tipo" id="Tipo" required>
                            <input type="hidden" name="Id_Usuario" id="Id_Usuario" required>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                        <label for="" class="letra"><b>Nombre</b> </label>
                    </article>
                    <article class="col-xl-6">
                        <div class="input-group-prepend">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        </div>
                        <label for="" class="letra"><b>Contraseña</b> </label>
                    </article>
                    <article class="col-xl-6">
                        <div class="input-group-prepend">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmar Contraseña" required>
                        </div>
                        <label for="" class="letra"><b>Confirmar Contraseña</b> </label>
                    </article>
                    <article class="col-xl-6">
                        <div class="input-group-prepend">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <label for="" class="letra"><b>Email</b> </label>
                    </article>
                    <article class="col-xl-6">
                        <div class="input-group-prepend">
                            <select class="form-control" name="perfil" id="perfil">
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>
                        <label for="" class="letra"><b>Perfil</b> </label>
                    </article>



                                <div class=" col-md-12" align="right">
                                    <button type="reset" class="btn btn-default"
                                        onclick="cancelar();" id="botoncancelar"> <span
                                            class="fa fa-reply" aria-hidden="true"></span>
                                        Listado</button>
                                    <button type="submit" class="btn btn-primary" style=" background-color: #72A0CA;"
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
<article class="panel-body">
    <table id="jqGrid"></table>
    <div id="jqGridPager"></div>
</article>
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

<script>

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
            $("#mensaje").html("Debe seleccionar una fila para continuar");
            $("#Modalmen").modal("show");
        }
    }
const Controlador = "../Controllers/controller.cliente.php";

$(document).ready(function(a) {

$("#jqGrid").jqGrid({
url: '../Controllers/controller.listausuario.php',
datatype: "json",
styleUI: 'Bootstrap',
height: 280,
rowList: [5, 10, 15],
colModel: [
    {
label: 'ID',
name: 'id',
hidden: true,
key: true
},
{
label: 'Nombre',
name: 'nombre',
autowidth: true
},
{
label: 'Login',
name: 'email',
autowidth: true
},

{
label: 'Estatus',
name: 'estatus',
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

var f = document.forms["FormularioCliente"]["solicitud"].value;
var g = document.forms["FormularioCliente"]["fecha"].value;
var h = document.forms["FormularioCliente"]["contacto"].value;
// var i = document.forms["FormularioCliente"]["descripcion"].value;
var j = document.forms["FormularioCliente"]["diligencia"].value;
// var k = document.forms["FormularioCliente"]["observaciones"].value;




// if (a.length < 12)
// {

// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("RFC Incorrecto");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("rfc").style.borderColor = "red";
// }else if (a == "")
// {
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Debe llenar el campo rfc");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("razonsocial").style.borderColor = "red";
// }else if (b == "")
// {
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Debe llenar el campo razon social");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("razonsocial").style.borderColor = "red";
// }else if(c == "")
// {
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Debe llenar el campo teléfono");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("telefono").style.borderColor = "red";
// }else if(c.length != 10)
// {
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Campo teléfono incorrecto");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("telefono").style.borderColor = "red";
// }
// else if(d == ""){
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Debe llenar el campo email");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("email").style.borderColor = "red";
// }
// else if(expr.test(d)==false){
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Email Incorrecto");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("email").style.borderColor = "red";
// }
// if(e == "")
// {
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Debe llenar el campo pais");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("pais").style.borderColor = "red";
if (f == "") {
$("#mtituvalidar").css({
"background-color": "#d9534f",
"font-weight": "bold",
"color": "white"
});
$("#mensajevalidar").html("Debe escoger tipo de solicitud");
$("#ModalValidar").modal("show");
document.getElementById("solicitud").style.borderColor = "red";
}else if (g == "") {
    $("#mtituvalidar").css({
        "background-color": "#d9534f",
        "font-weight": "bold",
        "color": "white"
    });
    $("#mensajevalidar").html("Debe seleccionar una  fecha");
    $("#ModalValidar").modal("show");
    document.getElementById("fecha").style.borderColor = "red";
} else if (h == "") {
    $("#mtituvalidar").css({
        "background-color": "#d9534f",
        "font-weight": "bold",
        "color": "white"
    });
    $("#mensajevalidar").html("Escribe el contacto");
    $("#ModalValidar").modal("show");
    document.getElementById("contacto").style.borderColor = "red";
}
//  else if (i == "") {
//     $("#mtituvalidar").css({
//         "background-color": "#d9534f",
//         "font-weight": "bold",
//         "color": "white"
//     });
//     $("#mensajevalidar").html("Escribe la descripcion");
//     $("#ModalValidar").modal("show");
//     document.getElementById("descripcion").style.borderColor = "red";
// } 
else if(j == "")
{
	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
	$("#mensajevalidar").html("Escribe la diligencia realizada por:");
	$("#ModalValidar").modal("show");
	document.getElementById("diligencia").style.borderColor = "red";
}
// else if(k == "")
// {
// 	$("#mtituvalidar").css({"background-color":"#d9534f","font-weight":"bold","color":"white"});
// 	$("#mensajevalidar").html("Escribe las observaciones");
// 	$("#ModalValidar").modal("show");
// 	document.getElementById("observaciones").style.borderColor = "red";
// }

else {
modal(2);
}
}


function guardar() {
    
$("#FormularioCliente").on("submit", function(e) {
e.preventDefault();
//var f = $(this);
var formData = new FormData(document.getElementById("FormularioCliente"));
formData.append("dato", "valor");
$.ajax({
url: "../Controllers/controller.registrarusuario.php",
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
$("#mensaje").html("El Usuario ha sido registrado"); //texto que lleva la modal
$('#jqGrid').jqGrid('setGridParam', {
    url: '../Controllers/controller.listacotizaciones.php',
    datatype: 'json',
    type: 'POST'
}).trigger('reloadGrid');
$("#FormularioCliente")[0].reset();
$("#Modalmen").modal("show");
} else {
$("#mtitu").css({
    "background-color": "#d9534f",
    "font-weight": "bold",
    "color": "white"
});
$("#mensaje").html("Ocurrio un error, El Usuario no se registro");
$("#Modalmen").modal("show");
}
});

e.preventDefault(); //stop default action

});
}

function editar() {
var grid = $("#jqGrid");
var ret = grid.jqGrid('getGridParam', "selrow");
$("#botoneditar").show();
$("#botonguardar").hide();
$("#formulario").show();
$("#lista").hide();
$("#rfc").prop("readonly", true);

if (ret != null) {
$.getJSON('../Controllers/controller.buscarDatosCotizacion.php?id=' + ret,
function(data) {
$.each(data, function(objeto, item) {

    $('#resEstados').val(item.estado);
    $('#resMunicipios').val(item.municipio);
    $('#resCodigoPostal').val(item.codigopostal);
    $('#resColonia').val(item.colonia);
    // $('#genesis').val(item.cliente);
    // $('#comboDestino3').val(item.direccion);
    $('#transporte').val(item.transporte);
    $('#precio').val(item.precio);


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
$("#mensaje").html("Debe seleccionar una fila para editar");
$("#Modalmen").modal("show");
}
}


function guardaredit(id) {
var grid = $("#jqGrid");
var ret = grid.jqGrid('getGridParam', "selrow");

var formData = new FormData(document.getElementById("FormularioCliente"));


//e.preventDefault();
formData.append("id", ret);

$.ajax({
url: "../Controllers/controller.editarCotizacion.php?id=" + ret,
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
$("#mensaje").html("El usuario se ha editado correctamente");
$('#jqGrid').jqGrid('setGridParam', {
url: '../Controllers/controller.listausuario.php',
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
$("#mensaje").html("Ocurrio un error, El usuario no se pudo editar");
$("#Modalmen").modal("show");
}
});



}

function eliminar(id) {
var grid = $("#jqGrid");
var ret = grid.jqGrid('getGridParam', "selrow");
if (ret != null) {
$.ajax({
url: "../Controllers/controller.eliminarUsuario.php?id=" + ret,
type: "POST",
dataType: "html",
cache: false,
contentType: false,
processData: false
}).done(function(res) {
if (res == "1") {
$("#mensaje").html("El usuario ha sido borrado");
$("#Modalmen").modal("show");
$('#jqGrid').jqGrid('setGridParam', {
    url: '../Controllers/controller.listausuario.php',
    datatype: 'json',
    type: 'POST'
}).trigger('reloadGrid');
} else {
$("#mensaje").html("Ocurrio un error, El Usuario no se pudo borrar");
$("#Modalmen").modal("show");
}
});
}
}
function validarContraseña(){
    if($("#password").val() === $("#password2").val()){
         //Si son iguales
         console.log("Las contraseñas son iguales");
    }else if($("#password").val() !== $("#password2").val()){
         //Si no son iguales
         console.log("Las contraseñas no son iguales");
    }
}


</script>
