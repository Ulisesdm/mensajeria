<?php
	/**
	* modelo al base de datos usuario --> lla_usuario
	*/
	include_once 'app/conexion.php';
	//include_once '../app/Conexion.php';



	class Usuario {

		private $id;
		private $nombre;
		private $email;
		private $password;
		private $perfil;
		private $rfc;
		private $id_empresa;

		public function __construct(){
			//default conecta con la base de datos
			$this->con = new Conexion();
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}


		public function sistema(){
			$estatusSistema = 0;

			$sql = "SELECT estatusSistema FROM lla_sistema";
			$datos = $this->con->consultaRetorno($sql);
			if(mysqli_num_rows($datos) > 0){

				$row = mysqli_fetch_array($datos);
				$estatusSistema = $row['estatusSistema'];
			}

			return $estatusSistema;


		}
		public function eliminaUsuario()
		{
			//$sql="UPDATE enca_creditos set ESTATUS='5' where FOLIO_SEGUIMIENTO='{$this->folio}'";
			$sql=" DELETE FROM usuarios WHERE id ='{$this->id}' ";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}

		public function validar(){
			$sql = "SELECT lu.*,la.rfc,la.razon_social FROM lla_usuario as lu,lla_empresa as la WHERE lu.nombre='$this->email' AND lu.pass='$this->password' and lu.id_empresa=la.nombrecompleto";
			$datos = $this->con->consultaRetorno($sql);
			while($row = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
				$this->id        = $row['id'];
				$this->nombre    = $row['nombre'];
				$this->perfil    = $row['perfil'];
				$this->rfc 		 = $row['rfc'];
				// $this->estatus   = $row['estatus'];
				// $this->razon_social  = $row['razon_social'];
				$this->id_empresa = $row['id_empresa'];

			}
		}
		public function validar2(){
			$sql = "SELECT lu.*,lu.id,lu.nombre,lu.perfil FROM usuarios as lu WHERE lu.email='$this->email' AND lu.pass='$this->password' ";
			$datos = $this->con->consultaRetorno($sql);
			while($row = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
				$this->id        = $row['id'];
				$this->nombre    = $row['nombre'];
				$this->perfil    = $row['perfil'];
				

			}
		}
		public function listausuario()
		{
			$sql="SELECT u.id,u.nombre,u.email,u.pass,u.perfil,u.estatus from usuarios as u order by u.id DESC";
			return $this->con->consultaRetorno($sql);
			
		}

		public function registrar_usuario()
		{
			echo$sql = "INSERT INTO usuarios (nombre, email, pass, perfil,estatus,fecha_registro)
			VALUES ('{$this->nombre}', '{$this->email}', '{$this->password}','{$this->perfil}','{$this->estatus}','{$this->fecha}')";
			 $datos=$this->con->consultaRetorno($sql);
			 return $datos;
		}
		
			

	}
 ?>
