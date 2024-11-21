<?php
set_time_limit(0);
	include_once '../Models/model.cliente.php';
    $Cliente = new Cliente();
    $fecha="";

    session_start();

    
   
	$numero= 1;
				
				    
                    $Cliente->set("fecha",	addslashes(utf8_encode(utf8_decode($_POST['fecha']))));
					$Cliente->set("solicitud",	addslashes(utf8_encode(utf8_decode($_POST['solicitud']))));
					$Cliente->set("descripcion",	addslashes(utf8_encode(utf8_decode($_POST['descripcion']))));
					$Cliente->set("contacto",	addslashes(utf8_encode(utf8_decode($_POST['contacto']))));
					$Cliente->set("telefono",	addslashes(utf8_encode(utf8_decode($_POST['telefono']))));
					$Cliente->set("diligencia",	addslashes(utf8_encode(utf8_decode($_POST['diligencia']))));
					$Cliente->set("observaciones",	addslashes(utf8_encode(utf8_decode($_POST['observaciones']))));
					$Cliente->set("estatus",	addslashes(utf8_encode(utf8_decode($numero))));
					$datos=$Cliente->registrarmensaje();
					if($datos){
						echo 1;
					}
					else
					{
						echo $datos;
					}
				
	

?>
