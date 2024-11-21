<?php

    #Validación llamado desde cada interfaz del sistema
    include '../app/config.php';
    if (!isset($_SESSION['fa_login'])) {
      header('Location: ../index.php');
    }

    if (empty($_SESSION['fa_login']) || $_SESSION['fa_login']!= 1) {
        header('Location: ../logout.php');
    }
    
?>