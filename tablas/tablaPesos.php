<?php
session_start();
//error_reporting(0);
require_once('../modelo/funciones.php');
function fsalida($cad2){
   $uno = substr($cad2, 11, 5);
   return $uno;
}
$request = $_REQUEST;
$recepcion = $_POST['recepcion'];
$inicio = $request['start'];
$fin = $request['length'];
$busqueda = $request['search']['value'];

$listaItems = listaPesosPorRecepcion($recepcion);
$totalData = mysqli_num_rows($listaItems);
$totalFiltro = $totalData;

if (!empty($busqueda)) {
    $listaItems = listaPesosPorRecepcionPaginada($recepcion, $inicio, $fin, $busqueda);
    $totalFiltro = mysqli_num_rows($listaItems);
} else {
    $totalFiltro = $totalData;
}

$listaItems = listaPesosPorRecepcionPaginada($recepcion, $inicio, $fin, $busqueda); 

$data = array();
$cont=-1;

while ($row = mysqli_fetch_array($listaItems)) {
    
    include('../config.php');
    $sql = ("select canales from recepcion where id_recepcion =".$row[1]);
    $rs_operacion = mysqli_query($link, $sql);
    $c = mysqli_fetch_array($rs_operacion);
    
    $cont++;
    $btns = '';
    $total = $row[3] + $row[4] + $row[5] + $row[6];
    if($row[3]=='0' or $row[4]=='0' or $row[5]=='0' or $row[6]=='0'){
        $color = "#ff0000";
    }else{
        $color = "#000000";
    }
    $subdata = array();
    $subdata[] = "<font color='".$color."'>".intval($totalData-$cont)."</font>";
    $subdata[] = "<font color='".$color."'>".$row[2]."</font>";
    $subdata[] = "<font color='".$color."'>".$row[3]."     -     ".$row[4]."     -     ".$row[5]."     -     ".$row[6]."</font>";
    //$subdata[] = "<font color='".$color."'>".$row[4]."</font>";
    //$subdata[] = "<font color='".$color."'>".$row[5]."</font>";
    //$subdata[] = "<font color='".$color."'>".$row[6]."</font>";
    $subdata[] = "<font color='".$color."'>".$total."</font>";
    $subdata[] = "<font color='".$color."'>".$row[10]."</font>";
    $subdata[] = "<font color='".$color."'>".$row[8]."</font>";
    //$subdata[] = "<font color='".$color."'>".fsalida($row[9])."</font>";
    
    if(($row[8] == '1')||($_SESSION['tipo'] == 0)){
        $estadoBtn = '<a style="z-index: 0;color:#fff" onclick="buscarCriterio(\''.$row[0].'\')"><i class="bi bi-pencil-square fs-2 text-warning"></i></a>&nbsp;&nbsp;<a style="z-index: 0;color:#fff" onclick="eliminarItem(\''.$row[0].'\')"><i class="bi bi-trash-fill fs-2 text-danger"></i></a>';
    }
    
    if($row[11]!=''){
        $estadoBtn .= '<a style="z-index: 0;color:#ff8a00;margin: 5px;" onclick="buscarObservacion(\''.$row[11].'\')"><i class="bi bi-exclamation-diamond fs-2"></i></a>';
    }
    if($row[12]!=''){
        $estadoBtn .= '<a style="z-index: 0;color:#0023bc;margin: 5px;" onclick="mostrarImagen(\''.$row[12].'\')"><i class="bi bi-image fs-2"></i></i></a>';
    }
    
    $subdata[] = $estadoBtn;

    $data[] = $subdata;
}

$json_data = array(
    "draw"            => intval($request['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltro),
    "data"            => $data
);

echo json_encode($json_data);
?>
