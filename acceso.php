<?php
    session_start();
    #Hay inicio sesion activa
    if(isset($_SESSION['fa_login'])){
        header('Location: Vistas/');
    }else header('Location: login.php'); #no hay sesion activa
?>