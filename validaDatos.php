<?php
set_time_limit(0);
	include_once 'Models/usuario.php'; //Modelo usuario
	$usuario  = new Usuario();
	$empresa = new Usuario();

	if(!$_POST){
		echo 1;
		exit;
	}else{
		$rolUsuario = "";
		$id_Usuario = "";

		$usuario->set("email",	  addslashes(utf8_decode($_POST['email'])));
		$usuario->set("password", addslashes(utf8_decode(sha1(md5($_POST['password'])))));
		$hoa=$usuario->validar2();
		$id_Usuario 		= $usuario->get("id");
		$nombre     		= $usuario->get("nombre");
		$rolUsuario 		= $usuario->get("perfil");
	
		$psw 	= utf8_decode(sha1(md5($_POST['password'])));
		$login  = utf8_decode($_POST['email']);

		//$empresa->set('rfc',$rfc);

		if($rolUsuario==2){
			session_start();
			$_SESSION["fa_login"]  		= 1;
			$_SESSION["fa_id"] 	   		= $id_Usuario;
			$_SESSION["fa_nombre"] 		= $nombre;
			$_SESSION["fa_perfil"] 		= $rolUsuario;
		
			$_SESSION["fa_email"] 	   	=  $login;
			$_SESSION["fa_psw"] 		= $psw;
			echo 4;
			http_response_code(202);
			
		}else if($rolUsuario==1){
			session_start();
			$_SESSION["fa_login"]  		= 1;
			$_SESSION["fa_id"] 	   		= $id_Usuario;
			$_SESSION["fa_nombre"] 		= $nombre;
			$_SESSION["fa_perfil"] 		= $rolUsuario;
			$_SESSION["fa_email"] 	   	=  $login;
			$_SESSION["fa_psw"] 		= $psw;
			echo 3;
			http_response_code(202);
		}else{
			http_response_code(401);
		}

	}
?>
