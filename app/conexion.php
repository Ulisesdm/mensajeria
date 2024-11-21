<?php
class Conexion{

	/*Conexion para transportesherba.com */
	private $datos = array(
		"host" => "localhost",
		"user" => "root",
		"pass" => "",
		"db"   => "mensajeria"
	);

	private $con; //acceso a otras clases
	/*crudpro*/
	
	public function __construct(){
		$this->con = new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['db']);
		$this->con->set_charset("utf8");
	}

	public function consultaSimple($sql){
		/*$answer = */$this->con->query($sql);
		/*return $answer;*/
	}

	public function consulta($sql){
		/*$answer = */$dato = $this->con->query($sql);
		return $dato;
		/*return $answer;*/
	}


	public function consultaRetorno($sql){
		$datos = $this->con->query($sql);
		return $datos;
	}
	
	public function last_insert_id($sql){
		return mysqli_insert_id($this->con);			    
	}


	/*public function close(){
		$this->con->close();
	}*/
}
?>