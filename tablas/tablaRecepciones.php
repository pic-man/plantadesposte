<?php
session_start();
error_reporting(0);
require_once('../modelo/funciones.php');
$request = $_REQUEST;
$inicio = $request['start'];
$fin = $request['length'];
$busqueda = $request['search']['value'];

$listaProveedores = listaRecepcionesCompleta();
$totalData = mysqli_num_rows($listaProveedores);

if (!empty($busqueda)) {
    $listaProveedores = listaRecepcionesPaginada($inicio, $fin, $busqueda);
    $totalFiltro = mysqli_num_rows($listaProveedores);
} else {
    $totalFiltro = $totalData;
}

$listaProveedores = listaRecepcionesPaginada($inicio, $fin, $busqueda); 
$data = array();
$cont=0;
while ($row = mysqli_fetch_array($listaProveedores)) {
    
    include('../config.php');
    $sql = ("select count(turno)as canales from recepcion_pesos where id_recepcion =".$row[0]);
    $rs_operacion = mysqli_query($link, $sql);
    $c = mysqli_fetch_array($rs_operacion);
    
    $canales = $c['canales'];
    $cont++;
    $btns = '';
    $subdata = array();
    $subdata[] = '<center>'.$row[0].'<br>'.$row[8].'</center>';
    
    $subdata[] = '<center><a style="z-index: 0;color:#000" data-bs-target="#modalCriterios" onclick="abrirModal(\''.$row[0].'\',\''.$row[9].'\',\''.$_SESSION['tipo'].'\',\''.$row[8].'\',\''.$row[5].'\'); buscarItems(\''.$row[0].'\',\''.$row[8].'\');" data-bs-toggle="modal">'.$row[1].'<br>'.$row[2].'</a></center>';
    
    $subdata[] = '<center><a style="z-index: 0;color:#000" data-bs-target="#modalCriterios" onclick="abrirModal(\''.$row[0].'\',\''.$row[9].'\',\''.$_SESSION['tipo'].'\',\''.$row[8].'\',\''.$row[5].'\'); buscarItems(\''.$row[0].'\',\''.$row[8].'\');" data-bs-toggle="modal">'.$row[3].'<br>'.$row[4].'</a></center>';

    $subdata[] = '<center><a style="z-index: 0;color:#000" data-bs-target="#modalCriterios" onclick="abrirModal(\''.$row[0].'\',\''.$row[9].'\',\''.$_SESSION['tipo'].'\',\''.$row[8].'\',\''.$row[5].'\'); buscarItems(\''.$row[0].'\',\''.$row[8].'\');" data-bs-toggle="modal">'.$canales.'/'.$row[5].'<br>'.$row[6].'</a></center>';

if($_SESSION['tipoR'] != 2){    
    if(($_SESSION['tipo'] == 0)){
        $estadoBtn = '
        <a style="z-index: 0;color:#000;" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor" onclick="buscarGuia(\''.$row[0].'\')"><i class="bi bi-pencil-square fs-2 me-3 text-warning"></i></a>';

        if($canales == $row[5]){ 
            if($row[8] == 'RES'){
                $estadoBtn .= '<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" href="controlador/imprimiringresopdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2  me-3 text-primary"></i></a>';
            }else{
                $estadoBtn .= '<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" href="controlador/imprimiringresoCerdopdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2 me-3 text-primary"></i></a>';
            }  
        }else{
            $estadoBtn .= '<i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
        } 

        if($row[9] == '1'){
            $estadoBtn .='<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" ><i class="bi bi-unlock fs-2 me-3 style="color:#ff0000;"></i></a></center>';
        }else{
            $estadoBtn .='<a style="z-index: 0;color:#000" onclick="desbloquearEdicion(\''.$row[0].'\')"><i class="bi-lock fs-2 me-3 style="color:#00a45f;"></i></a></center>';
        }
        
    }else{

        if($row[8] == 'RES'){
            if($row[9] == '1'){
                $estadoBtn = '
                <a style="z-index: 0;color:#000;" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor" onclick="buscarGuia(\''.$row[0].'\')"><i class="bi bi-pencil-square fs-2 me-3 text-warning"></i></a>';
                if($canales == $row[5]){
                    $estadoBtn .= '<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" href="controlador/imprimiringresopdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2 me-3 text-primary"></i></a>';
                }else{
                    $estadoBtn .= '<i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
                }
            }else{
                $estadoBtn = '
                <i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
                if($canales == $row[5]){
                    $estadoBtn = '<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" href="controlador/imprimiringresopdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2 me-3 text-primary"></i></a>';
                }else{
                    $estadoBtn .= '<i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
                }
            }    
          }else{
             if($row[9] == '1'){
                $estadoBtn = '
                <a style="z-index: 0;color:#000;" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor" onclick="buscarGuia(\''.$row[0].'\')"><i class="bi bi-pencil-square fs-2 me-3 text-warning"></i></a>';

                if($canales == $row[5]){
                    $estadoBtn .= '<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" href="controlador/imprimiringresoCerdopdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2 me-3 text-primary"></i></a>';
                }else{
                    $estadoBtn .= '<i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
                }    
             }else{
                $estadoBtn = '
                <i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
                if($canales == $row[5]){
                    $estadoBtn .= '<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[0].'\')" href="controlador/imprimiringresoCerdopdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2 me-3 text-primary"></i></a>';
                }else{
                    $estadoBtn .= '<i class="bi bi-pencil-square fs-2 me-3 text-warning" style="visibility: hidden;""></i>';
                } 
             }   
          }
            
        
        if($row[11]!=''){
            $estadoBtn .= '<a style="z-index: 0;color:#ff8a00;margin: 5px;" onclick="buscarObservacion(\''.$row[11].'\')"><i class="bi bi-exclamation-diamond fs-2"></i></a>';
        }
        if($row[12]!=''){
            $estadoBtn .= '<a style="z-index: 0;color:#0023bc;margin: 5px;" onclick="mostrarImagen(\''.$row[12].'\')"><i class="bi bi-image fs-2"></i></i></a>';
        }
    }
}else{

    include('../config.php');
    $sql = ("select count(turno) as listos from recepcion_pesos where id_recepcion =".$row[0]." and inventario>0");
    $rs_operacion = mysqli_query($link, $sql);
    $c_registros = mysqli_fetch_array($rs_operacion);
    if($row[5]==$c_registros['listos']){
        $estadoBtn = '<a style="z-index: 0;color:#000" href="controlador/imprimirdiferenciaspdf.php?id='.$row[0].'" target="_blank"><i class="bi bi-printer fs-2 text-primary"></i></a>';
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
