<?php 
	session_set_cookie_params(0); 
	session_start();
	session_unset();
	session_destroy();
	
	#Retorno
    header('Location:index.php');
	 
 ?>