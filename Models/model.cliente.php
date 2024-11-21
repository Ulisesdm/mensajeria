<?php
	/**
	* modelo al base de datos darosCredito --> enca_creditos
	*/
	ini_set ('date.timezone','America/Mexico_City');
	include_once '../app/Conexion.php';
	class Cliente
	{
		// private $rfc;
		// private $razonsocial;
		// private $cuenta;
		// private $email;

		public function __construct()
		{
			//default conecta con la base de datos
			$this->con = new Conexion();
		}

		public function set($atributo, $contenido)
		{
			$this->$atributo = $contenido;
		}

		public function get($atributo)
		{
			return $this->$atributo;
		}

		public function agregar_cp(){

			if ($this->con->consultaRetorno("SELECT c_cp FROM lls_cp WHERE c_cp = '$this->c_cp'")->num_rows!=0) {
				echo "1";//el codigo postal ya existe
			}else {
				$this->con->consultaRetorno(" INSERT INTO lls_cp VALUES (NULL,'$this->c_cp','$this->c_estado','$this->c_municipio','')");
			}

		}
		public function agregar_colonia(){
			$sql = " INSERT INTO lls_colonias VALUES (NULL,NULL,$this->c_cp,'$this->c_nombre_colonia')";
			$this->con->consultaRetorno($sql);
			$datos = $this->con->consultaRetorno('SELECT @@identity AS id');
			return $datos=$datos->fetch_assoc();
		}

		public function add()
		{

			// $sql =" INSERT INTO lla_clientes(rfc,razon_social,cuenta,correos,estatus,pais,estado,municipio,cp,colonia,calle,ninterior,nexterior,c_usocfdi)
			// 		VALUES('{$this->rfc}','{$this->razonsocial}','{$this->cuenta}','{$this->email}','1','{$this->pais}','{$this->estado}','{$this->municipio}','{$this->codigopostal}','{$this->colonia}',
			// 		'{$this->calle}','{$this->numinterior}','{$this->numexterior}','{$this->cfdi}')";
			$sql =" INSERT INTO lla_cotizacion(estado,municipio,colonia,cp,idd,precio,cliente,transporte)
							VALUES('{$this->estado}','{$this->municipio}','{$this->colonia}','{$this->codigopostal}','{$this->idd}','{$this->precio}','{$this->cliente}','{$this->transporte}')";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;

		}
		public function agregar_banco(){
			$sql = "INSERT INTO lla_cuentas_bancarias VALUES(NULL,
				'$this->nom_banco',
				'$this->rfc_cuenta',
				'$this->num_cuenta','$this->estatus','$this->usuario_cuenta','".date('o-m-d H:i:s')."',$this->cliente)";
				// echo $sql;
			$this->con->consultaRetorno($sql);
		}
		public function datos_banco(){
			$datos = $this->con->consultaRetorno("SELECT * FROM lla_cuentas_bancarias WHERE num_cuenta = '".$this->num_cuenta."' AND id_cliente = ".$this->cliente);
			$datos=$datos->fetch_assoc();
			return $datos;
		}
		public function obtener_bancos_cliente(){
			$datos = $this->con->consultaRetorno("SELECT * FROM lla_cuentas_bancarias WHERE id_cliente = ".$this->cliente." AND usuario_cuenta = '".$this->usuario_cuenta."'");

			$datos=$datos->fetch_all(MYSQLI_ASSOC);
			return $datos;
		}
		public function obtenerDirecciones()
		{
			 $sql = "SELECT d.idDireccion,d.tipo,d.sucursal,d.telefono,d.contacto,d.correos,d.calle,d.nexterior,d.ninterior,
			p.c_nombre,e.c_nombre_estado,m.c_nombre_municipio,co.c_nombre_colonia,d.cp
			FROM direcciones d 
			LEFT JOIN lls_pais p ON d.pais = p.rowid
			LEFT JOIN lls_estados e ON d.estado = e.rowid
			LEFT JOIN lls_municipios m ON d.municipio = m.rowid
			LEFT JOIN lls_colonias co ON d.colonia = co.rowid
			WHERE d.idCliente = '{$this->idCliente}' AND d.tipo= '{$this->yano}'";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		
		}

		public function comboRegimen()
		{
			$sql="SELECT clave, CONCAT(clave,'-',descripcion)AS regimen FROM lls_regimenfiscal";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
        public function listamensajeria()
		{
			$sql="SELECT m.id,m.fecha,m.tipo_solicitud,m.descripcion,m.contacto,m.telefono,m.diligencia,m.observaciones from mensajeria as m order by m.id DESC";
			return $this->con->consultaRetorno($sql);
			
		}
		public function listamensajeria2()
		{
			$sql="SELECT m.id,m.fecha,m.tipo_solicitud,m.descripcion,m.contacto,m.telefono,m.diligencia,m.observaciones from mensajeria as m  WHERE m.id = '{$this->id}'";
			return $this->con->consultaRetorno($sql);
			
		}

		
		public function buscarcEstado()
		{
			$sql = "SELECT c_estado FROM lls_estados WHERE rowid='{$this->idEstado}'";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		public function auxiliarestado()
		{
			$sql = "SELECT c_estado FROM lls_estados WHERE rowid= '{$this->estado}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function auxiliarmunicipio()
		{
			$sql= "SELECT c_municipio FROM lls_municipios WHERE rowid  = '{$this->municipio}' ";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function auxiliarcodigopostal()
		{
			$sql= "SELECT c_cp FROM lls_cp WHERE rowid = '{$this->cp}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function auxiliarcolonia()
		{
			$sql = "SELECT c_colonia FROM lls_colonias WHERE rowid = '{$this->colonia}'";;
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}


		public function buscarMunicipio()
		{
			$sql = "SELECT rowid FROM lls_municipios WHERE c_municipio='{$this->Municipio}' AND c_estado='{$this->Estado}'";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		public function buscarColonia()
		{
			$sql = "SELECT rowid FROM lls_colonias WHERE c_nombre_colonia LIKE '%{$this->nomColonia}%' AND c_cp='{$this->CodigoPostal}'";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		public function buscarColoniaDos()
		{
			$sql = "SELECT rowid FROM lls_colonias WHERE c_colonia = '{$this->Colonia}' AND c_cp='{$this->CodigoPostal}'";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		public function insertarDirecciones()
		{
			$sql = "INSERT INTO direcciones 
			(tipo, 
			rfc,
			sucursal, 
			telefono, 
			contacto,
			correos, 
			pais, 
			estado,
			municipio,
			cp,
			colonia,
			calle,
			nexterior,
			ninterior,
			idCliente)
			VALUES
			('{$this->tipo}', 
			'{$this->rfc}',
			'{$this->sucursal}', 
			'{$this->telefono}', 
			'{$this->contacto}', 
			'{$this->correos}',
			'{$this->pais}',
			'{$this->estado}',
			'{$this->municipio}',								
			'{$this->cp}', 								
			'{$this->colonia}', 
			'{$this->calle}',
			'{$this->nexterior}',
			'{$this->ninterior}',
			'{$this->idCliente}');";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		
		}
        public function registrarmensaje()
        {
            $sql = "INSERT INTO mensajeria (fecha, tipo_solicitud,descripcion,contacto,telefono,diligencia,observaciones,estatus)
            VALUES ('{$this->fecha}', '{$this->solicitud}', '{$this->descripcion}', '{$this->contacto}','{$this->telefono}', '{$this->diligencia}', '{$this->observaciones}', '{$this->estatus}');";
            $datos=$this->con->consultaRetorno($sql);
            return $datos;
        }
		public function eliminaMensaje()
		{
			//$sql="UPDATE enca_creditos set ESTATUS='5' where FOLIO_SEGUIMIENTO='{$this->folio}'";
			$sql=" DELETE FROM mensajeria WHERE id ='{$this->id}' ";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		public function modificarmensaje()
		{

			$sql = " UPDATE  mensajeria SET fecha='{$this->fecha}',tipo_solicitud='{$this->solicitud}',descripcion='{$this->descripcion}',contacto='{$this->contacto}',telefono='{$this->telefono}',diligencia='{$this->diligencia}',observaciones='{$this->observaciones}',estatus='{$this->estatus}' WHERE id='{$this->id}'";
			
			$datos=$this->con->consultaRetorno($sql);
			return $datos;

		}


		public function consultaDireccion(){
			$sql="SELECT d.idDireccion,d.tipo,d.rfc,d.sucursal,d.telefono,d.contacto,d.correos,d.calle,d.cp,co.c_colonia,co.c_nombre_colonia 
			,e.c_nombre_estado,e.c_estado,m.c_municipio,m.c_nombre_municipio,d.nexterior,d.ninterior,e.rowid,d.idCliente
						FROM direcciones d
						LEFT JOIN lls_estados e ON d.estado = e.rowid
						LEFT JOIN lls_municipios m ON d.municipio = m.rowid
						LEFT JOIN lls_colonias co ON d.colonia = co.rowid
						WHERE d.idDireccion='{$this->idDireccion}'";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		public function modificarDireccion()
		{

			$sql = "UPDATE direcciones SET tipo='{$this->tipo}',rfc='{$this->rfc}',sucursal='{$this->sucursal}',telefono='{$this->telefono}',
			contacto='{$this->contacto}',correos='{$this->correos}',pais='{$this->pais}',estado='{$this->estado}',
			municipio='{$this->municipio}',cp='{$this->cp}',colonia='{$this->colonia}',calle='{$this->calle}',
			nexterior='{$this->nexterior}',ninterior='{$this->ninterior}' WHERE idDireccion = '{$this->idDireccion}'";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;

		}
		public function eliminaDireccion()
		{			
			$sql="DELETE FROM direcciones WHERE idDireccion ='{$this->idDireccion}'";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
	
	
		public function listageneral()
		{
			$sql = "SELECT id,rfc,razon_social,cuenta,correos,estatus,pais,estado,municipio,colonia,calle,ninterior,nexterior,cp,c_usocfdi FROM lla_clientes where rfc_empresa='{$this->rfc}'";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}


		public function datosGRID()
		{
		 $sql="SELECT precio FROM lla_cotizacion WHERE estado = '{$this->estado}' and municipio = '{$this->municipio}' and colonia ='{$this->colonia}' and cp ='{$this->codigopostal}' and idd ='{$this->idd}' and cliente='{$this->cliente}' and transporte='{$this->transporte}'  ";
		    //echo $sql;
		    $datos = $this->con->consultaRetorno($sql);
			return $datos;
		    // while($row=mysqli_fetch_array($datos))
		    // {
		   		 // $this->id=utf8_encode($row['id']);
				 // $this->rfc=utf8_encode($row['rfc']);
		   		 // $this->razonsocial=utf8_encode($row['razon_social']);
		   		 // $this->cuenta=utf8_encode($row['cuenta']);
		   		 // $this->correos=utf8_encode($row['correos']);
		   		 // $this->estatus=utf8_encode($row['estatus']);
				 // $this->pais=utf8_encode($row['pais']);
				 // $this->estado=utf8_encode($row['estado']);
				 // $this->municipio=utf8_encode($row['municipio']);
				 // $this->colonia=utf8_encode($row['colonia']);
		   		 // $this->calle=utf8_encode($row['calle']);
		   		 // $this->ninterior=utf8_encode($row['ninterior']);
		   		 // $this->nexterior=utf8_encode($row['nexterior']);
				 // $this->cp=utf8_encode($row['cp']);
				 // $this->c_usocfdi=utf8_encode($row['c_usocfdi']);

		   	// }
		}
		public function datosGRID2()
		{
		    $sql="SELECT cotizacion.id AS id,
			c.razon_social AS razon_social,
			
			
			e.c_nombre_estado AS estado,
			m.c_nombre_municipio AS municipio,
			co.c_nombre_colonia AS colonia,
			
			cp.c_cp AS cp,
			
			cotizacion.cliente ,
			cotizacion.estado as estado2,
			cotizacion.municipio as municipio2,
			cotizacion.colonia as colonia2,
			cotizacion.cp as cp2,
			cotizacion.idd,
			cotizacion.precio,
			cotizacion.transporte
			FROM lla_cotizacion cotizacion			
			LEFT JOIN lls_estados e ON cotizacion.estado = e.rowid
			LEFT JOIN lls_municipios m ON cotizacion.municipio = m.rowid
			LEFT JOIN lls_colonias co ON cotizacion.colonia = co.rowid
			LEFT JOIN lls_cp cp ON cotizacion.cp = cp.rowid
			LEFT JOIN lla_clientes c ON c.id = cotizacion.cliente
			order by cotizacion.id DESC";
		    $datos = $this->con->consultaRetorno($sql);
			return $datos;
		  
		}




		public function widget_no_clientes(){
			$sql = "SELECT * FROM lla_clientes";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function comboPaises()
		{
			$sql = "SELECT c_pais,c_nombre FROM lls_pais WHERE rowid = 151";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function combo_cliente(){
			$sql="SELECT id,razon_social FROM lla_clientes";
			$datos=$this->con->consultaRetorno($sql);
			$datos=$datos->fetch_all(MYSQLI_ASSOC);
			return $datos;
		}
		public function combo_forma_pago(){
			$sql = "SELECT rowid,c_formapago,descripcion FROM lls_formapago";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function combo_metodo_pago(){
			$sql = "SELECT rowid,c_metodopago,descripcion FROM lls_metodopago";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function comboCFDI()
		{
			$sql = "SELECT rowid,c_UsoCFDI, descripcion FROM lls_c_usocfdi ORDER BY descripcion ASC";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function comboEstados()
		{
			$sql = "SELECT rowid,c_estado,c_nombre_estado FROM lls_estados WHERE c_pais = 'MEX'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}




		// public function buscarComboEstado()
		// {
		// 	$sql = "SELECT rowid,c_estado,c_nombre_estado FROM lls_estados WHERE c_pais = '{$this->pais}'";
		// 	$datos = $this->con->consultaRetorno($sql);
		// 	return $datos;
		// }

		public function buscarComboMunicipio()
		{
			$sql = "SELECT rowid,c_municipio,c_estado,c_nombre_municipio FROM lls_municipios WHERE c_estado = '{$this->estado}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscarComboCodigoPostal()
		{
			$sql = "SELECT rowid,c_cp,c_estado,c_municipio,c_localidad FROM lls_cp WHERE c_municipio = '{$this->municipio}' or c_estado = '{$this->estado}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscarComboColonia()
		{
			$sql = "SELECT rowid,c_nombre_colonia FROM lls_colonias WHERE c_cp = '{$this->codigopostal}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function combo_clienteEDITED($rfc_empresa){
			#NO CARDA EÑ THIS RFC EMPRESA REVISAR LUEGO#
			$sql="SELECT id,razon_social FROM lla_clientes WHERE rfc_empresa='".$rfc_empresa."'";
			$datos=$this->con->consultaRetorno($sql);
			$datos=$datos->fetch_all(MYSQLI_ASSOC);
			return $datos;
		}
		public function buscaridPais()
		{
			$sql = "SELECT rowid FROM lls_pais WHERE c_pais = '{$this->pais}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscaridEstado()
		{
			$sql= "SELECT rowid FROM lls_estados WHERE c_estado = '{$this->estado}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscaridMunicipio()
		{
			$sql= "SELECT rowid FROM lls_municipios WHERE c_municipio  = '{$this->municipio}' AND c_estado = '{$this->estado}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscaridCP()
		{
			$sql= "SELECT rowid FROM lls_cp WHERE c_cp = '{$this->codigopostal}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function buscarValorPais()
		{
			$sql= "SELECT c_nombre FROM lls_pais WHERE rowid = '{$this->idpais}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscarValorEstado()
		{
			$sql= "SELECT c_nombre_estado FROM lls_estados WHERE rowid = '{$this->idestado}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscarValorMunicipio()
		{
			$sql= "SELECT c_nombre_municipio FROM lls_municipios WHERE rowid = '{$this->idmunicipio}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscarValorColonia()
		{
			$sql= "SELECT c_nombre_colonia FROM lls_colonias WHERE rowid= '{$this->idcolonia}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscarValorCP()
		{
			$sql= "SELECT c_cp FROM lls_cp WHERE rowid = '{$this->idcodigopostal}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		public function buscarValorCFDI()
		{
			$sql= "SELECT descripcion FROM lls_c_usocfdi WHERE rowid = '{$this->idcfdi}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			public function buscardatos()
		{
		  
			$sql="SELECT c.id AS id,
			c.razon_social AS razon_social,
			
			
			e.c_nombre_estado AS estado,
			m.c_nombre_municipio AS municipio,
			co.c_nombre_colonia AS colonia,
			
			cp.c_cp AS cp,
			cotizacion.cliente ,
			cotizacion.estado as estado2,
			cotizacion.municipio as municipio2,
			cotizacion.colonia as colonia2,
			cotizacion.cp as cp2,
			cotizacion.idd,
			cotizacion.precio,
			cotizacion.transporte
			FROM lla_cotizacion cotizacion			
			LEFT JOIN lls_estados e ON cotizacion.estado = e.rowid
			LEFT JOIN lls_municipios m ON cotizacion.municipio = m.rowid
			LEFT JOIN lls_colonias co ON cotizacion.colonia = co.rowid
			LEFT JOIN lls_cp cp ON cotizacion.cp = cp.rowid
			LEFT JOIN lla_clientes c ON c.id = cotizacion.cliente
			
			WHERE cotizacion.id = '{$this->id}'";
		    //echo $sql;
		    $datos = $this->con->consultaRetorno($sql);
		    return $datos;
		    // while($row=mysqli_fetch_array($datos))
		    // {
		   	// 	 $this->rfc=utf8_encode($row['rfc']);
		   	// 	 $this->razonsocial=utf8_encode($row['razon_social']);
		   	// 	 $this->cuenta=utf8_encode($row['cuenta']);
		   	// 	 $this->correos=utf8_encode($row['correos']);
		   	// 	 //$this->estatus=utf8_encode($row['estatus']);
		   	// 	 $this->idestado=utf8_encode($row['rowidestado']);
		   	// 	 $this->idmuni=utf8_encode($row['rowidmuni']);
		   	// 	 $this->c_nombre_municipio=utf8_encode($row['c_nombre_municipio']);
		   	// 	 //$this->idcp=utf8_encode($row['rowcp']);
		   	// 	 $this->calle=utf8_encode($row['calle']);
		   	// 	 $this->ninterior=utf8_encode($row['ninterior']);
		   	// 	 $this->nexterior=utf8_encode($row['nexterior']);
		   	// 	 $this->idcfdi=utf8_encode($row['rowid']);
		   	// }
		}
//////////////////////////////////////////////////////////////////////////////////////////////////

		public function eliminar_banco(){
			$sql="DELETE FROM lla_cuentas_bancarias WHERE lla_cuentas_bancarias.id = ".$this->id;			
			$datos=$this->con->consultaRetorno($sql);
		}

		public function modificar()
		{

			$sql = " UPDATE  lla_cotizacion SET estado='{$this->estado}',municipio='{$this->municipio}',colonia='{$this->colonia}',cp='{$this->codigopostal}',idd='{$this->idd}',precio='{$this->precio}',cliente='{$this->cliente}',transporte='{$this->transporte}' WHERE id='{$this->id}'";
			
			$datos=$this->con->consultaRetorno($sql);
			return $datos;

		}

		public function eliminaCotizacion()
		{
			//$sql="UPDATE enca_creditos set ESTATUS='5' where FOLIO_SEGUIMIENTO='{$this->folio}'";
			$sql=" DELETE FROM lla_cotizacion WHERE id ='{$this->id}' ";
			//echo $sql;
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}

		public function buscar_auto(){
			$arr=array();
			$sql = "SELECT CONCAT(TRIM(clave_prodserv),'-',TRIM(descripcion))AS respuesta FROM lls_clave_prodserv
				WHERE CONCAT(TRIM(clave_prodserv),'-',TRIM(descripcion)) LIKE '%$this->concepto%' ORDER BY rowid";
			//echo $sql;
			$datos = $this->con->consultaRetorno($sql);

			while ($row = mysqli_fetch_array($datos)) {
				$row_array=$this->roll=utf8_encode($row['respuesta']);
				array_push($arr,$row_array);
    		}
    		return ($arr);
		}


		public function verificaRFCCliente()
		{
			$sql="SELECT rfc FROM lla_clientes WHERE rfc = '{$this->rfc}'";
			$datos=$this->con->consultaRetorno($sql);
			return $datos;
		}
		// public function listarGerentes(){
		// 	$sql = "SELECT nombreGerente,email_gerente FROM usuario GROUP BY email_gerente ORDER BY nombreGerente ASC";
		// 	$datos = $this->con->consultaRetorno($sql);
		// 	return $datos;
		// }

		// public function detalleGerente(){
		// 	$sql = "SELECT nombreGerente,email_gerente FROM usuario WHERE email_gerente = '{$this->email_gerente}'";
		// 	$datos = $this->con->consultaRetorno($sql);
		// 	return $datos;
		// }



		// public function edit(){

		// }

		// public function view(){
		// 	$sql = "SELECT count(*)as registros FROM usuario where login='{$this->email}'";
		// 	$datos = $this->con->consultaRetorno($sql);
		// 	return $datos;
		// }
		// public function validar(){
		// 	$sql = "SELECT tipo_usu, id_usu FROM usuario
		// 			WHERE login='$this->email' AND contrasena='$this->password'";
		// 	$datos = $this->con->consultaRetorno($sql);
		// 	while($row = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
		// 		$this->roll = $row['tipo_usu'];
		// 		$this->id   = $row['id_usu'];
		// 	}
		// }
	}
 ?>
