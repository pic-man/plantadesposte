<?php
session_start();
//error_reporting(0);
require_once('../modelo/funciones.php');
function fsalida($cad2){
   $uno = substr($cad2, 11, 5);
   return $uno;
}
$request = $_REQUEST;
$proveedor = $_POST['proveedor'];
$inicio = $request['start'];
$fin = $request['length'];
$busqueda = $request['search']['value'];

//inicia nuevo
$listaItems = listaItemsPorProveedorP2($proveedor);
$totalData = mysqli_num_rows($listaItems);
$totalFiltro = $totalData;

if (!empty($busqueda)) {
    
    $listaItems = listaItemsPorProveedorPPaginada($proveedor,$inicio, $fin, $busqueda);
    $totalFiltro = mysqli_num_rows($listaItems);
} else {
    $totalFiltro = $totalData;
}

$data = array();
$cont=0;
while ($row = mysqli_fetch_array($listaItems)) {
    $cont++;
    $btns = '';
    $subdata = array();
    $subdata[] = $cont;
    $subdata[] = $row[0];
    $subdata[] = $row[1];
    $subdata[] = $row[2];
    $subdata[] = $row[3];
    $subdata[] = $row[4];
    $subdata[] = $row[8]."Kg. <br>(".$row[5]."-".($row[4]*2)."-".(($row[11]*1.8)).")";
    
    $subdata[] = fsalida($row[6]);
    
    if(($row[9] == '1')||($_SESSION['tipo'] == 0)){
        $estadoBtn = '<a style="z-index: 0;color:#fff" onclick="buscarCriterio(\''.$row[7].'\')"><i class="bi bi-pencil-square fs-2 text-warning"></i></a>&nbsp;&nbsp;<a style="z-index: 0;color:#fff" onclick="eliminarItem(\''.$row[7].'\')"><i class="bi bi-trash-fill fs-2 text-danger"></i></a>';
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
