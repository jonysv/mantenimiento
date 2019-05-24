<?php
require_once('obtenerDatos.php');
$mvcDatos=new getDatos();
switch ($_POST["op"]) {
    case '1':
    switch ($_POST["tipo"]) {
        case '1':
            $tipo="ajuste";
            break;
        
        default:
            $tipo="cambio";
            break;
    }
    switch ($_POST["parte"]) {
        case 1:
            $parte="delanteras";
            break;
        case 2:
            $parte="traseras";
            break;    
        
        default:
            $parte="todas";
            break;
    }
    switch ($_POST["marca"]) {
        case 1:
            $marca="frieck";
            break;
        
        default:
            $marca="generica";
            break;
    }

        $result=$mvcDatos->preparar("insert into mantenimiento SET fecha=STR_TO_DATE(?,'%d/%m/%Y'), hora=?, tipo=?,parte=?, marca=?",array('fecha'=>$_POST["fecha"],'hora'=>$_POST["hora"],'tipo'=>$tipo,'parte'=>$parte,'marca'=>$marca));
        $info = array('status' => 'success');
        break;

        }

        echo json_encode($info);
?>
