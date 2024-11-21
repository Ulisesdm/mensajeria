<?php
//set_time_limit(0);
include('../Models/model.cliente.php'); //Modelo clientes
$Cliente  = new Cliente();

$id=$_GET['id'];
$Cliente->set("id",$id);
$datos=[];
$res=$Cliente->listamensajeria2();

while($row = mysqli_fetch_array($res))
{ 
         


  $datos[] = array(

  
    'fecha'     => utf8_encode($row['fecha']),
    'solicitud'     => utf8_encode($row['tipo_solicitud']),
    'contacto'    => utf8_encode($row['contacto']),
    'telefono'    => utf8_encode($row['telefono']),
    'descripcion'         => utf8_encode($row['descripcion']),
    'diligencia'         => utf8_encode($row['diligencia']),
    'observaciones'         => utf8_encode($row['observaciones']),
  );



  
}
echo json_encode($datos);
?>