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
$listaItems = listaItemsPorProveedorP($proveedor);
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
    $subdata[] = $row[5];
    if(($row[0] == '050514')||($row[0] == '050515')||($row[0] == '050516')||($row[0] == '050517')){
        $subdata[] = $row[9]."Kg. <br>(".$row[6]."-".($row[5]*2)."-".(($row[12]*1.8)/4).")";
    }else{
        $subdata[] = $row[9]."Kg. <br>(".$row[6]."-".($row[5]*2)."-".(($row[12]*1.8)).")";
    }
    
    $subdata[] = fsalida($row[7]);
    
    if(($row[10] == '1')||($_SESSION['tipo'] == 0)){
        if(($row[0] == '050514')||($row[0] == '050515')||($row[0] == '050516')||($row[0] == '050517')){
            $estadoBtn = '<i class="bi bi-pencil-square fs-2 text-warning" style="visibility: hidden;"></i>&nbsp;&nbsp;<a style="z-index: 0;color:#fff" onclick="eliminarItem(\''.$row[8].'\')"><i class="bi bi-trash-fill fs-2 text-danger"></i></a>';
        }else{
            $estadoBtn = '<a style="z-index: 0;color:#fff" onclick="buscarCriterio(\''.$row[8].'\')"><i class="bi bi-pencil-square fs-2 text-warning"></i></a>&nbsp;&nbsp;<a style="z-index: 0;color:#fff" onclick="eliminarItem(\''.$row[8].'\')"><i class="bi bi-trash-fill fs-2 text-danger"></i></a>';
        }
        
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
