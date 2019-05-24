<?php
// fixing
include_once('db.class.php');
class getDatos extends baseDatos {
	public function consulta_Gen($query,$server=0) {
		if ($server==0) {
			$this->conectar();
		} else {
			$this->conectar_r();
		}
		$consulta=$this->consultar($query);
		$datos=array();
		if ($this->numero_filas($consulta)) {
			while ($arreglo=$this->recorrer_registro($consulta)) {
				$datos[]=$arreglo;
			}
			return $datos;
		} else {
			return $datos;
		}
	}	
	public function preparar($query,$params,$delete=0) {
		$this->conectar();
		//$sentencia=$this->conexion->stmt_init();
		//$this->conexion->set_charset("utf8");
		$datos=array();
		if ($sentencia = $this->conexion->prepare($query)) {
			if (is_array($params)) {
				foreach ($params as $key => $value) {
					$params[$key]=utf8_decode($params[$key]);
					$sentencia->mbind_param("s",$params[$key]);
				}
			} else {
				$sentencia->mbind_param("s",$params);
			}
			$sentencia->execute();
			if (($sentencia->affected_rows==1) || ($delete==1)) {
				return $datos;
			}
			$sentencia->store_result();
			if ($this->getError()) {
				print_r($sentencia->error_list);
			}
			$this->bind_array($sentencia,$info);
			$indice=0;
			while ($sentencia->fetch()) {
				foreach ($info as $key => $value) {
					$datos[$indice][$key]=($value);
				}
				$indice++;
			}
			$sentencia->close();
			// test
		}
		return $datos; //Test
	}
	public function preparar_insert($query,$params) {
		$this->conectar();
		//$sentencia=$this->conexion->stmt_init();
		$datos=array();
		if ($sentencia = $this->conexion->prepare($query)) {
			if (is_array($params)) {
				foreach ($params as $key => $value) {
					$sentencia->mbind_param("s",$params[$key]);
				}
			} else {
				$sentencia->mbind_param("s",$params);
			}
			$sentencia->execute();
			$sentencia->store_result();
			if ($this->getError()) {
				echo "error en sentencia =>  "+mysqli_connect_error();
				print_r($sentencia->error_list);
			}
			if ($sentencia->affected_rows>0) {
				if ($this->conexion->insert_id>0){
					return $this->conexion->insert_id;
				}else{
					return true;
				}
				
			}else{
				$sentencia->store_result();
				if ($this->getError()) {
					print_r($sentencia->error_list);
				}
			}
	  }
	}
	public function getLastInsert() {
		return $this->conexion->insert_id;
	}
	public function preparar_eliminar($query,$params){
		$this->conectar();
		$datos=array();
		if ($sentencia = $this->conexion->prepare($query)) {
			if (is_array($params)) {
				foreach ($params as $key => $value) {
					$sentencia->mbind_param("s",utf8_decode($params[$key]));
				}
			} else {
				$sentencia->mbind_param("s",$params);
			}
			$q = $sentencia->execute();
			if($q>0){
				return true;
			}else{
				return false;
			}

	  }
	}
	public function insertar($query) {
		$this->conectar();
		$consulta=$this->consultar($query);
		$id=mysql_insert_id($this->conexion);
		return $id;
	}
	public function bind_array($stmt, &$row) {
	    $md = $stmt->result_metadata();
	    $params = array();
	    while($field = $md->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }

	    call_user_func_array(array($stmt, 'bind_result'), $params);
	}
	public function getNombreEmpresa() {
		$result=$this->preparar("Select * from empresas_conta where id_emp=?",array('emp'=>$_SESSION["id_emp"]));
		if (count($result)>0) {
			return $result[0];
		} else {
			return array();
		}
	}
	public function generarMenu() {
		$result=$this->preparar("select c.id_menu,c.descripcion as menu, b.descripcion as opcion, b.url as ruta from acceso a INNER JOIN opcion b on a.id_opcion=b.id_opcion INNER JOIN menu c on c.id_menu=b.id_menu WHERE a.id_usuario=? and a.acceso=1",array('id_usuario'=>$_SESSION["id_usuario"]));
		if (count($result)>0) {
			$contador=count($result);
			
			$html="<ul class='sidebar-menu metismenu' id='sidebar-menu'><li class='active'><a href='".controlador::$rutaAPP."index.php?action=main'><i class='fa fa-home'></i> Dashboard </a> </li>";
			$it=0;
			if ($result[$it]["id_menu"]==1) {
				$html.="<li><a href='><i class='fa fa-th-large'></i>".$result[$it]["menu"]."<i class='fa arrow'></i></a><ul class='sidebar-nav'>";
				while ($result[$it]["id_menu"]==1) {
					$html.="<li><a href='".controlador::$rutaAPP.$result[$it]["ruta"]."'>".$result[$it]["opcion"]."</a></li>";



				$it++;
			}
				$html.="</ul></li>";
			}
			if ($result[$it]["id_menu"]==2) {
				$html.="<li><a href='><i class='fa fa-th-large'></i>".$result[$it]["menu"]."<i class='fa arrow'></i></a><ul class='sidebar-nav'>";
				while ($result[$it]["id_menu"]==2) {
					$html.="<li><a href='".controlador::$rutaAPP.$result[$it]["ruta"]."'>".$result[$it]["opcion"]."</a></li>";



				$it++;
			}
				$html.="</ul></li>";
			}
			if ($result[$it]["id_menu"]==5) {
				$html.="<li><a href='><i class='fa fa-th-large'></i>".$result[$it]["menu"]."<i class='fa arrow'></i></a><ul class='sidebar-nav'>";
				while ($result[$it]["id_menu"]==5) {
					$html.="<li><a href='".controlador::$rutaAPP.$result[$it]["ruta"]."'>".$result[$it]["opcion"]."</a></li>";



				$it++;
			}
				$html.="</ul></li>";
			}
			if ($result[$it]["id_menu"]==6) {
				$html.="<li><a href='><i class='fa fa-th-large'></i>".$result[$it]["menu"]."<i class='fa arrow'></i></a><ul class='sidebar-nav'>";
				while ($result[$it]["id_menu"]==6) {
					$html.="<li><a href='".controlador::$rutaAPP.$result[$it]["ruta"]."'>".$result[$it]["opcion"]."</a></li>";


				$it++;
				if ($it==$contador) {
					break;
				}
			}
				$html.="</ul></li>";
			}
			$html.="</ul>";
			return $html;
		} else {
			// return array();
		
		}
	}
	public function customClean($str){
		$this->conectar();
		$clean = [];
		foreach($str as $key => $value)
		{ 
			$clean[$key] = $this->scape_string_values($value);
			$clean[$key] = trim(htmlentities($value, ENT_QUOTES, 'UTF-8'));
		}
		return $clean;
	}
}
