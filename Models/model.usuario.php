<?php

/* 
    Modelo basado en la tabla de usuario
*/
include_once '../app/conexion.php';

class usuario
{

    public $Id_Usuario;
    public $Nombre;
    public $Login;
    public $Clave_Seguridad;
    public $Perfil;
    public $Estatus;

    private $con;/*Conexion a MySQL */
    public function __construct()
    {
        //default conecta con la base de datos
        $this->con = new Conexion();
    }

    /* Obtener todos los usuarios -> se usa en el modulo de usuarios */
    public function Get_Usuarios()
    {
        $SQL = "SELECT * FROM usuario;";
        return $this->con->consultaRetorno($SQL);
    }

    /* Obtener un usuario especifico por id  -> se usa en el modulo de usuarios */
    public function Get_Usuario_Id()
    {
        $SQL = "SELECT * FROM usuario WHERE Id_Usuario = '{$this->Id_Usuario}';";

        $Datos = $this->con->consultaRetorno($SQL);

        while ($Row = mysqli_fetch_array($Datos)) {
            $this->Id_Usuario = $Row["Id_Usuario"];
            $this->Nombre = $Row["Nombre"];
            $this->Login = $Row["Login"];
            $this->Perfil = $Row["Perfil"];
        }

        return $Datos;
    }

    /* Cambiar estatus de  un usuario por id -> se usa en el modulo de usuarios */
    public function Set_Estatus_Id()
    {
        $SQL = "UPDATE usuario
            SET Estatus = {$this->Estatus}
            WHERE Id_Usuario = {$this->Id_Usuario};";
        return $this->con->consultaRetorno($SQL);
    }

     /* Cambiar datos de  un usuario por id sin contraseña -> se usa en el modulo de usuarios */
     public function Update_DatosSinPass_Id()
     {
         $SQL = "UPDATE usuario
             SET 
                Nombre = '{$this->Nombre}',
                Login = '{$this->Login}',
                Perfil = {$this->Perfil}
             WHERE Id_Usuario = {$this->Id_Usuario};";
         return $this->con->consultaRetorno($SQL);
     }


      /* Cambiar datos de  un usuario por id con contraseña -> se usa en el modulo de usuarios */
      public function Update_DatosConPass_Id()
      {
          $SQL = "UPDATE usuario
              SET 
                Nombre = '{$this->Nombre}',
                Login = '{$this->Login}',
                Perfil = {$this->Perfil},
                Clave_Seguridad = '{$this->Clave_Seguridad}'
              WHERE Id_Usuario = {$this->Id_Usuario};";
          return $this->con->consultaRetorno($SQL);
      }

    /* Registrar nuevo usuario -> se usa en el modulo de usuarios */
    public function Set_Usuario()
    {
        echo$SQL = "INSERT INTO usuarios (Nombre, Login, Clave_Seguridad, Perfil)
        VALUES ('{$this->Nombre}', '{$this->Login}', '{$this->Clave_Seguridad}',{$this->Perfil});";
        $this->con->consultaRetorno($SQL);
        return $this->con->consultaRetorno('SELECT LAST_INSERT_ID();');
    }
}