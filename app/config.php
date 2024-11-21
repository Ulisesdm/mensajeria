<?php
	#5e:Para no mostrar errores
	error_reporting(0);

	session_start();
	#Configuracion de rutas

	

	#Directorio de Pruebas
	define('ROOT', "http://localhost/html5/Mensajeria/"); #representa [ ruta absoluta de la carpeta ]
	define('URL', "http://localhost/html5/Mensajeria/"); #representa [ ruta web ]

	#5e:Pruebas de Correo Aiko
	define('MSERVER', "com.mx"); #Host servidor de correos [ pruebas ]
	define('MPSERVER', 587);        	   #Puerto servidor de correos [ pruebas ]
	define('CFSERVER', " "); 			   #Cifrado servidor de correos [ pruebas ] [PRO : ", TLS"]
	define('MUSER', ""); #Usuario correo servidor de correos [ pruebas ]
	define('MPASS', ""); 		   #Password correo servidor de correos [ pruebas ]
	#5e:Pruebas


	
	

?>