
<?php
include('../Models/usuario2.php');
session_start();
$cliente = new Usuario();


$data = []; // Cambiado a un array vacío
$res = $cliente->listausuario();

while($row = mysqli_fetch_array($res)) {
    if($row["estatus"] == 1) {
        $Estatus = "<span class=\"badge bg-success\" style=\"color:white;\">Activo</span>";
    } else {
        $Estatus = "<span class=\"badge bg-danger\" style=\"color:white;\">Inactivo</span>";
    }

    $data[] = array(
        'id'        => $row['id'],
        'nombre'    => $row['nombre'],
        'email'     => $row['email'],
        'estatus'   => $Estatus,
        'opciones'  => '&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-trash" style="color:red;font-size:12px;cursor:pointer;" title="Eliminar" onclick="eliminar('.$row['id'].');"></span>',
    );
}

print json_encode($data);
?>
