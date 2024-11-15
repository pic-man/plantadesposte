<?php
session_start();
error_reporting(0);
require_once('../modelo/funciones.php');
$request = $_REQUEST;
$inicio = $request['start'];
$fin = $request['length'];
$busqueda = $request['search']['value'];

$listaProveedores = listaProveedoresPCompleta();
$totalData = mysqli_num_rows($listaProveedores);

if (!empty($busqueda)) {
    $listaProveedores = listaProveedoresPPaginada($inicio, $fin, $busqueda);
    $totalFiltro = mysqli_num_rows($listaPrecios);
} else {
    $totalFiltro = $totalData;
}

$listaProveedores = listaProveedoresPPaginada($inicio, $fin, $busqueda); 
$data = array();
$cont=0;
while ($row = mysqli_fetch_array($listaProveedores)) {
    $unidades = 0;
    

    $upcc = 0; //pollo completo campesino
    $upcb = 0; //pollo completo blanco
    $upec = 0; //pollo entero campesino
    $upecb = 0; //pollo entero blanco
    $upap = 0; //pollo apanado
    $upas = 0; //pollo asado

    include('../config.php');
    
    $sqlitem = ("SELECT item
                 FROM item_proveedorpollo
                 WHERE item IN ('059762','059760','059761')
                 AND proveedor = ".$row[7]."
                 LIMIT 1");
    $rs_item = mysqli_query($link, $sqlitem);
    
    if($c_item = mysqli_fetch_array($rs_item)){
        
        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item ='059762' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);

        $unidades = $c['unidades'] / 2;

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '059760' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades2 = $c['unidades'];

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '059761' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades3 = $c['unidades'] / 2;
    
        if (!(($unidades == $unidades2)&&($unidades2 == $unidades3))){
            $upcb = 0;
        }else{
            $upcb = $unidades;
        }
        $tipo_pollo = 'CRUDO';
    }

    $sqlitem2 = ("SELECT item
                 FROM item_proveedorpollo
                 WHERE item IN ('059758','059756','059757')
                 AND proveedor = ".$row[7]."
                 LIMIT 1");
    $rs_item2 = mysqli_query($link, $sqlitem2);
    
    if($c_item2 = mysqli_fetch_array($rs_item2)){
        
        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item ='059758' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);

        $unidades4 = $c['unidades'] / 2;

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '059756' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades5 = $c['unidades'];

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '059757' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades6 = $c['unidades'] / 2;
    
        if (!(($unidades4 == $unidades5)&&($unidades5 == $unidades6))){
            $upcc = 0;
        }else{
            $upcc = $unidades4;
        }
    }

    $sqlitem3 = ("SELECT item
                 FROM item_proveedorpollo
                 WHERE item IN ('050514','050515','050516','050517')
                 AND proveedor = ".$row[7]."
                 LIMIT 1");
    $rs_item3 = mysqli_query($link, $sqlitem3);
    
    if($c_item3 = mysqli_fetch_array($rs_item3)){
        
        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item ='050514' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);

        $unidades7 = $c['unidades'] / 2;

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '050515' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades8 = $c['unidades'] / 2;

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '050516' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades9 = $c['unidades'] / 2;

        $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '050517' and proveedor = ".$row[7]."");
        $rs_operacion = mysqli_query($link, $sql);
        $c = mysqli_fetch_array($rs_operacion);
    
        $unidades10 = $c['unidades'] / 2;
    
        if (!(($unidades7 == $unidades8)&&($unidades8 == $unidades9)&&($unidades9 == $unidades10))){
            $upap = 0;
        }else{
            $upap = $unidades7;
        }
    }

    $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '059755' and proveedor = ".$row[7]."");
    $rs_operacion = mysqli_query($link, $sql);
    $c = mysqli_fetch_array($rs_operacion);
    $upec = $c['unidades'];

    $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '059759' and proveedor = ".$row[7]."");
    $rs_operacion = mysqli_query($link, $sql);
    $c = mysqli_fetch_array($rs_operacion);
    $upeb = $c['unidades'];

    $sql = ("select sum(unidades)as unidades from item_proveedorpollo where item = '050513' and proveedor = ".$row[7]."");
    $rs_operacion = mysqli_query($link, $sql);
    $c = mysqli_fetch_array($rs_operacion);
    $upas = $c['unidades'];
    
    $cont++;
    $btns = '';
    $subdata = array();
    

    //$upcc  = pollo completo campesino
    //$upcb  = pollo completo blanco
    //$upec  = pollo entero campesino
    //$upeb = pollo entero blanco
    //$upap  = pollo apanado
    //$upas  = pollo asado

    $ut=0;

    $ut = intval($upcc) + intval($upcb) + intval($upec) + intval($upeb) + intval($upap) + intval($upas);

    if ((intval($upap)==0)&&(intval($upas)==0)){
        $tipo_pollo = "CRUDO";     
    }else{
        $tipo_pollo = "ASADERO";
    }    

    //if($ut == ''){$ut='0';}
    
    $subdata[] = '<center>'.$row[7].'<br>'.$row[6].' - '.$tipo_pollo.'</center>';
    
    $subdata[] = '<center><a style="z-index: 0;color:#000" data-bs-target="#modalCriterios" onclick="abrirModal(\''.$row[7].'\',\''.$row[8].'\',\''.$row[10].'\',\''.$_SESSION['tipo'].'\'); buscarItems(\''.$row[7].'\',\''.$row[6].'\');" data-bs-toggle="modal">'.$row[1].' <br> '.$ut.'/'.$row[11].'</a></center>';
    
    $subdata[] = '<center><a style="z-index: 0;color:#000" data-bs-target="#modalCriterios" onclick="abrirModal(\''.$row[7].'\',\''.$row[8].'\',\''.$row[10].'\',\''.$_SESSION['tipo'].'\'); buscarItems(\''.$row[7].'\',\''.$row[6].'\');" data-bs-toggle="modal">'.$row[9].' <br> '.$row[3].'</a></center>';
    
    $subdata[] = '<center><a style="z-index: 0;color:#000" data-bs-target="#modalCriterios" onclick="abrirModal(\''.$row[7].'\',\''.$row[8].'\',\''.$row[10].'\',\''.$_SESSION['tipo'].'\'); buscarItems(\''.$row[7].'\',\''.$row[6].'\');" data-bs-toggle="modal">'.$row[4].' <br> '.$row[5].'</a></center>';
    
    if($_SESSION['tipo'] == 0){
        $estadoBtn = '<center>
        <a style="z-index: 0;color:#000" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor" onclick="buscarGuia(\''.$row[7].'\',\''.$row[6].'\')"><i class="bi bi-pencil-square fs-2 text-warning me-3"></i></a>';
    
        $estadoBtn .='<a style="z-index: 0;color:#000" href="controlador/preliminarpollopdf.php?id='.$row[7].'" target="_blank"><i class="bi bi-eye fs-2 me-3" style="color:#00a45f;"></i></a>';

        $estadoBtn .='<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[7].'\')" href="controlador/imprimirpollopdf.php?id='.$row[7].'" target="_blank"><i class="bi bi-printer fs-2 me-3 text-primary"></i></a>';

        if($row[10] == '1'){
            $estadoBtn .='<a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[7].'\')" ><i class="bi bi-unlock fs-2 style="color:#ff0000;"></i></a></center>';
        }else{
            $estadoBtn .='<a style="z-index: 0;color:#000" onclick="desbloquearEdicion(\''.$row[7].'\')"><i class="bi-lock fs-2 style="color:#00a45f;"></i></a></center>';
        }
    }else{
        $estadoBtn = '<center>';
        if($row[10] == '1'){
            $estadoBtn = '
        <a style="z-index: 0;color:#000" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor" onclick="buscarGuia(\''.$row[7].'\',\''.$row[6].'\')"><i class="bi bi-pencil-square fs-2 text-warning me-3"></i></a>';
        }else{
            $estadoBtn .= '<i class="bi bi-printer fs-2 me-3" style="visibility: hidden;"></i>';
        }

        $estadoBtn .='<a style="z-index: 0;color:#000" href="controlador/preliminarpollopdf.php?id='.$row[7].'" target="_blank"><i class="bi bi-eye fs-2 me-3" style="color:#00a45f;"></i></a>';

        if($ut == $row[11]){
            $estadoBtn .= '
            <a style="z-index: 0;color:#000" onclick="bloquearEdicion(\''.$row[7].'\')" href="controlador/imprimirpollopdf.php?id='.$row[7].'"><i class="bi bi-printer fs-2 text-primary"></i></a>';
        }else{
            $estadoBtn .= '<i class="bi bi-printer fs-2" style="visibility: hidden;"></i>';
        }     
        $estadoBtn .= '</center>';
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