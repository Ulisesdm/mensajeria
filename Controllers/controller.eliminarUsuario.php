<?php
include('../Models/usuario2.php');


$id=$_GET['id'];
$Credito=new Usuario();
$Credito->set('id',$id);
$answer=$Credito->eliminaUsuario();
if($answer){
	echo 1;
}else{
	echo 0;
}
?>