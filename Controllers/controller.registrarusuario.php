<?php

set_time_limit(0);
	include_once '../Models/usuario2.php';
    $Cliente = new Usuario();
    $fecha="";

    session_start();
	$fecha = date('Y-m-d H:i:s');
            $numero= 1;
           
                $Cliente->set("fecha",	addslashes(utf8_decode($fecha)));
					$Cliente->set("nombre",	addslashes(utf8_decode($_POST['nombre'])));
					$Cliente->set("email",	addslashes(utf8_decode($_POST['email'])));
					 $Cliente->set("password", addslashes(utf8_decode(sha1(md5($_POST['password'])))));
					
					$Cliente->set("perfil",	addslashes(utf8_decode($_POST['perfil'])));
					$Cliente->set("estatus",	addslashes(utf8_decode($numero)));
					$datos=$Cliente->registrar_usuario();
					if($datos){
						echo 1;
					}
					else
					{
						echo $datos;
					}
				
	

?>