<?php
include('../modelo/funciones.php');

if(isset($_POST['proveedor'])){
	echo json_encode(listarItems($_POST['proveedor']));
}

if(isset($_POST['proveedorP'])){
	echo json_encode(listarItemsP($_POST['proveedorP']));
}

if(isset($_POST['compradorSede'])){
	echo json_encode(listarSedes($_POST['compradorSede']));
}

if(isset($_POST['itemPorProveedor'])){
	echo json_encode(listaItemsPorProveedor($_POST['itemPorProveedor']));
}

if(isset($_POST['proveedorPorItem'])){
	echo json_encode(listaProveedorPorItem($_POST['proveedorPorItem']));
}

if(isset($_POST['idGuia'])){
	echo json_encode(cargarGuia($_POST['idGuia']));
}

if(isset($_POST['idGuiaP'])){
	echo json_encode(cargarGuiaP($_POST['idGuiaP']));
}

if(isset($_POST['idRecepcion'])){
	echo json_encode(cargarGuiaRecepcion($_POST['idRecepcion']));
}
if(isset($_GET['copiarDatos'])){
	echo json_encode(cargarDatos());
}
if(isset($_POST['idResp'])){
	echo json_encode(cargarResponsable($_POST['idResp']));
}

if(isset($_POST['idCond'])){
	echo json_encode(cargarConductor($_POST['idCond']));
}

if(isset($_POST['idItem'])){
	echo json_encode(cargarItem($_POST['idItem']));
}

if(isset($_POST['idcriterio'])){
	echo json_encode(cargarCriterio($_POST['idcriterio']));
}

if(isset($_POST['idcriterioP'])){
	echo json_encode(cargarCriterioP($_POST['idcriterioP']));
}

if(isset($_POST['idPeso'])){
	echo json_encode(cargarCriterioPeso($_POST['idPeso']));
}

if(isset($_POST['infoEdit'])){
	echo json_encode(editarGuia($_POST['infoEdit']));
}

if(isset($_POST['infoEditP'])){
	echo json_encode(editarGuiaP($_POST['infoEditP']));
}

if(isset($_POST['datosEdit'])){
	echo json_encode(editarRecepcion($_POST['datosEdit']));
}

if(isset($_POST['infoEditResp'])){
	echo json_encode(editarResponsable($_POST['infoEditResp']));
}

if(isset($_POST['infoEditCond'])){
	echo json_encode(editarConductor($_POST['infoEditCond']));
}

if(isset($_POST['infoEditItem'])){
	echo json_encode(editarItem($_POST['infoEditItem']));
}

if(isset($_POST['infoCriEdit'])){
	echo json_encode(editarCriterio($_POST['infoCriEdit']));
}

if(isset($_POST['infoCriEditP'])){
	echo json_encode(editarCriterioP($_POST['infoCriEditP']));
}

if(isset($_POST['infoPesoEdit'])){
	echo json_encode(editarCriterioPeso($_POST['infoPesoEdit']));
}

if(isset($_POST['infoPesoEditCerdo'])){
	echo json_encode(editarCriterioPesoCerdo($_POST['infoPesoEditCerdo']));
}

if(isset($_POST['idBloquear'])){
	echo json_encode(bloquearGuia($_POST['idBloquear']));
}

if(isset($_POST['idBloquearP'])){
	echo json_encode(bloquearGuiaP($_POST['idBloquearP']));
}

if(isset($_POST['idBloquearR'])){
	echo json_encode(bloquearGuiaR($_POST['idBloquearR']));
}

if(isset($_POST['idDesbloquear'])){
	echo json_encode(desbloquearGuia($_POST['idDesbloquear']));
}

if(isset($_POST['idDesbloquearP'])){
	echo json_encode(desbloquearGuiaP($_POST['idDesbloquearP']));
}

if(isset($_POST['idDesbloquearR'])){
	echo json_encode(desbloquearGuiaR($_POST['idDesbloquearR']));
}

if(isset($_POST['datos'])){
	echo json_encode(agregarItem($_POST['datos']));
}

if(isset($_POST['datosP'])){
	echo json_encode(agregarItemP($_POST['datosP']));
}

if (isset($_POST['datosPeso'])) {
    echo agregarPeso($_POST['datosPeso']);
} 

if (isset($_POST['datosPesoCerdo'])) {
    echo agregarPesoCerdo($_POST['datosPesoCerdo']);
} 

if(isset($_POST['datosResp'])){
	echo json_encode(agregarResponsable($_POST['datosResp']));
}

if(isset($_POST['datosCond'])){
	echo json_encode(agregarConductor($_POST['datosCond']));
}

if(isset($_POST['datosItem'])){
	echo json_encode(agregarNuevoItem($_POST['datosItem']));
}

if(isset($_POST['datosPlaca'])){
	echo json_encode(agregarPlaca($_POST['datosPlaca']));
}

if(isset($_POST['datosSede'])){
	echo json_encode(agregarSede($_POST['datosSede']));
}

if(isset($_POST['datosE'])){
	echo json_encode(eliminarItem($_POST['datosE']));
}

if(isset($_POST['datosEP'])){
	echo json_encode(eliminarItemP($_POST['datosEP']));
}

if(isset($_POST['datosEPeso'])){
	echo json_encode(eliminarItemPeso($_POST['datosEPeso']));
}

if(isset($_POST['datosEliminarSede'])){
	echo json_encode(eliminarSede($_POST['datosEliminarSede']));
}

if(isset($_POST['id_item_proveedor'])){
	echo json_encode(eliminarItemProveedor($_POST['id_item_proveedor']));
}

if (isset($_POST['datosGuia'])) {
    $resultado = agregarGuia($_POST['datosGuia']);
    echo json_encode($resultado);
}

if (isset($_POST['datosGuiaP'])) {
    $resultado = agregarGuiaP($_POST['datosGuiaP']);
    echo json_encode($resultado);
}

if(isset($_POST['datosRecepcion'])){
	echo json_encode(agregarRecepcion($_POST['datosRecepcion']));
}

if(isset($_POST['datosCompra'])){
	echo json_encode(agregarItemCompra($_POST['datosCompra']));
}

if(isset($_POST['cedula'])){
	echo json_encode(buscarCedula($_POST['cedula']));
}

if(isset($_POST['datosConductor'])){
	echo json_encode(agregarConductorRecepcion($_POST['datosConductor']));
}

if(isset($_POST['datosPlacaR'])){
	echo json_encode(buscarPlaca($_POST['datosPlacaR']));
}

/* if(isset($_POST['datosConductor'])){
	echo json_encode(agregarConductorRecepcion($_POST['datosConductor']));
} */

if(isset($_POST['datosPesoRecepcion'])){
	echo json_encode(calcularDiferencia($_POST['datosPesoRecepcion']));
}

if(isset($_POST['datosEPesoRecepcion'])){
	echo json_encode(eliminarCalculoDiferencia($_POST['datosEPesoRecepcion']));
}
?>