<?php
 //session_start();
 error_reporting(0);
 date_default_timezone_set("America/bogota"); 

 function listaResponsablesCompleta($inicio,$fin,$busqueda){   
    include('../config.php');
    $sql = "SELECT `cedula`,`nombres`,`telefono`,`status`,`id` FROM `responsables` WHERE tipo<>0";
    
    if (!empty($busqueda)) {
        $sql .= " WHERE nombres LIKE '%$busqueda%'";
    }

    $sql .= " ORDER BY id DESC";

    $sql .= " LIMIT $inicio, $fin";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        /* echo "Error al ejecutar la consulta 1: " . mysqli_error($link); */
        echo $sql;
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
function listaConductoresCompleta($inicio,$fin,$busqueda){   
    include('../config.php');
    $sql = "SELECT `cedula`,`nombres`,`telefono`,`status`,`id` FROM `conductores`";
    
    if (!empty($busqueda)) {
        $sql .= " WHERE nombres LIKE '%$busqueda%'";
    }

    $sql .= " ORDER BY id DESC";

    $sql .= " LIMIT $inicio, $fin";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        /* echo $sql; */
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaPlacasCompleta($inicio,$fin,$busqueda){   
    include('../config.php');
    $sql = "SELECT `placa`,`status`,`id` FROM `placas`";
    
    if (!empty($busqueda)) {
        $sql .= " WHERE placa LIKE '%$busqueda%'";
    }

    $sql .= " ORDER BY id DESC";

    $sql .= " LIMIT $inicio, $fin";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        /* echo "Error al ejecutar la consulta 1: " . mysqli_error($link); */
        echo $sql;
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaResponsables(){   
    include('config.php');
    $sql = "SELECT cedula,nombres FROM responsables where status='ACTIVO'";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaTipos(){   
    include('config.php');
    $sql = "SELECT id,descripcion FROM tipo where status='ACTIVO'";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaMunicipios(){   
    include('config.php');
    $sql = "SELECT descripcion FROM municipios";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaCategorias(){   
    include('config.php');
    $sql = "SELECT id,descripcion FROM categoria where status='ACTIVO'";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaSubCategorias(){   
    include('config.php');
    $sql = "SELECT id,descripcion FROM categoriadestino where status='ACTIVO'";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaConductores()
{   include('config.php');

        $sql = "SELECT cedula,nombres FROM conductores order by nombres asc";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaConductores_recepcion(){   
    include('config.php');
    $sql = "SELECT cedula, nombres FROM conductores_recepcion ORDER BY nombres asc";
    $rs_operacion = mysqli_query($link, $sql);
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaConductores_recepcion_pollo(){   
    include('config.php');
    $sql = "SELECT cedula, nombres FROM conductores_recepcion_pollo ORDER BY nombres asc";
    $rs_operacion = mysqli_query($link, $sql);
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaConductores_recepcion_registro(){   
    include('../config.php');
    $sql = "SELECT empresa,cedula,nombres FROM conductores_recepcion";
    $rs_operacion = mysqli_query($link, $sql);
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
           $items[] = $row;
        }
        return $items;
    }  
}

function listaConductores_recepcion_registro_pollo(){   
    include('../config.php');
    $sql = "SELECT empresa,cedula,nombres FROM conductores_recepcion_pollo";
    $rs_operacion = mysqli_query($link, $sql);
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
           $items[] = $row;
        }
        return $items;
    }  
}

function listaPlacas()
{   include('config.php');

        $sql = "SELECT placa FROM placas order by placa asc";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaPlacas_recepcion(){   
    include('config.php');
    $sql = "SELECT placa FROM placas_recepcion ORDER BY placa ASC";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaPlacas_recepcion_pollo(){   
    include('config.php');
    $sql = "SELECT placa FROM placas_recepcion_pollo ORDER BY placa ASC";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaPlacas_recepcion_registro(){   
    include('../config.php');
    $sql = "SELECT placa FROM placas_recepcion";
    $rs_operacion = mysqli_query($link, $sql);
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 2: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function listaPlacas_recepcion_registro_pollo(){   
    include('../config.php');
    $sql = "SELECT placa FROM placas_recepcion_pollo";
    $rs_operacion = mysqli_query($link, $sql);
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 2: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function listaDestinos(){   
    include('config.php');
    $sql = "SELECT id,empresa,sede FROM destinos";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}
function listaOrigen(){   
    include('config.php');
    $sql = "SELECT id,nit,sede FROM beneficio";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaProveedores(){   
    include('config.php');
    $sql = "SELECT id,nit,sede FROM proveedorpollo";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
    }  
}

function listaProveedoresCCompleta(){   
    include('../config.php');

    $sql = "SELECT codigog,
                   fechaexp,
                   responsables.nombres as responsable,
                   destinos.sede as sede,
                   conductores.nombres as conductor,
                   placa,
                   guias.tipo,
                   id_guia,
                   consecutivog,
                   destinos.empresa as empresa,
                   guias.status
                FROM guias
                INNER JOIN 
                    responsables ON guias.responsable = responsables.cedula
                INNER JOIN 
                    destinos ON guias.destino = destinos.id
                INNER JOIN 
                    conductores ON guias.conductor = conductores.cedula
                WHERE
                    guias.tipo <> 'POLLO'";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
function listaProveedoresPCompleta(){   
    include('../config.php');

    $sql = "SELECT codigog,
                   fechaexp,
                   responsables.nombres as responsable,
                   destinos.sede as sede,
                   conductores.nombres as conductor,
                   placa,
                   guiaspollo.tipo,
                   id_guia,
                   consecutivog,
                   destinos.empresa as empresa,
                   guiaspollo.status,
                   canales
            FROM guiaspollo
            INNER JOIN 
                    responsables ON guiaspollo.responsable = responsables.cedula
            INNER JOIN 
                    destinos ON guiaspollo.destino = destinos.id
            INNER JOIN 
                    conductores ON guiaspollo.conductor = conductores.cedula";
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaRecepcionesCompleta()
{   include('../config.php');

    $sql = "SELECT id_recepcion,
                   fecharec,
                   remision,
                   beneficio.sede as sedeb,
                   destinos.sede as sede,
                   canales,
                   consecutivog,
                   fechasac,
                   tipo,
                   recepcion.status
                FROM recepcion
                INNER JOIN 
                    beneficio ON recepcion.beneficio = beneficio.id
                INNER JOIN 
                    destinos ON recepcion.destino = destinos.id";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
function listaRecepcionesPaginada($inicio, $fin, $busqueda)
{   include('../config.php');

    $sql = "SELECT id_recepcion,
    fecharec,
    remision,
    beneficio.sede as sedeb,
    destinos.sede as sede,
    canales,
    consecutivog,
    fechasac,
    tipo,
    recepcion.status
 FROM recepcion
 INNER JOIN 
     beneficio ON recepcion.beneficio = beneficio.id
 INNER JOIN 
     destinos ON recepcion.destino = destinos.id";

        if (!empty($busqueda)) {
            $sql .= " WHERE (fecharec LIKE '%$busqueda%'";
            $sql .= " OR fechasac LIKE '%$busqueda%'";
            $sql .= " OR destinos.sede LIKE '%$busqueda%'";
            $sql .= " OR remision LIKE '%$busqueda%'";
            $sql .= " OR canales LIKE '%$busqueda%'";
            $sql .= " OR tipo LIKE '%$busqueda%'";
            $sql .= " OR placa LIKE '%$busqueda%')";
        }
    
        $sql .= " ORDER BY id_recepcion DESC";
    
        $sql .= " LIMIT $inicio, $fin";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
/*function listaProveedoresConFiltro($busqueda)
{   include('../config.php');

        $sql = "SELECT nit,razon_social,telefono FROM proveedores";

        if (!empty($busqueda)) {
            $sql .= " WHERE razon_social LIKE '%$busqueda%'";
        }
        $sql .= " ORDER BY razon_social ASC";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
*/

function cargarGuiaRecepcion($idRecepcion){
    include('../config.php');
        
    $sql = "SELECT fecharec,
                   fechasac,
                   tipo,
                   remision,
                   beneficio,
                   destino,
                   canales,
                   recibo,
                   consecutivog,
                   fechasac,
                   tipo,
                   status,
                   responsable,
                   conductor,
                   placa,
                   lotep,
                   ica,
                   guiat,
                   certificadoc,
                   cph1,
                   cph2,
                   cph3,
                   cph4,
                   cph5,
                   chv1,
                   chv2,
                   chv3,
                   chv4,
                   ccoh1,
                   ccoh2,
                   ccoh3,
                   ccoh4,
                   ccoh5,
                   ccoh6,
                   ccoh7,
                   ccoh8,
                   ccoh9,
                   ccoh10,
                   observaciones
                FROM recepcion
                WHERE
                    id_recepcion=".$idRecepcion."";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}
function cargarDatos(){
    include('../config.php');
        
    $sql = "SELECT id_recepcion,
                   fecharec,
                   fechasac,
                   tipo,
                   remision,
                   beneficio,
                   destino,
                   canales,
                   recibo,
                   consecutivog,
                   fechasac,
                   tipo,
                   status,
                   responsable,
                   conductor,
                   placa,
                   lotep,
                   ica,
                   guiat,
                   certificadoc,
                   cph1,
                   cph2,
                   cph3,
                   cph4,
                   cph5,
                   chv1,
                   chv2,
                   chv3,
                   chv4,
                   ccoh1,
                   ccoh2,
                   ccoh3,
                   ccoh4,
                   ccoh5,
                   ccoh6,
                   ccoh7,
                   ccoh8,
                   ccoh9,
                   ccoh10,
                   observaciones
                FROM recepcion
                ORDER BY id_recepcion DESC
                LIMIT 1";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarGuia($idGuia){
    include('../config.php');
        $sql = "SELECT codigog,
        fechaexp,
        responsable,
        destino,
        conductor,
        placa,
        tipo,
        id_guia,
        consecutivog,
        canales,
        observaciones,
        precinto
    FROM 
        guias
    INNER JOIN 
        destinos ON guias.destino = destinos.id
    INNER JOIN 
        conductores ON guias.conductor = conductores.cedula
    WHERE
        id_guia=".$idGuia;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarGuiaP($idGuia){
    include('../config.php');
        $sql = "SELECT codigog,
        fechaexp,
        responsable,
        destino,
        conductor,
        placa,
        tipo,
        id_guia,
        consecutivog,
        canales,
        observaciones,
        precinto
    FROM 
        guiaspollo
    INNER JOIN 
        destinos ON guiaspollo.destino = destinos.id
    INNER JOIN 
        conductores ON guiaspollo.conductor = conductores.cedula
    WHERE
        id_guia=".$idGuia;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarResponsable($idResp){
    include('../config.php');
        $sql = "SELECT cedula,
        nombres,
        telefono,
        status
    FROM 
        responsables
    WHERE
        id=".$idResp;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarConductor($idCond){
    include('../config.php');
        $sql = "SELECT cedula,
        nombres,
        telefono,
        status
    FROM 
        conductores
    WHERE
        id=".$idCond;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarItem($idItem){
    include('../config.php');
        $sql = "SELECT item,
        descripcion,
        codigo,
        tipo,
        categoria,
        categoriadestino,
        status,
        id
    FROM 
        plantilla
    WHERE
        id=".$idItem;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarResponsables($idResponsables){
    include('../config.php');
        $sql = "SELECT cedula,
        nombres,
        telefono,
        status,
        id
    FROM 
        responsables
    WHERE
        id=".$idResponsables;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarPlanta($idResponsables){
    include('../config.php');
        $sql = "SELECT nit,
        sede,
        direccion,
        municipio,
        status,
        id
    FROM 
        beneficio
    WHERE
        id=".$idResponsables;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarProveedor($idPlanta){
    include('../config.php');
        $sql = "SELECT nit,
        sede,
        direccion,
        municipio,
        polloporcanastillas,
        status,
        id
    FROM 
        proveedorpollo
    WHERE
        id=".$idPlanta;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarPlacasD($idPlacasD){
    include('../config.php');
        $sql = "SELECT placa,
        status,
        id
    FROM 
        placas
    WHERE
        id=".$idPlacasD;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarConductores($idResponsables){
    include('../config.php');
        $sql = "SELECT cedula,
        nombres,
        telefono,
        status,
        id
    FROM 
        conductores
    WHERE
        id=".$idResponsables;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarCriterio($idcriterio){
    include('../config.php');
        $sql = "SELECT id_item_proveedor,
        plantilla.descripcion as item,
        proveedor,
        lote,
        temperatura,
        unidades,
        cajas,
        peso
    FROM 
        item_proveedor
    INNER JOIN 
        plantilla ON plantilla.item = item_proveedor.item    
    WHERE
        id_item_proveedor=".$idcriterio;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarCriterioP($idcriterio){
    include('../config.php');
        $sql = "SELECT id_item_proveedor,
        plantilla.descripcion as item,
        proveedor,
        lote,
        temperatura,
        unidades,
        cajas,
        peso,
        base
    FROM 
        item_proveedorpollo
    INNER JOIN 
        plantilla ON plantilla.item = item_proveedorpollo.item    
    WHERE
        id_item_proveedor=".$idcriterio;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function cargarCriterioPeso($idcriterio){
    include('../config.php');
        $sql = "SELECT id_recepcion_pesos,
        turno,
        estomago1,
        estomago2,
        piernas1,
        piernas2,
        temperatura
    FROM 
        recepcion_pesos
    WHERE
        id_recepcion_pesos=".$idcriterio;

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
    }else{        
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        return $items;
    }  
}

function editarGuia($info){
    include('../config.php');
      $sql = "UPDATE guias set 
              fechaexp = '".$info['fechaexp']."',canales='".$info['canales']."',consecutivog='".$info['consecutivog']."',responsable='".$info['responsable']."',destino = '".$info['destino']."',conductor = '".$info['conductor']."',placa = '".$info['placa']."',tipo = '".$info['producto']."',precinto = '".$info['precinto']."',observaciones='".$info['observaciones']."' where id_guia = ".$info['id_guia'];
      
      $rs_operacion=mysqli_query($link,$sql);

      $sql2 = "UPDATE item_proveedor set 
              lote = '".$info['consecutivog']."' where proveedor = ".$info['id_guia'];
      
      $rs_operacion2=mysqli_query($link,$sql2);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $info['id_guia'];
     } 
}

function editarGuiaP($info){
    include('../config.php');
      $sql = "UPDATE guiaspollo set 
              fechaexp = '".$info['fechaexp']."',canales='".$info['canales']."',responsable='".$info['responsable']."',destino = '".$info['destino']."',conductor = '".$info['conductor']."',placa = '".$info['placa']."',precinto = '".$info['precinto']."',observaciones='".$info['observaciones']."' where id_guia = ".$info['id_guia'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        //return mysqli_error($link);
        return $sql;
    }else{        
        return $info['id_guia'];
     } 
}

function editarRecepcion($datosEdit){
    include('../config.php');
      $sql = "UPDATE recepcion set 
                fecharec= '".$datosEdit['fecharec']."',
                fechasac= '".$datosEdit['fechasac']."',
                tipo= '".$datosEdit['tipo']."',
                remision= '".$datosEdit['remision']."',
                canales= '".$datosEdit['canales']."',
                recibo='".$datosEdit['despacho']."',
                consecutivog= '".$datosEdit['consecutivog']."',
                responsable= '".$datosEdit['responsable']."',
                beneficio= '".$datosEdit['beneficio']."',
                destino= '".$datosEdit['destino']."',
                conductor= '".$datosEdit['conductor']."',
                placa= '".$datosEdit['placa']."',
                lotep= '".$datosEdit['lotep']."',
                ica= '".$datosEdit['ica']."',
                guiat= '".$datosEdit['guiat']."',
                cph1= '".$datosEdit['cph1']."',
                cph2= '".$datosEdit['cph2']."',
                cph3= '".$datosEdit['cph3']."',
                cph4= '".$datosEdit['cph4']."',
                cph5= '".$datosEdit['cph5']."',
                chv1= '".$datosEdit['chv1']."',
                chv2= '".$datosEdit['chv2']."',
                chv3= '".$datosEdit['chv3']."',
                chv4= '".$datosEdit['chv4']."',
                ccoh1= '".$datosEdit['ccoh1']."',
                ccoh2= '".$datosEdit['ccoh2']."',
                ccoh3= '".$datosEdit['ccoh3']."',
                ccoh4= '".$datosEdit['ccoh4']."',
                ccoh5= '".$datosEdit['ccoh5']."',
                ccoh6= '".$datosEdit['ccoh6']."',
                ccoh7= '".$datosEdit['ccoh7']."',
                ccoh8= '".$datosEdit['ccoh8']."',
                ccoh9= '".$datosEdit['ccoh9']."',
                ccoh10= '".$datosEdit['ccoh10']."',
                observaciones= '".$datosEdit['observaciones']."'
                where id_recepcion = ".$datosEdit['id_guia'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $info['id_guia'];
     } 
}

function editarResponsable($info){
    include('../config.php');
      $sql = "UPDATE responsables set 
              cedula = '".$info['cedula']."',nombres='".$info['nombres']."',telefono='".$info['telefono']."',status='".$info['status']."' where id = ".$info['id_guia'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $info['id_guia'];
     } 
}

function editarPlacasD($info){
    include('../config.php');
      $sql = "UPDATE placas set 
              placa = '".$info['placa']."',status='".$info['status']."' where id = ".$info['id'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $info['id'];
     } 
}
function editarConductores($info){
    include('../config.php');

    $sql = "UPDATE conductores set 
            cedula = '".$info['cedula']."',
            nombres ='".$info['nombres']."',
            telefono='".$info['telefono']."',
            status='".$info['status']."'
            where id = ".$info['id'];
    
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
      //return mysqli_error($link);
        return $sql;  
  }else{        
      return $info['id_guia'];
   } 
}

function editarItem($info){
    include('../config.php');
    
      $sql = "UPDATE plantilla set 
              item = '".$info['item']."',
              descripcion='".$info['descripcion']."',
              codigo='".$info['codigo']."',
              tipo='".$info['tipo']."',
              categoria='".$info['categoria']."',
              categoriadestino='".$info['subcategoria']."',
              status='".$info['status']."'
              where id = ".$info['id'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $info['id_guia'];
     } 
}

function editarResponsables($info){
      include('../config.php');
      
      $clave = md5($info['clave']); 

      $sql = "UPDATE responsables set 
              cedula = '".$info['cedula']."',
              nombres ='".$info['nombres']."',
              telefono='".$info['telefono']."',
              clave='".$clave."',
              status='".$info['status']."'
              where id = ".$info['id'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        //return mysqli_error($link);
          return $sql;  
    }else{        
        return $info['id_guia'];
     } 
}

function editarPlanta($info){
    include('../config.php');
    
    $sql = "UPDATE beneficio set 
            nit = '".$info['nit']."',
            sede ='".$info['razon']."',
            direccion ='".$info['direccion']."',
            municipio ='".$info['municipio']."',
            status='".$info['status']."'
            where id = ".$info['id'];
    
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
      //return mysqli_error($link);
        return $sql;  
  }else{        
      return $info['id_guia'];
   } 
}

function editarProveedorPollo($info){
    include('../config.php');
    
    $sql = "UPDATE proveedorpollo set 
            nit = '".$info['nit']."',
            sede ='".$info['razon']."',
            direccion ='".$info['direccion']."',
            municipio ='".$info['municipio']."',
            polloporcanastillas ='".$info['polloporcanastillas']."',
            status='".$info['status']."'
            where id = ".$info['id'];
    
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
      //return mysqli_error($link);
        return $sql;  
  }else{        
      return $info['id_guia'];
   } 
}

function editarCriterio($infoCriEdit){
    include('../config.php');
    $peso_real = $infoCriEdit['peso'] - ($infoCriEdit['cajas'] * 2);
    $sql = "UPDATE item_proveedor set 
              item = '".$infoCriEdit['item']."',lote='".$infoCriEdit['lote']."',temperatura='".$infoCriEdit['temperatura']."',unidades = '".$infoCriEdit['unidades']."',cajas = '".$infoCriEdit['cajas']."',peso = '".$infoCriEdit['peso']."',peso_real = '".$peso_real."' where id_item_proveedor = ".$infoCriEdit['id_criterio'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $infoCriEdit['id_criterio'];
     } 
}

function editarCriterioP($datos){
    
    include('../config.php');
    $hora = date("Y-m-d H:i:s");
    $peso_base = round($datos['base'] *1.8);
    if($datos['item'] != '999999'){
        /* $peso_real = number_format(round($datos['peso'] - ($datos['cajas'] * 2) - ($datos['base'] *1.8)),2,",","."); */
        $peso_real = number_format($datos['peso'] - (($datos['cajas']) * 2) - (($datos['base'] *1.8)),2,",","."); 
        
        /* $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$datos['item']."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$datos['unidades']."',
                        '".$datos['cajas']."',
                        '".$datos['base']."',
                        '".$datos['peso']."',
                        '".$peso_real."',
                        '".$hora."'
                       );"; */

        $sql = "UPDATE item_proveedorpollo set 
                       item = '".$datos['item']."',
                       lote='".$datos['lote']."',
                       temperatura='".$datos['temperatura']."',
                       unidades = '".$datos['unidades']."',
                       cajas = '".$datos['cajas']."',
                       peso = '".$datos['peso']."',
                       base = '".$datos['base']."',
                       peso_real = '".$peso_real."' 
                       where id_item_proveedor = ".$datos['id_criterio'];

        $rs_operacion=mysqli_query($link,$sql);
    }else{
        $porcentaje_pechugas = 36;
        $porcentaje_muslos = 21;
        $porcentaje_contramuslos = 23;
        $porcentaje_alas = 20;

        $peso_pechugas = ($porcentaje_pechugas / 100) * $datos['peso'];
        $peso_muslos = ($porcentaje_muslos / 100) * $datos['peso'];
        $peso_contramuslos = ($porcentaje_contramuslos / 100) * $datos['peso'];
        $peso_alas = ($porcentaje_alas / 100) * $datos['peso'];
        //alas
        $item = '050514';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_alas),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        
        /* $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );"; */
        
        $sql = "UPDATE item_proveedorpollo set 
                       item = '".$datos['item']."',
                       lote='".$datos['lote']."',
                       temperatura='".$datos['temperatura']."',
                       unidades = '".$datos['unidades']."',
                       cajas = '".$datos['cajas']."',
                       peso = '".$datos['peso']."',
                       base = '".$datos['base']."',
                       peso_real = '".$peso_real."' 
                       where id_item_proveedor = ".$datos['id_criterio'];        
        
        $rs_operacion=mysqli_query($link,$sql);
        //muslo
        $item = '050516';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_muslos),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;

        /* $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );"; */
        
        $sql = "UPDATE item_proveedorpollo set 
                       item = '".$datos['item']."',
                       lote='".$datos['lote']."',
                       temperatura='".$datos['temperatura']."',
                       unidades = '".$datos['unidades']."',
                       cajas = '".$datos['cajas']."',
                       peso = '".$datos['peso']."',
                       base = '".$datos['base']."',
                       peso_real = '".$peso_real."' 
                       where id_item_proveedor = ".$datos['id_criterio'];
        
        $rs_operacion=mysqli_query($link,$sql);
        //contra
        $item = '050515';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_contramuslos),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        
        /* $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );"; */
        
        $sql = "UPDATE item_proveedorpollo set 
                       item = '".$datos['item']."',
                       lote='".$datos['lote']."',
                       temperatura='".$datos['temperatura']."',
                       unidades = '".$datos['unidades']."',
                       cajas = '".$datos['cajas']."',
                       peso = '".$datos['peso']."',
                       base = '".$datos['base']."',
                       peso_real = '".$peso_real."' 
                       where id_item_proveedor = ".$datos['id_criterio'];
        
        $rs_operacion=mysqli_query($link,$sql);
        //pechuga
        $item = '050517';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_pechugas),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        
        /* $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );"; */
        
        $sql = "UPDATE item_proveedorpollo set 
                       item = '".$datos['item']."',
                       lote='".$datos['lote']."',
                       temperatura='".$datos['temperatura']."',
                       unidades = '".$datos['unidades']."',
                       cajas = '".$datos['cajas']."',
                       peso = '".$datos['peso']."',
                       base = '".$datos['base']."',
                       peso_real = '".$peso_real."' 
                       where id_item_proveedor = ".$datos['id_criterio'];
        
        $rs_operacion=mysqli_query($link,$sql);                       
    }
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }

    /* include('../config.php');
    $peso_real = $infoCriEdit['peso'] - ($infoCriEdit['cajas'] * 2);
    $sql = "UPDATE item_proveedorpollo set 
              item = '".$infoCriEdit['item']."',
              lote='".$infoCriEdit['lote']."',
              temperatura='".$infoCriEdit['temperatura']."',
              unidades = '".$infoCriEdit['unidades']."',
              cajas = '".$infoCriEdit['cajas']."',
              peso = '".$infoCriEdit['peso']."',
              base = '".$infoCriEdit['base']."',
              peso_real = '".$peso_real."' 
              where id_item_proveedor = ".$infoCriEdit['id_criterio'];
    
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $infoCriEdit['id_criterio'];
     }  */
}

function editarCriterioPeso($infoCriEdit){
    include('../config.php');
    $peso_real = $infoCriEdit['peso'] - ($infoCriEdit['cajas'] * 2);
    $sql = "UPDATE recepcion_pesos set 
              estomago1 = '".$infoCriEdit['estomago1Edicion']."',
              estomago2 = '".$infoCriEdit['estomago2Edicion']."',
              piernas1 = '".$infoCriEdit['pierna1Edicion']."',
              piernas2 = '".$infoCriEdit['pierna2Edicion']."',
              temperatura='".$infoCriEdit['temperaturaEdicion']."'
              where id_recepcion_pesos = ".$infoCriEdit['id_recepcion_pesos'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $infoCriEdit['id_criterio'];
     } 
}

function editarCriterioPesoCerdo($infoCriEdit){
    include('../config.php');
    $peso_real = $infoCriEdit['peso'] - ($infoCriEdit['cajas'] * 2);
    $sql = "UPDATE recepcion_pesos set 
              estomago1 = '".$infoCriEdit['peso']."',
              temperatura='".$infoCriEdit['temperaturap']."'
              where id_recepcion_pesos = ".$infoCriEdit['id_recepcion_pesos'];
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $infoCriEdit['id_criterio'];
     } 
}

function bloquearGuia($idBloquear){
    include('../config.php');
    $sql = "UPDATE guias set status = '2' where id_guia = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);

    $sql = "UPDATE item_proveedor set status = '2' where proveedor = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);
      
    if (!$rs_operacion) {
        return mysqli_error($link);
    }else{        
        return $idBloquear;
     } 
}

function bloquearGuiaP($idBloquear){
    include('../config.php');
    $sql = "UPDATE guiaspollo set status = '2' where id_guia = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);

    $sql = "UPDATE item_proveedorpollo set status = '2' where proveedor = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);
      
    if (!$rs_operacion) {
        return mysqli_error($link);
    }else{        
        return $idBloquear;
     } 
}

function bloquearGuiaR($idBloquear){
    include('../config.php');
    $sql = "UPDATE recepcion set status = '2' where id_recepcion = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);

    $sql = "UPDATE recepcion_pesos set status = '2' where id_recepcion = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);
      
    if (!$rs_operacion) {
        return mysqli_error($link);
    }else{        
        return $idBloquear;
     } 
}

function desbloquearGuia($idBloquear){
    include('../config.php');
    $sql = "UPDATE guias set status = '1' where id_guia = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);

    $sql = "UPDATE item_proveedor set status = '1' where proveedor = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);
      
    if (!$rs_operacion) {
        return mysqli_error($link);
    }else{        
        return $idBloquear;
     } 
}

function desbloquearGuiaP($idBloquear){
    include('../config.php');
    $sql = "UPDATE guiaspollo set status = '1' where id_guia = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);

    $sql = "UPDATE item_proveedorpollo set status = '1' where proveedor = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);
      
    if (!$rs_operacion) {
        return mysqli_error($link);
    }else{        
        return $idBloquear;
     } 
}

function desbloquearGuiaR($idBloquear){
    include('../config.php');
    $sql = "UPDATE recepcion set status = '1' where id_recepcion = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);

    $sql = "UPDATE recepcion_pesos set status = '1' where id_recepcion = ".$idBloquear;
    $rs_operacion=mysqli_query($link,$sql);
      
    if (!$rs_operacion) {
        return mysqli_error($link);
    }else{        
        return $idBloquear;
     } 
}

function listaProveedoresCPaginada($inicio, $fin, $busqueda){   
    include('../config.php');

        $sql = "SELECT codigog,
                       fechaexp,
                       responsables.nombres as responsable,
                       destinos.sede as sede,
                       conductores.nombres as conductor,
                       placa,
                       guias.tipo,
                       id_guia,
                       consecutivog,
                       destinos.empresa as empresa,
                       guias.status
                FROM 
                    guias
                INNER JOIN 
                    responsables ON guias.responsable = responsables.cedula
                INNER JOIN 
                    destinos ON guias.destino = destinos.id
                INNER JOIN 
                    conductores ON guias.conductor = conductores.cedula
                WHERE
                    guias.tipo <> 'POLLO'";
        if (!empty($busqueda)) {
            $sql .= " AND (fechaexp LIKE '%$busqueda%'";
            $sql .= " OR destinos.sede LIKE '%$busqueda%'";
            $sql .= " OR conductores.nombres LIKE '%$busqueda%'";
            $sql .= " OR responsables.nombres LIKE '%$busqueda%'";
            $sql .= " OR codigog LIKE '%$busqueda%'";
            $sql .= " OR guias.tipo LIKE '%$busqueda%'";
            $sql .= " OR placa LIKE '%$busqueda%')";
        }
    
        $sql .= " ORDER BY id_guia DESC";
    
        $sql .= " LIMIT $inicio, $fin";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 2: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaProveedoresPPaginada($inicio, $fin, $busqueda){   
    include('../config.php');

        $sql = "SELECT codigog,
                       fechaexp,
                       responsables.nombres as responsable,
                       destinos.sede as sede,
                       conductores.nombres as conductor,
                       placa,
                       guiaspollo.tipo,
                       id_guia,
                       consecutivog,
                       destinos.empresa as empresa,
                       guiaspollo.status,
                       canales
                FROM 
                    guiaspollo
                INNER JOIN 
                    responsables ON guiaspollo.responsable = responsables.cedula
                INNER JOIN 
                    destinos ON guiaspollo.destino = destinos.id
                INNER JOIN 
                    conductores ON guiaspollo.conductor = conductores.cedula";
        if (!empty($busqueda)) {
            $sql .= " WHERE (fechaexp LIKE '%$busqueda%'";
            $sql .= " OR destinos.sede LIKE '%$busqueda%'";
            $sql .= " OR conductores.nombres LIKE '%$busqueda%'";
            $sql .= " OR responsables.nombres LIKE '%$busqueda%'";
            $sql .= " OR codigog LIKE '%$busqueda%'";
            $sql .= " OR guiaspollo.tipo LIKE '%$busqueda%'";
            $sql .= " OR id_guia LIKE '%$busqueda%'";
            $sql .= " OR placa LIKE '%$busqueda%')";
        }
    
        $sql .= " ORDER BY id_guia DESC";
    
        $sql .= " LIMIT $inicio, $fin";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 2: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
function listaProveedoresConPedidoPaginada($inicio, $fin, $busqueda,$fecha)
{   include('../config.php');

        $sql = "SELECT nit,razon_social FROM proveedores WHERE nit in (SELECT proveedor FROM item_proveedor_compra WHERE fecha = '$fecha')";

        if (!empty($busqueda)) {
            $sql .= "and razon_social LIKE '%$busqueda%'";
        }
    
        $sql .= " ORDER BY razon_social ASC";
    
        $sql .= " LIMIT $inicio, $fin";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
 //inicia compradores
/* function agregarComprador($datosComprador){
    include('../config.php');
    $clave = md5($datosComprador['clave']);
    //$nombre = strtoupper($datosComprador['nombre']);
    $sql=" INSERT INTO 
    compradores(
        cedula,
        nombres,
        usuario,
        clave) 
        VALUES (
        '".$datosComprador['cedula']."',
        '".$datosComprador['nombre']."',
        '".$datosComprador['usuario']."',
        '".$clave."');";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
} */
/* function listaCompradoresCompleta()
{   include('../config.php');

        $sql = "SELECT cedula,nombres,usuario FROM compradores";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaCompradoresConFiltro($busqueda)
{   include('../config.php');

        $sql = "SELECT cedula,nombres,usuario FROM compradores";

        if (!empty($busqueda)) {
            $sql .= " WHERE nombres LIKE '%$busqueda%'";
        }
        $sql .= " ORDER BY nombres ASC";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaCompradoresPaginada($inicio, $fin, $busqueda)
{   include('../config.php');

        $sql = "SELECT cedula,nombres,usuario FROM compradores";

        if (!empty($busqueda)) {
            $sql .= " WHERE nombres LIKE '%$busqueda%'";
        }
    
        $sql .= " ORDER BY nombres ASC";
    
        $sql .= " LIMIT $inicio, $fin";
    
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
} */
//termina compadores

function listaItemsTablaCompleta($inicio,$fin){   
    include('../config.php');
    $sql = "SELECT `item`,`codigo`,`descripcion`,`tipo`,`categoria`,`categoriadestino`,`status`,`id` FROM `plantilla`";
    $sql .= " ORDER BY descripcion DESC";
    $sql .= " LIMIT $inicio, $fin";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        //echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        echo $sql;
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaItemsTabla($inicio,$fin,$busqueda){   
    include('../config.php');
    $sql = "SELECT `item`,`codigo`,`descripcion`,`tipo`,`categoria`,`categoriadestino`,`status`,`id` FROM `plantilla`";
    
    if (!empty($busqueda)) {
        $sql .= " WHERE (item LIKE '%$busqueda%'";
        $sql .= " OR descripcion LIKE '%$busqueda%'";
        $sql .= " OR codigo LIKE '%$busqueda%'";
        $sql .= " OR categoria LIKE '%$busqueda%'";
        $sql .= " OR categoriadestino LIKE '%$busqueda%'";
        $sql .= " OR tipo LIKE '%$busqueda%')";
    }

    $sql .= " ORDER BY descripcion DESC";

    $sql .= " LIMIT $inicio, $fin";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta 1: " . mysqli_error($link);
        /* echo $sql; */
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaItemsCompleta($inicio, $fin, $busqueda){
    include('../config.php');
    
    $sql = "SELECT item, descripcion, unidad 
            FROM plantilla 
            WHERE status = 'ACTIVO'";

    if (!empty($busqueda)) {
        $busqueda = mysqli_real_escape_string($link, $busqueda);
        $sql .= " AND descripcion LIKE '%$busqueda%'";
    }

    $sql .= " ORDER BY descripcion ASC";
    $sql .= " LIMIT $inicio, $fin";

    $rs_operacion = mysqli_query($link, $sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        return mysqli_error($link);
      }
    else{
        return $rs_operacion;
  }
}

function listarItems($proveedor){
    include('../config.php');
    
    $sql1="SELECT categoria 
          FROM plantilla 
          WHERE item in (select item 
                         from item_proveedor 
                         where proveedor = '".$proveedor['id']."' and 
                               tipo = '".$proveedor['tipo']."')";
    
    $categoria = '';
    $rs_operacion1 = mysqli_query($link, $sql1);
    $row1 = mysqli_fetch_array($rs_operacion1);
    $categoria = $row1['categoria'];
    
    if($categoria != ''){
        $sql="SELECT item, descripcion, codigo 
          FROM plantilla p 
          WHERE tipo = '".$proveedor['tipo']."' and categoria = '".$categoria."'
          order by descripcion asc";

    }else{
        $sql="SELECT item, descripcion, codigo 
          FROM plantilla p 
          WHERE tipo = '".$proveedor['tipo']."'
        order by categoria, descripcion asc";
    }

    $rs_operacion = mysqli_query($link, $sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
  }
}

function listarItemsP($proveedor){
    include('../config.php');
    
    $sql1="SELECT categoriadestino 
          FROM plantilla 
          WHERE item in (select item 
                         from item_proveedorpollo 
                         where proveedor = '".$proveedor['id']."' and 
                               tipo = '".$proveedor['tipo']."')";
    
    $categoria = '';
    $rs_operacion1 = mysqli_query($link, $sql1);
    $row1 = mysqli_fetch_array($rs_operacion1);
    $categoria = $row1['categoriadestino'];
    if($categoria != ''){
        $sql="SELECT item, descripcion, codigo 
          FROM plantilla p 
          WHERE tipo = '".$proveedor['tipo']."' and 
          categoriadestino = '".$categoria."' and
          status = 'ACTIVO'
          order by descripcion asc";

    }else{
        $sql="SELECT item, descripcion, codigo 
          FROM plantilla p 
          WHERE tipo = '".$proveedor['tipo']."' and
                status = 'ACTIVO'
          ORDER BY categoria, descripcion asc";
    }

    $rs_operacion = mysqli_query($link, $sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
  }
}

function listarSedes($compradorSede){
    include('../config.php');

    $sql="SELECT cod, nombre 
          FROM sede 
          WHERE tipo = 2 AND comprador = ''
    ORDER BY empresa,nombre ASC";
   
    $rs_operacion = mysqli_query($link, $sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $items = [];
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
          $items[] = $row;
         }
        mysqli_free_result($rs_operacion);
        return $items;
  }
}

function listaSedesConComprador(){
    include('../config.php');
    
    $sql="SELECT empresa, nombre,nombres 
          FROM sede 
          INNER JOIN compradores ON sede.comprador = compradores.cedula
          WHERE tipo = 2 AND comprador <> ''
    ORDER BY comprador,empresa,nombre ASC";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaSedeComprador(){
    include('../config.php');
    $comprador = $_SESSION['comprador'];
    $sql="SELECT campo 
          FROM sede 
          WHERE comprador = '".$comprador."'
    ORDER BY empresa,nombre ASC";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        $campos = array();
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
            $campos[] = $row['campo'];
        }
        mysqli_free_result($rs_operacion);
        return $campos;
    }  
}

function listaSedeCompleta(){
    include('../config.php');
    include('config.php');
    $sql="SELECT campo 
          FROM sede 
          WHERE campo<>''
          ORDER BY empresa,nombre ASC";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        $campos = array();
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
            $campos[] = $row['campo'];
        }
        mysqli_free_result($rs_operacion);
        return $campos;
    }  
}

function listaNombreSedeCompradorCompleta(){
    include('./config.php');
    $comprador = $_SESSION['comprador'];
    $sql="SELECT cod,nombre FROM sede 
          WHERE campo <> ''
    ORDER BY empresa,nombre ASC";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL 1: " . mysqli_error($link);
        exit();
      }
    else{
        $campos = array();
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
            $campos[] = array('cod' => $row['cod'], 'nombre' => $row['nombre']);
        }
        mysqli_free_result($rs_operacion);
        return $campos;
    }  
}

function listaNombreSedeComprador(){
    include('./config.php');
    $comprador = $_SESSION['comprador'];
    $sql="SELECT cod,nombre FROM sede 
          WHERE comprador = '".$comprador."'
    ORDER BY empresa,nombre ASC";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL 1: " . mysqli_error($link);
        exit();
      }
    else{
        $campos = array();
        while ($row = mysqli_fetch_assoc($rs_operacion)) {
            $campos[] = array('cod' => $row['cod'], 'nombre' => $row['nombre']);
        }
        mysqli_free_result($rs_operacion);
        return $campos;
    }  
}

function listaItemsPorProveedor($proveedor){
    include('../config.php');
    
    $sql="SELECT plantilla.item, 
                 descripcion,
                 lote,
                 temperatura,
                 unidades,
                 cajas,
                 peso,
                 registro,
                 id_item_proveedor,
                 peso_real,
                 item_proveedor.status,
                 tipo 
          FROM plantilla,item_proveedor 
          WHERE plantilla.item=item_proveedor.item AND item_proveedor.proveedor='".$proveedor."'
          ORDER BY id_item_proveedor desc";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaItemsPorProveedorPaginada($proveedor, $inicio, $fin, $busqueda){
    include('../config.php');
    
    $sql="SELECT plantilla.item, 
                 descripcion,
                 lote,
                 temperatura,
                 unidades,
                 cajas,
                 peso,
                 registro,
                 id_item_proveedor,
                 peso_real,
                 item_proveedor.status,
                 tipo 
          FROM plantilla,item_proveedor 
          WHERE plantilla.item=item_proveedor.item AND item_proveedor.proveedor='".$proveedor."'";
    
    if (!empty($busqueda)) {
        $sql .= " AND descripcion LIKE '%$busqueda%'";
    }
    
    $sql .= " ORDER BY id_item_proveedor desc";
    $sql .= " LIMIT $inicio, $fin";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaItemsPorProveedorP($proveedor){
    include('../config.php');
    
    $sql="SELECT plantilla.item, 
                 descripcion,
                 lote,
                 temperatura,
                 unidades,
                 cajas,
                 peso,
                 registro,
                 id_item_proveedor,
                 peso_real,
                 item_proveedorpollo.status,
                 tipo,
                 base 
          FROM plantilla,item_proveedorpollo 
          WHERE plantilla.item=item_proveedorpollo.item AND item_proveedorpollo.proveedor='".$proveedor."'
          ORDER BY id_item_proveedor desc";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaItemsPorProveedorPPaginada($proveedor, $inicio, $fin, $busqueda){
    include('../config.php');
    
    $sql="SELECT plantilla.item, 
                 descripcion,
                 lote,
                 temperatura,
                 unidades,
                 cajas,
                 peso,
                 registro,
                 id_item_proveedor,
                 peso_real,
                 item_proveedorpollo.status,
                 tipo 
          FROM plantilla,item_proveedorpollo 
          WHERE plantilla.item=item_proveedorpollo.item AND item_proveedorpollo.proveedor='".$proveedor."'";
    
    if (!empty($busqueda)) {
        $sql .= " AND descripcion LIKE '%$busqueda%'";
    }
    
    $sql .= " ORDER BY id_item_proveedor desc";
    //$sql .= " LIMIT $inicio, $fin";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaPesosPorRecepcion($Recepcion){
    include('../config.php');
    
    $sql="SELECT id_recepcion_pesos, 
                 id_recepcion,
                 turno,
                 estomago1,
                 estomago2,
                 piernas1,
                 piernas2,
                 total,
                 status,
                 registro,
                 temperatura,
                 observacion,
                 foto
          FROM recepcion_pesos 
          WHERE id_recepcion='".$Recepcion."'
          ORDER BY id_recepcion_pesos desc";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaPesosPorRecepcionInv($Recepcion){
    include('../config.php');
    
    $sql="SELECT id_recepcion_pesos, 
                 id_recepcion,
                 turno,
                 estomago1,
                 estomago2,
                 piernas1,
                 piernas2,
                 total,
                 status,
                 registro,
                 temperatura,
                 observacion,
                 foto,
                 inventario,
                 diferencia
          FROM recepcion_pesos 
          WHERE id_recepcion='".$Recepcion."'
          ORDER BY turno asc";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaPesosPorRecepcionPaginada($Recepcion,$inicio, $fin, $busqueda){
    include('../config.php');
    
    $sql="SELECT id_recepcion_pesos, 
                 id_recepcion,
                 turno,
                 estomago1,
                 estomago2,
                 piernas1,
                 piernas2,
                 total,
                 status,
                 registro,
                 temperatura,
                 observacion,
                 foto
          FROM recepcion_pesos 
          WHERE id_recepcion='".$Recepcion."'";

          if (!empty($busqueda)) {
            $sql .= " AND (turno LIKE '%$busqueda%'";
            $sql .= " OR status LIKE '%$busqueda%'";
            $sql .= " OR temperatura LIKE '%$busqueda%')";
        }
    
        $sql .= " ORDER BY id_recepcion_pesos DESC";
    
        $sql .= " LIMIT $inicio, $fin";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaPesosPorRecepcionPaginadaInv($Recepcion,$inicio, $fin, $busqueda){
    include('../config.php');
    
    $sql="SELECT id_recepcion_pesos, 
                 id_recepcion,
                 turno,
                 estomago1,
                 estomago2,
                 piernas1,
                 piernas2,
                 total,
                 status,
                 registro,
                 temperatura,
                 observacion,
                 foto,
                 inventario,
                 diferenciaPeso,
                 diferencia
          FROM recepcion_pesos 
          WHERE id_recepcion='".$Recepcion."'";

          if (!empty($busqueda)) {
            $sql .= " AND (turno LIKE '%$busqueda%'";
            $sql .= " OR status LIKE '%$busqueda%'";
            $sql .= " OR temperatura LIKE '%$busqueda%')";
        }
    
        $sql .= " ORDER BY turno ASC";
    
        //$sql .= " LIMIT $inicio, $fin";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}
function listaItemsCompradosFecha($item,$fecha){
    include('../config.php');
    
    $sql="SELECT proveedor, razon_social, sede, nombre, cantidad, plantilla.item as item,id_item_proveedor
          FROM plantilla,item_proveedor_compra,proveedores,sede
          WHERE plantilla.item=item_proveedor_compra.item 
          AND item_proveedor_compra.item='".$item."'
          AND item_proveedor_compra.fecha='".$fecha."'
          AND item_proveedor_compra.proveedor=proveedores.nit
          AND (item_proveedor_compra.sede=sede.cod and sede.empresa=item_proveedor_compra.empresa)
          order by razon_social,sede asc";
        
    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaItemsCompradosFechaConFiltro($item,$fecha,$busqueda){
    include('../config.php');
    
    $sql="SELECT proveedor, razon_social, sede, nombre, cantidad, plantilla.item as item,id_item_proveedor
          FROM plantilla,item_proveedor_compra,proveedores,sede
          WHERE plantilla.item=item_proveedor_compra.item 
          AND item_proveedor_compra.item='".$item."'
          AND item_proveedor_compra.fecha='".$fecha."'
          AND item_proveedor_compra.proveedor=proveedores.nit
          AND (item_proveedor_compra.sede=sede.cod and sede.empresa='".$_SESSION['empresa']."')";
        
          if (!empty($busqueda)) {
            $sql .= " AND (razon_social LIKE '%$busqueda%' OR ";
            $sql .= "nombre LIKE '%$busqueda%' OR ";
            $sql .= "cantidad LIKE '%$busqueda%')";
        }
    
        $sql .= " ORDER BY sede,razon_social ASC";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta SQL: " . mysqli_error($link);
        exit();
      }
    else{
        return $rs_operacion;
    }  
}

function listaProveedorPorItem($proveedorPorItem){
    include('../config.php');

  $sql = "SELECT nit, razon_social, precio, vigencia 
          FROM proveedores, item_proveedor 
          WHERE proveedores.nit = item_proveedor.proveedor 
          AND item_proveedor.item = '".$proveedorPorItem."'
          ORDER BY precio ASC";

  $rs_operacion = mysqli_query($link, $sql);

  if (!$rs_operacion) {
    echo "Error al ejecutar la consulta: " . mysqli_error($link);
    exit();
  }
else{
    $items = [];
    while ($row = mysqli_fetch_assoc($rs_operacion)) {
      $items[] = $row;
     }
    mysqli_free_result($rs_operacion);
    return $items;
    }
  
}

function agregarItem($datos){
    include('../config.php');
    $hora = date("Y-m-d H:i:s");
    $peso_real = $datos['peso'] - ($datos['cajas'] * 1.8); 
    $sql=" INSERT INTO item_proveedor(item,proveedor,lote,temperatura,unidades,cajas,peso,peso_real,registro) 
    VALUES (
        '".$datos['item']."',
        '".$datos['proveedor']."',
        '".$datos['lote']."',
        '".$datos['temperatura']."',
        '".$datos['unidades']."',
        '".$datos['cajas']."',
        '".$datos['peso']."',
        '".$peso_real."',
        '".$hora."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function agregarItemP($datos){
    include('../config.php');
    $hora = date("Y-m-d H:i:s");
    $peso_base = round($datos['base'] *1.8);
    if($datos['item'] != '999999'){
        /* $peso_real = number_format(round($datos['peso'] - ($datos['cajas'] * 2) - ($datos['base'] *1.8)),2,",","."); */
        $peso_real = number_format($datos['peso'] - (($datos['cajas']) * 2) - (($datos['base'] *1.8)),2,",","."); 
        $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$datos['item']."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$datos['unidades']."',
                        '".$datos['cajas']."',
                        '".$datos['base']."',
                        '".$datos['peso']."',
                        '".$peso_real."',
                        '".$hora."'
                       );";
        $rs_operacion=mysqli_query($link,$sql);
    }else{
        $porcentaje_pechugas = 36;
        $porcentaje_muslos = 21;
        $porcentaje_contramuslos = 23;
        $porcentaje_alas = 20;

        $peso_pechugas = ($porcentaje_pechugas / 100) * $datos['peso'];
        $peso_muslos = ($porcentaje_muslos / 100) * $datos['peso'];
        $peso_contramuslos = ($porcentaje_contramuslos / 100) * $datos['peso'];
        $peso_alas = ($porcentaje_alas / 100) * $datos['peso'];
        //alas
        $item = '050514';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_alas),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );";

        $rs_operacion=mysqli_query($link,$sql);
        //muslo
        $item = '050516';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_muslos),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );";
        $rs_operacion=mysqli_query($link,$sql);
        //contra
        $item = '050515';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_contramuslos),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );";
        $rs_operacion=mysqli_query($link,$sql);
        //pechuga
        $item = '050517';
        $unidades = $datos['unidades'] * 2;
        $peso = number_format(round($peso_pechugas),2,",",".");
        $peso_real = number_format($peso - (($datos['cajas']/4) * 2) - (($datos['base'] *1.8)/4),2,",",".");
        $cajas = $datos['cajas']/4;
        $sql=" INSERT INTO item_proveedorpollo(item,proveedor,lote,temperatura,unidades,cajas,base,peso,peso_real,registro) 
               VALUES (
                        '".$item."',
                        '".$datos['proveedor']."',
                        '".$datos['lote']."',
                        '".$datos['temperatura']."',
                        '".$unidades."',
                        '".$cajas."',
                        '".$datos['base']."',
                        '".$peso."',
                        '".$peso_real."',
                        '".$hora."'
                       );";
        $rs_operacion=mysqli_query($link,$sql);                       
    }
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

/* function agregarPeso($datos){
    include('../config.php');
    $hora = date("Y-m-d H:i:s");
    
    $sql = "SELECT * 
            FROM recepcion_pesos 
            WHERE id_recepcion = '".$datos['recepcion']."'
            AND turno = '".$datos['turno']."'";
    $rs_operacion = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($rs_operacion)) {
        $respuesta = [
            'status' => 'warning',
            'message' => 'Ya existe',
            'data' => $datos
        ];
        return json_encode($respuesta);
    } else {
        $sql = "INSERT INTO recepcion_pesos(id_recepcion, turno, estomago1, total, registro) 
                VALUES ('".$datos['recepcion']."',
                        '".$datos['turno']."',
                        '".$datos['peso']."',
                        '".$datos['peso']."',
                        '".$hora."');";
        $rs_operacion = mysqli_query($link, $sql);
        if (!$rs_operacion) {
            $respuesta = [
                'status' => 'error',
                'message' => 'Error al ejecutar la consulta: ' . mysqli_error($link)
            ];
            return json_encode($respuesta);
        } else {
            $respuesta = [
                'status' => 'success',
                'message' => 'Peso registrado satisfactoriamente',
                'id' => mysqli_insert_id($link)
            ];
            return json_encode($respuesta);
        }
    }
} */

function agregarPeso($datos){
    include('../config.php');
    $hora = date("Y-m-d H:i:s");
    
    $sql = "SELECT * FROM recepcion_pesos 
            WHERE id_recepcion = '".$datos['recepcion']."' 
            AND turno = '".$datos['turno']."'";
    $rs_operacion = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($rs_operacion)) {
        if($datos['parte'] == "ESTOMAGO"){
            if($row['estomago1'] == "0"){
                
                if($datos['temperaturap']==''){
                    $sql = "UPDATE recepcion_pesos SET estomago1 = '".$datos['peso']."', registro = '".$hora."' 
                    WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }else{
                    $sql = "UPDATE recepcion_pesos SET estomago1 = '".$datos['peso']."', temperatura = '".$datos['temperaturap']."', registro = '".$hora."'  
                    WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }
                
                $rs_operacion = mysqli_query($link, $sql);
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso ESTOMAGO1 registrado satisfactoriamente'
                ];
                return json_encode($respuesta);
            } elseif($row['estomago2'] == "0"){
                
                if($datos['temperaturap']==''){
                    $sql = "UPDATE recepcion_pesos SET estomago2 = '".$datos['peso']."', registro2 = '".$hora."' 
                        WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }else{
                    $sql = "UPDATE recepcion_pesos SET estomago2 = '".$datos['peso']."',temperatura = '".$datos['temperaturap']."', registro2 = '".$hora."' 
                        WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }
                
                $rs_operacion = mysqli_query($link, $sql);
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso ESTOMAGO2 registrado satisfactoriamente'
                ];
                return json_encode($respuesta);
            } else {
                $respuesta = [
                    'status' => 'warning',
                    'message' => 'Los estómagos de este turno ya están registrados, por favor verifique el turno'
                ];
                return json_encode($respuesta);
            }
        } else {
            if($row['piernas1'] == "0"){
                
                if($datos['temperaturap']==''){
                    $sql = "UPDATE recepcion_pesos SET piernas1 = '".$datos['peso']."', registro3 = '".$hora."' 
                        WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }else{
                    $sql = "UPDATE recepcion_pesos SET piernas1 = '".$datos['peso']."',temperatura = '".$datos['temperaturap']."', registro3 = '".$hora."' 
                        WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }
                
                $rs_operacion = mysqli_query($link, $sql);
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso PIERNAS1 registrado satisfactoriamente'
                ];
                return json_encode($respuesta);
            } elseif($row['piernas2'] == "0"){
                
                if($datos['temperaturap']==''){
                    $sql = "UPDATE recepcion_pesos SET piernas2 = '".$datos['peso']."', registro4 = '".$hora."'
                        WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }else{
                    $sql = "UPDATE recepcion_pesos SET piernas2 = '".$datos['peso']."',temperatura = '".$datos['temperaturap']."', registro4 = '".$hora."'
                        WHERE id_recepcion = '".$datos['recepcion']."' AND turno = '".$datos['turno']."'";
                }

                $rs_operacion = mysqli_query($link, $sql);
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso PIERNAS2 registrado satisfactoriamente'
                ];
                return json_encode($respuesta);
            } else {
                $respuesta = [
                    'status' => 'warning',
                    'message' => 'Las piernas de este turno ya están registradas, por favor verifique el turno'
                ];
                return json_encode($respuesta);
            }
        }
    } else {
        if($datos['parte'] == "ESTOMAGO"){
            $sql = "INSERT INTO recepcion_pesos(id_recepcion, turno, estomago1, temperatura, registro) 
                    VALUES ('".$datos['recepcion']."', 
                            '".$datos['turno']."', 
                            '".$datos['peso']."', 
                            '".$datos['temperaturap']."', 
                            '".$hora."')";
            $rs_operacion = mysqli_query($link, $sql);
            if (!$rs_operacion) {
                $respuesta = [
                    'status' => 'error',
                    'message' => 'Error al ejecutar la consulta: ' . mysqli_error($link)
                ];
                return json_encode($respuesta);
            } else {
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso ESTOMAGO1 registrado satisfactoriamente',
                    'id' => mysqli_insert_id($link)
                ];
                return json_encode($respuesta);
            }
        } else {
            $sql = "INSERT INTO recepcion_pesos(id_recepcion, turno, piernas1, temperatura, registro3) 
                    VALUES ('".$datos['recepcion']."', 
                            '".$datos['turno']."', 
                            '".$datos['peso']."', 
                            '".$datos['temperatura']."', 
                            '".$hora."')";
            $rs_operacion = mysqli_query($link, $sql);
            if (!$rs_operacion) {
                $respuesta = [
                    'status' => 'error',
                    'message' => 'Error al ejecutar la consulta: ' . mysqli_error($link)
                ];
                return json_encode($respuesta);
            } else {
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso PIERNAS1 registrado satisfactoriamente',
                    'id' => mysqli_insert_id($link)
                ];
                return json_encode($respuesta);
            }
        }
    }
}

function agregarPesoCerdo($datos){
    include('../config.php');
    $hora = date("Y-m-d H:i:s");
    
    $sql = "SELECT * FROM recepcion_pesos 
            WHERE id_recepcion = '".$datos['recepcion']."' 
            AND turno = '".$datos['turno']."'";
    $rs_operacion = mysqli_query($link, $sql);
    
    if ($row = mysqli_fetch_assoc($rs_operacion)) {
        $respuesta = [
            'status' => 'warning',
            'message' => 'El peso de este turno ya esta registrados, por favor verifique el turno'
        ];
        return json_encode($respuesta); 
    } else {
            $sql = "INSERT INTO recepcion_pesos(id_recepcion, turno, estomago1, temperatura, observacion, foto, registro) 
                    VALUES ('".$datos['recepcion']."', 
                            '".$datos['turno']."', 
                            '".$datos['peso']."', 
                            '".$datos['temperaturap']."',
                            '".$datos['observacionPeso']."', 
                            '".$datos['foto']."',  
                            '".$hora."')";
            $rs_operacion = mysqli_query($link, $sql);
            if (!$rs_operacion) {
                $respuesta = [
                    'status' => 'error',
                    'message' => 'Error al ejecutar la consulta: ' . mysqli_error($link)
                ];
                return json_encode($respuesta);
            } else {
                $respuesta = [
                    'status' => 'success',
                    'message' => 'Peso registrado satisfactoriamente',
                    'id' => mysqli_insert_id($link)
                ];
                return json_encode($respuesta);
            } 
    }
}

function agregarResponsable($datosResp){
    include('../config.php');
    $sql=" INSERT INTO responsables(cedula,nombres,telefono,status) 
    VALUES (
        '".$datosResp['cedula']."',
        '".$datosResp['nombres']."',
        '".$datosResp['telefono']."',
        '".$datosResp['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function agregarConductor($datosCond){
    include('../config.php');
    $sql=" INSERT INTO conductores(cedula,nombres,telefono,status) 
    VALUES (
        '".$datosCond['cedula']."',
        '".$datosCond['nombres']."',
        '".$datosCond['telefono']."',
        '".$datosCond['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function agregarNuevoItem($datosItem){
    include('../config.php');
    $sql=" INSERT INTO plantilla(item,descripcion,codigo,tipo,categoria,categoriadestino,status) 
    VALUES (
        '".$datosItem['item']."',
        '".$datosItem['descripcion']."',
        '".$datosItem['codigo']."',
        '".$datosItem['tipo']."',
        '".$datosItem['categoria']."',
        '".$datosItem['subcategoria']."',
        '".$datosItem['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarNuevoResponsable($datosResponsable){
    include('../config.php');
    $clave = md5($datosResponsable['clave']);
    $sql=" INSERT INTO responsables(cedula,nombres,telefono,status,clave) 
    VALUES (
        '".$datosResponsable['cedula']."',
        '".$datosResponsable['nombres']."',
        '".$datosResponsable['telefono']."',
        '".$datosResponsable['status']."',
        '".$clave."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarNuevaPlanta($datosResponsable){
    include('../config.php');
    $sql=" INSERT INTO beneficio(nit,sede,direccion,municipio,status) 
    VALUES (
        '".$datosResponsable['nit']."',
        '".$datosResponsable['razon']."',
        '".$datosResponsable['direccion']."',
        '".$datosResponsable['municipio']."',
        '".$datosResponsable['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarProveedorPollo($datosProveedorP){
    include('../config.php');
    $sql=" INSERT INTO proveedorpollo(nit,sede,direccion,municipio,polloporcanastillas,status) 
    VALUES (
        '".$datosProveedorP['nit']."',
        '".$datosProveedorP['razon']."',
        '".$datosProveedorP['direccion']."',
        '".$datosProveedorP['municipio']."',
        '".$datosProveedorP['polloporcanastillas']."',
        '".$datosProveedorP['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarNuevoConductorD($datosConductorD){
    include('../config.php');
    $sql=" INSERT INTO conductores(cedula,nombres,telefono,status) 
    VALUES (
        '".$datosConductorD['cedula']."',
        '".$datosConductorD['nombres']."',
        '".$datosConductorD['telefono']."',
        '".$datosConductorD['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarPlaca($datosPlaca){
    include('../config.php');
    $sql=" INSERT INTO placas(placa,status) 
    VALUES (
        '".$datosPlaca['cedula']."',
        '".$datosPlaca['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function agregarPlacaD($datosPlaca){
    include('../config.php');
    $sql=" INSERT INTO placas(placa,status) 
    VALUES (
        '".$datosPlaca['placa']."',
        '".$datosPlaca['status']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        if (!$rs_operacion) {
            return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
        } else {
            return array("status" => "success", "id" => mysqli_insert_id($link));
        }
    }
}

function agregarSede($datosSede){
    include('../config.php');
    
    $sql=" UPDATE sede SET comprador = '".$datosSede['comprador']."' WHERE nombre = '".$datosSede['sede']."';";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function eliminarSede($datosEliminarSede){
    include('../config.php');
    
    $sql=" UPDATE sede SET comprador = '' WHERE nombre = '".$datosEliminarSede['sede']."';";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $datosEliminarSede['sede'];
    }
}

/*
function agregarGuia($datosGuia){
    include('../config.php');
    $sql=" INSERT INTO 
    guias(
        canales,
        fechaexp,
        consecutivog,
        responsable,
        destino,
        conductor,
        placa,
        tipo,
        precinto,
        observaciones
        ) 
        VALUES (
        '".$datosGuia['canales']."',
        '".$datosGuia['fechaexp']."',
        '".$datosGuia['consecutivog']."',
        '".$datosGuia['responsable']."',
        '".$datosGuia['destino']."',
        '".$datosGuia['conductor']."',
        '".$datosGuia['placa']."',
        '".$datosGuia['producto']."',
        '".$datosGuia['precinto']."',
        '".$datosGuia['observaciones']."');";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}
*/
function agregarGuia($datosGuia) {
    include('../config.php');

    $sql = "INSERT INTO guias (canales, fechaexp, consecutivog, responsable, destino, conductor, placa, tipo, precinto, observaciones) VALUES (
        '".$datosGuia['canales']."',
        '".$datosGuia['fechaexp']."',
        '".$datosGuia['consecutivog']."',
        '".$datosGuia['responsable']."',
        '".$datosGuia['destino']."',
        '".$datosGuia['conductor']."',
        '".$datosGuia['placa']."',
        '".$datosGuia['producto']."',
        '".$datosGuia['precinto']."',
        '".$datosGuia['observaciones']."'
    )";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarGuiaP($datosGuia) {
    include('../config.php');

    $sql = "INSERT INTO guiaspollo (canales, fechaexp, consecutivog, responsable, destino, conductor, placa, tipo, precinto, observaciones) VALUES (
        '".$datosGuia['canales']."',
        '".$datosGuia['fechaexp']."',
        '".$datosGuia['consecutivog']."',
        '".$datosGuia['responsable']."',
        '".$datosGuia['destino']."',
        '".$datosGuia['conductor']."',
        '".$datosGuia['placa']."',
        'POLLO',
        '".$datosGuia['precinto']."',
        '".$datosGuia['observaciones']."'
    )";

    $rs_operacion = mysqli_query($link, $sql);

    if (!$rs_operacion) {
        return array("status" => "error", "message" => "Error al ejecutar la consulta: " . mysqli_error($link));
    } else {
        return array("status" => "success", "id" => mysqli_insert_id($link));
    }
}

function agregarRecepcion($datosGuia){
    include('../config.php');
    $sql=" INSERT INTO 
    recepcion(
        fecharec,
        fechasac,
        tipo,
        remision,
        canales,
        recibo,
        consecutivog,
        responsable,
        beneficio,
        destino,
        conductor,
        placa,
        lotep,
        ica,
        guiat,
        cph1,
        cph2,
        cph3,
        cph4,
        cph5,
        chv1,
        chv2,
        chv3,
        chv4,
        ccoh1,
        ccoh2,
        ccoh3,
        ccoh4,
        ccoh5,
        ccoh6,
        ccoh7,
        ccoh8,
        ccoh9,
        ccoh10,
        observaciones
        ) 
        VALUES (
            '".$datosGuia['fecharec']."',
            '".$datosGuia['fechasac']."',
            '".$datosGuia['tipo']."',
            '".$datosGuia['remision']."',
            '".$datosGuia['canales']."',
            '".$datosGuia['despacho']."',
            '".$datosGuia['consecutivog']."',
            '".$datosGuia['responsable']."',
            '".$datosGuia['beneficio']."',
            '".$datosGuia['destino']."',
            '".$datosGuia['conductor']."',
            '".$datosGuia['placa']."',
            '".$datosGuia['lotep']."',
            '".$datosGuia['ica']."',
            '".$datosGuia['guiat']."',
            '".$datosGuia['cph1']."',
            '".$datosGuia['cph2']."',
            '".$datosGuia['cph3']."',
            '".$datosGuia['cph4']."',
            '".$datosGuia['cph5']."',
            '".$datosGuia['chv1']."',
            '".$datosGuia['chv2']."',
            '".$datosGuia['chv3']."',
            '".$datosGuia['chv4']."',
            '".$datosGuia['ccoh1']."',
            '".$datosGuia['ccoh2']."',
            '".$datosGuia['ccoh3']."',
            '".$datosGuia['ccoh4']."',
            '".$datosGuia['ccoh5']."',
            '".$datosGuia['ccoh6']."',
            '".$datosGuia['ccoh7']."',
            '".$datosGuia['ccoh8']."',
            '".$datosGuia['ccoh9']."',
            '".$datosGuia['ccoh10']."',
            '".$datosGuia['observaciones']."');";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function agregarRecepcionPollo($datosGuia){
    include('../config.php');
    $sql=" INSERT INTO 
    recepcionpollo(
        fecharec,
        fechasac,
        canales,
        consecutivog,
        responsable,
        beneficio,
        destino,
        conductor,
        placa,
        cph1,
        cph2,
        cph3,
        cph4,
        cph5,
        chv1,
        chv2,
        chv3,
        chv4,
        ccoh1,
        ccoh2,
        ccoh3,
        ccoh4,
        ccoh5,
        observaciones
        ) 
        VALUES (
            '".$datosGuia['fecharec']."',
            '".$datosGuia['fechasac']."',
            '".$datosGuia['canales']."',
            '".$datosGuia['consecutivog']."',
            '".$datosGuia['responsable']."',
            '".$datosGuia['beneficio']."',
            '".$datosGuia['destino']."',
            '".$datosGuia['conductor']."',
            '".$datosGuia['placa']."',
            '".$datosGuia['cph1']."',
            '".$datosGuia['cph2']."',
            '".$datosGuia['cph3']."',
            '".$datosGuia['cph4']."',
            '".$datosGuia['cph5']."',
            '".$datosGuia['chv1']."',
            '".$datosGuia['chv2']."',
            '".$datosGuia['chv3']."',
            '".$datosGuia['chv4']."',
            '".$datosGuia['ccoh1']."',
            '".$datosGuia['ccoh2']."',
            '".$datosGuia['ccoh3']."',
            '".$datosGuia['ccoh4']."',
            '".$datosGuia['ccoh5']."',
            '".$datosGuia['observaciones']."');";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return mysqli_insert_id($link);
    }
}

function agregarItemCompra($datosCompra){
    include('../config.php');
    $contador = 0;
    foreach ($datosCompra as $datoCompra) {
    if(($datoCompra['cantidad'] > 0) && ($datoCompra['cantidad'] != '')){        
    $contador++;
        $sqlEmpresa="SELECT empresa,cod FROM sede WHERE nombre='".$datoCompra['sede']."'";
        $rsEmpresa=mysqli_query($link,$sqlEmpresa);
        if($row = mysqli_fetch_array($rsEmpresa)){
            $empresa = $row['empresa']; 
            $sede = $row['cod'];
        }

    $sql=" INSERT INTO 
    item_proveedor_compra(
        item,
        proveedor,
        cantidad,
        empresa,
        sede,
        precio,
        fecha) 
        VALUES (
        '".$datoCompra['item']."',
        '".$datoCompra['proveedor']."',
        '".$datoCompra['cantidad']."',
        '".$empresa."',
        '".$sede."',
        '".$datoCompra['precio']."',
        '".$datoCompra['fecha']."');";
    if (!mysqli_query($link, $sql)) {
            return mysqli_error($link);
        }
     }
   }
    return $contador;  
}

function eliminarItem($datos){
    include('../config.php');
    
    $sql=" DELETE FROM item_proveedor WHERE id_item_proveedor = '".$datos['id_item_proveedor']."' and proveedor = '".$datos['proveedor']."'";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $datos['id_item_proveedor'];
    }
}

function eliminarItemP($datos){
    include('../config.php');
    
    $sql=" DELETE FROM item_proveedorpollo WHERE id_item_proveedor = '".$datos['id_item_proveedor']."' and proveedor = '".$datos['proveedor']."'";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $datos['id_item_proveedor'];
    }
}

function eliminarItemPeso($datos){
    include('../config.php');
    
    $sql=" DELETE FROM recepcion_pesos WHERE id_recepcion_pesos = '".$datos['id_item_proveedor']."'";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $datos['id_item_proveedor'];
    }
}

function eliminarItemProveedor($item_proveedor_compra){
    include('../config.php');
    
    $sql=" DELETE FROM item_proveedor_compra WHERE id_item_proveedor = ".$item_proveedor_compra."";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        return $item_proveedor_compra;
    }
}

function buscarCedula($cedula){    
    include('../config.php');
    $sql = "SELECT cedula 
            FROM conductores_recepcion 
            WHERE cedula = '".$cedula."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarCedulaPollo($cedulaPollo){    
    include('../config.php');
    $sql = "SELECT cedula 
            FROM conductores_recepcion_pollo 
            WHERE cedula = '".$cedula."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarNitPlanta($nit){    
    include('../config.php');
    $sql = "SELECT nit 
            FROM beneficio 
            WHERE nit = '".$nit."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarNitProveedorPollo($nit){    
    include('../config.php');
    $sql = "SELECT nit 
            FROM proveedorpollo 
            WHERE nit = '".$nit."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarItem($item){    
    include('../config.php');
    $sql = "SELECT item 
            FROM plantilla 
            WHERE item = '".$item."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarCodigo($codigo){    
    include('../config.php');
    $sql = "SELECT codigo 
            FROM plantilla 
            WHERE codigo = '".$codigo."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarCedulaResponsable($cedula){    
    include('../config.php');
    $sql = "SELECT cedula 
            FROM responsables 
            WHERE cedula = '".$cedula."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarPlacaD($cedula){    
    include('../config.php');
    $sql = "SELECT placa 
            FROM placas 
            WHERE placa = '".$cedula."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarCedulaConductor($cedula){    
    include('../config.php');
    $sql = "SELECT cedula 
            FROM conductores 
            WHERE cedula = '".$cedula."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        $respuesta = "DESOCUPADO";
        return $respuesta; 
    }
}

function buscarPlaca($datosPlacaR){    
    include('../config.php');
    $sql = "SELECT placa 
            FROM placas_recepcion 
            WHERE placa = '".$datosPlacaR['placa']."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        return agregarPlacaRecepcion($datosPlacaR); 
    }
}

function buscarPlacaPollo($datosPlacaR){    
    include('../config.php');
    $sql = "SELECT placa 
            FROM placas_recepcion_pollo 
            WHERE placa = '".$datosPlacaR['placa']."'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $respuesta = "OC";
        return $respuesta;
    }else{
        return agregarPlacaRecepcionPollo($datosPlacaR); 
    }
}

function agregarConductorRecepcion($datosConductor){
    include('../config.php');
    $sql=" INSERT INTO conductores_recepcion(cedula,nombres) 
    VALUES (
        '".$datosConductor['cedula']."',
        '".$datosConductor['nombresConductor']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
        
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $listaConductores_recepcion = listaConductores_recepcion_registro();
        return json_encode($listaConductores_recepcion);
    }
}

function agregarConductorRecepcionPollo($datosConductor){
    include('../config.php');
    $sql=" INSERT INTO conductores_recepcion_pollo(cedula,nombres) 
    VALUES (
        '".$datosConductor['cedula']."',
        '".$datosConductor['nombresConductor']."'
        );";
    $rs_operacion=mysqli_query($link,$sql);
        
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $listaConductores_recepcion = listaConductores_recepcion_registro_pollo();
        return json_encode($listaConductores_recepcion);
    }
}

function agregarPlacaRecepcion($datosPlacaR){
    include('../config.php');
    $sql=" INSERT INTO placas_recepcion(placa) 
    VALUES ('".$datosPlacaR['placa']."');";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $listaPlacas_recepcion = listaPlacas_recepcion_registro();
        return json_encode($listaPlacas_recepcion);
    }
}

function agregarPlacaRecepcionPollo($datosPlacaR){
    include('../config.php');
    $sql=" INSERT INTO placas_recepcion_pollo(placa) 
    VALUES ('".$datosPlacaR['placa']."');";
    $rs_operacion=mysqli_query($link,$sql);
    
    if (!$rs_operacion) {
        echo "Error al ejecutar la consulta: " . mysqli_error($link);
        exit();
      }
    else{
        $listaPlacas_recepcion = listaPlacas_recepcion_registro_pollo();
        return json_encode($listaPlacas_recepcion);
    }
}

function calcularDiferencia($datosPesoRecepcion){
    include('../config.php');
    $diferencia = $datosPesoRecepcion['total'] - $datosPesoRecepcion['peso'];
    $porcentaje_cambio = number_format((($diferencia / $datosPesoRecepcion['total']) * 100), 2, '.', '');
    if($datosPesoRecepcion['peso']<$datosPesoRecepcion['total']){
        $tipodiferencia = 'POSITIVA';
    }else{
        $tipodiferencia = 'NEGATIVA';
    }
    $sql = "UPDATE recepcion_pesos set 
              inventario = '".$datosPesoRecepcion['peso']."',
              diferencia = '".$porcentaje_cambio."',
              diferenciaPeso = '".$diferencia."',
              tipodiferencia  = '".$tipodiferencia."'
              where id_recepcion_pesos = '".$datosPesoRecepcion['id_recepcion_peso']."'";
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $sql;
     } 
}

function eliminarCalculoDiferencia($datosEPesoRecepcion){
    include('../config.php');
    
    $sql = "UPDATE recepcion_pesos set 
              inventario = '',
              diferencia = '',
              tipodiferencia  = ''
              where id_recepcion_pesos = '".$datosEPesoRecepcion['id_recepcion_peso']."'";
      
      $rs_operacion=mysqli_query($link,$sql);
      
      if (!$rs_operacion) {
        return mysqli_error($link);
      }else{        
        return $sql;
     } 
}

?>