<?php
include('../Models/model.cliente.php');


$id=$_GET['id'];
$Credito=new Cliente();
$Credito->set('id',$id);
$answer=$Credito->eliminaMensaje();
if($answer){
	echo 1;
}else{
	echo 0;
}
?>