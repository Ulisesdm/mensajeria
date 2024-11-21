
<?php
include('../Models/model.cliente.php');
session_start();
$cliente = new Cliente();


$data=[];
$res = $cliente->listamensajeria();
while($row = mysqli_fetch_array($res)) {
    $opciones = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-pdf" onclick="generar_excel('.$row['id'].');" title="PDF Administrador" style="color:blue;font-size:15px;cursor:pointer;"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-pencil" style="color:#002063;font-size:15px;cursor:pointer;" title="Editar" onclick="editar('.$row['id'].')"></span>';
    
    if($_SESSION['fa_perfil'] != '2') {
        $opciones .= '&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-trash" style="color:red;font-size:12px;cursor:pointer;" title="Eliminar" onclick="eliminar();"></span>';
    }
    
    $data[] = array(
        'id'            => $row['id'],
        'fecha'         => $row['fecha'],
        'solicitud'     => $row['tipo_solicitud'],
        'descripcion'   => $row['descripcion'],
        'contacto'      => $row['contacto'],
        'diligencia'    => $row['diligencia'],
        'observaciones' => $row['observaciones'],
        'opciones'      => $opciones,
    );
}
print json_encode($data);
?>