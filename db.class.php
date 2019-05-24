<?php
//mysqli_report(MYSQLI_REPORT_OFF);
date_default_timezone_set("America/El_Salvador");
class db extends mysqli {
    public function prepare($query) {
        return new stmt($this,$query);
    }
}

class stmt extends mysqli_stmt {
    public function __construct($link, $query) {
        $this->mbind_reset();
        parent::__construct($link, $query);
    }

    public function mbind_reset() {
        unset($this->mbind_params);
        unset($this->mbind_types);
        $this->mbind_params = array();
        $this->mbind_types = array();
    }

    //use this one to bind params by reference
    public function mbind_param($type, &$param) {
    	if (!(isset($this->mbind_types[0]))) {
    		$this->mbind_types[0]="";
    	}
        $this->mbind_types[0].= $type;
        $this->mbind_params[] = &$param;
    }

    //use this one to bin value directly, can be mixed with mbind_param()
    public function mbind_value($type, $param) {
        $this->mbind_types[0].= $type;
        $this->mbind_params[] = $param;
    }


    public function mbind_param_do() {
                $params = array_merge($this->mbind_types, $this->mbind_params);
                $parametros = array($this, 'bind_param');
                if (count($parametros[0]->error_list)>0){
                  $this->imprimirError($parametros[0]->error_list[0]);
                }
                return call_user_func_array(array($this, 'bind_param'), $this->makeValuesReferenced($params));
    }
    private function imprimirError($error){
        echo "Error en Consulta, error No:".$error["errno"]." sql state ".$error["sqlstate"]." error: ".$error["error"];
        exit();
    }
    private function makeValuesReferenced($arr){
        $refs = array();
        foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
        return $refs;

    }

    public function execute() {
        if(count($this->mbind_params))
            $this->mbind_param_do();

        return parent::execute();
    }

    private $mbind_types = array();
    private $mbind_params = array();
}
class baseDatos {

	protected $conexion;
    protected $isConnected=false;
	public function conectar() {
        if (!$this->isConnected) {
		//$this->conexion = new db("localhost","root","6M.UwYV","contabilidad");
          $this->conexion = new db("localhost","root","12345678","rutas");

        /*mysql_select_db("contabilidad",$this->conexion) or die(mysql_error());*/

		if ($this->conexion->connect_errno){
            $this->isConnected=false;
			return false;
		}else{
            $this->isConnected=true;
			return true;
		}
        } else {
            return true;
        }
	}
	public function conectar_r() {
		$this->conexion=(mysql_connect("","","")) or die(mysql_error());
    	mysql_select_db("logitrac_gps_new",$this->conexion) or die(mysql_error());
	}
	public function consultar($sql) {
            $this->conexion->set_charset("utf8");
			$resultado = $this->conexion->query($sql) or die($this->conexion->error);
			return $resultado;
	}
	public function numero_filas($resultado) {
		return $resultado->num_rows;
	}
	public function recorrer_registro($resultado) {
			//if(!is_resource($resultado)) return false;
		    return $resultado->fetch_assoc();
	}
	public function desconectar() {
  		//$this->conexion->close();
     }
    public function scape_string_values($value){
        return $this->conexion->real_escape_string($value);
    }
 	public function getError() {
 		return $this->conexion->error;
 	}
}
