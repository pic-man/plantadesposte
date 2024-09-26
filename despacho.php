<?php
session_start();
error_reporting(0);
date_default_timezone_set("America/bogota");
require_once('./modelo/funciones.php');
$listaResponsables = listaResponsables();
$listaConductores = listaConductores();
$listaPlacas = listaPlacas();
$listaOrigen = listaOrigen();
$listaDestinos = listaDestinos();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Planta de Desposte | Despacho</title>
  <?php include_once('encabezado.php');?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
</head>
<body>
 <?php include_once('menu.php');?>
 <?php include_once('menuizquierda.php');?> 
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Guia de transporte y destino de carne</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                <center>
                  <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor"
                   title="Agregar Nueva Guia" id="crearProveedor">AGREGAR GUIA</a>
                </center>
              <table id="jtable" class="table table-striped table-bordered table-hover datatable">
              <thead>
                    <tr>
                        <th>Consecutivo<br>Tipo</th>
                        <th>Fecha<br>Lote</th>
                        <th>Destino<br>&nbsp;</th>
                        <th>Conductor<br>Placa</th>
                        <th>Acción<br>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

<div class="modal fade" id="modalNuevoProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #00000042 !important;">

    <div class="modal-dialog modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">

			<div class="modal-content">
        <div class="modal-header" style="display: block;text-align: center;">
          <label style="text-align: center;font-weight: bold;" id="titulo">AGREGAR GUIA</label>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
				<div class="modal-body">
					<form method="POST" id="criteriosForm">
						<div class="row">
							<div class="col-md-6">
								Fecha de Expedicion
								<div class="form-group label-floating" id="fechaExpDiv">
									<input type="date" class="form-control" autocomplete="off" id="fechaexp" name="fechaexp" placeholder="Ingrese fecha Expedicion" >
								</div>
								<div class="alert alert-danger" role="alert" id="fechaExpE">
									Debes ingresar fecha de expedicion
								</div>
							</div>

							<div class="col-md-6">
								Especie
								<div class="form-group label-floating" id="telefonoDiv">
									<select class="form-control" id="producto" name="producto">
										<option value="">Seleccione Especie</option>
										<option value="CERDO">CERDO</option>
										<option value="POLLO">POLLO</option>
										<option value="RES">RES</option>
									</select>
								</div>
								<div class="alert alert-danger" role="alert" id="productoE" style="display: none;">
									Debes seleccionar la especie a despachar
								</div>
							</div>

							<div class="col-md-6">
								Lote
								<div class="form-group label-floating" id="codigoAutoDiv">
									<input type="text" class="form-control" autocomplete="off" id="consecutivog" name="consecutivog" placeholder="Ingrese Lote">
									<input type="hidden" id="id_guia">
								</div>
								<div class="alert alert-danger" role="alert" id="consecutivogE" style="display: none">
									Debes ingresar el lote a despachar
								</div>
							</div>

							<div class="col-md-6" id="labelCanales">
								Nro de Canales
								<div class="form-group label-floating" id="conseGuiaDiv">
									<input class="form-control" type="number" name="canales" autocomplete="off" id="canales" placeholder="Ingrese el Nro de Canales">
								</div>
								<div class="alert alert-danger" role="alert" id="canalesE" style="display: none">
									Debe ingresar la cantidad de Canales
								</div>
							</div>

							<div class="col-md-6">
								Responsable Despacho
								<div class="form-group label-floating" id="conseGuiaDiv">
									<select class="form-control" id="responsable" name="responsable" disabled>
										<option value="">Seleccione Responsable de Despacho</option>
										<?php foreach ($listaResponsables as $perm) : ?>
											<option value="<?php echo $perm['cedula'] ?>">
												<?php echo $perm['nombres'] . " - " . $perm['cedula'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="alert alert-danger" role="alert" id="responsableE" style="display: none">
									Debe seleccinar el eesponsable del despacho
								</div>
							</div>

							<div class="col-md-6">
								Destino
								<div class="form-group label-floating" id="conseGuiaDiv">
									<select class="form-control" id="destino" name="destino">
										<option value="">Seleccione Destino de Despacho</option>
										<?php foreach ($listaDestinos as $perm) : ?>
											<option value="<?php echo $perm['id'] ?>">
												<?php echo $perm['empresa'] . " - " . $perm['sede'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="alert alert-danger" role="alert" id="destinoE" style="display: none">
									Debe seleccinar el destino del despacho
								</div>
							</div>

							<div class="col-md-6">
								Nombre del Conductor
								<div class="form-group label-floating" id="conseGuiaDiv">
									<select class="form-control" id="conductor" name="conductor">
										<option value="">Seleccione el Conductor de Despacho</option>
										<?php foreach ($listaConductores as $perm) : ?>
											<option value="<?php echo $perm['cedula'] ?>">
												<?php echo $perm['nombres'] . " - " . $perm['cedula'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="alert alert-danger" role="alert" id="conductorE" style="display: none">
									Debe seleccinar el conductor
								</div>
							</div>

							<div class="col-md-6">
								Placa Vehiculo
								<div class="form-group label-floating" id="conseGuiaDiv">
									<select class="form-control" id="placa" name="placa">
										<option value="">Seleccione la Placa del Vehiculo</option>
										<?php foreach ($listaPlacas as $perm) : ?>
											<option value="<?php echo $perm['placa'] ?>">
												<?php echo $perm['placa'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="alert alert-danger" role="alert" id="placaE" style="display: none">
									Debe seleccinar la placa del vehiculo
								</div>
							</div>

							<div class="col-md-6">
								Precinto
								<div class="form-group label-floating" id="codigoAutoDiv">
									<input type="text" class="form-control" autocomplete="off" id="precinto" name="precinto" placeholder="Ingrese Precinto">
								</div>
								<div class="alert alert-danger" role="alert" id="precintoE" style="display: none">
									Debes ingresar el precinto
								</div>
							</div>

							<div class="col-md-6">
								Observaciones
								<div class="form-group label-floating" id="observacionesDiv">
									<input type="text" class="form-control" autocomplete="off" id="observaciones" name="observaciones" placeholder="Ingrese observaciones">
								</div>
							</div>

						</div>
					</form>
					<div class="row mt-5">
						<div class="col-md-12" style="text-align:center">
							<button class="btn btn-primary" style="margin-bottom: 30px; margin-top: 10px;" rel="tooltip" data-placement="bottom" title="Guardar Guia" id="btnNuevoProveedor">Guardar</button>
							<button class="btn btn-primary" style="margin-bottom: 30px; margin-top: 10px;display:none" rel="tooltip" data-placement="bottom" title="Editar Guia" id="btnEditProveedor">Editar</button>
							<button class="btn btn-danger" style="margin-bottom: 30px; margin-top: 10px;" data-bs-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modalCriterios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 	aria-hidden="true" style="background-color: #00000042 !important;">
		<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog modal-fullscreen modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header" style="display: block;text-align: center;">
                <h5 class="modal-title" id="titulo2" style="font-weight: bold; text-align: center;"></h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="criteriosForm">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="tipo" id="tipo">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="valorCriterio">Item</label>
                            <div class="form-group">
                                <input class="form-control" list="datalistValorCriterio" autocomplete="off" id="valorCriterio" placeholder="Busca el Item para agregarlo">
                                <datalist id="datalistValorCriterio"></datalist>
                            </div>
                            <div class="alert alert-danger" role="alert" id="itemE" style="display: none">
                                Debe seleccionar el item
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lotes">Lote</label>
                            <div class="form-group">
                                <input class="form-control" autocomplete="off" id="lotes" name="lotes" placeholder="Ingrese el Lote del Item">
                                <input type="hidden" id="id_criterio" name="id_criterio">
                            </div>
                            <div class="alert alert-danger" role="alert" id="loteItemE" style="display: none">
                                Debe ingresar el lote del item
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="temperatura">Temperatura</label>
                            <div class="form-group">
                                <input class="form-control" type="number" name="temperatura" autocomplete="off" id="temperatura" placeholder="Selecciona la Temperatura del Item">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="unidades">Unidades</label>
                            <div class="form-group">
                                <input class="form-control" type="number" name="unidades" autocomplete="off" id="unidades" placeholder="Selecciona las Unidades del Item">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="peso">Peso</label>
                            <div class="form-group">
                                <input type="number" class="form-control" name="peso" autocomplete="off" id="peso" placeholder="Ingrese el Peso del Item">
                            </div>
                            <div class="alert alert-danger" role="alert" id="pesoE" style="display: none">
                                Debe ingresar el peso del item
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cajas">Canastillas</label>
                            <div class="form-group">
                                <input class="form-control" type="number" min="1" name="cajas" autocomplete="off" id="cajas" placeholder="Ingrese la cantidad de Canastillas del Item">
                            </div>
                            <div class="alert alert-danger" role="alert" id="canastillasE" style="display: none">
                                Debe ingresar la cantidad de canastillas del item
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center mb-3">
                    <button class="btn btn-primary" rel="tooltip" data-placement="bottom" title="Agregar Item" id="btnNuevoCriterio">Guardar</button>
                    <button class="btn btn-primary" rel="tooltip" data-placement="bottom" title="Editar Item" id="btnEditarCriterio" style="display: none;">Editar</button>
                    <button class="btn btn-danger" data-placement="bottom" data-bs-dismiss="modal">Cerrar</button>
                </div>
                <div class="table-responsive">
                    <table id="jtableCriterio" class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Descripción</th>
                                <th>Lote</th>
                                <th>Temperatura</th>
                                <th>Und</th>
                                <th>Canastillas</th>
                                <th>Peso</th>
                                <th>Hora</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyCriterio"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>	
<?php require_once('scripts.php');?>
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.datatables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script>
    $(document).ready(function() {
      $(document).ready(function() {
      var dataTable = $('#jtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "bDestroy": true,
        "order": [
          [0, 'desc']
        ],
        "ajax": {
          url: "tablas/tablaProveedores.php",
          type: "post"
        },
        "language": {
          "searchPlaceholder": "Ingrese caracter",
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": " _START_ a _END_ de _TOTAL_",
          "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Consultar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst": "<<",
            "sLast": ">>",
            "sNext": ">",
            "sPrevious": "<"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
    });
    $('#jtable').css('width', '100%');
    $('#jtable_filter input, #jtable_length select').addClass('form-control');
});

function eliminarItem(id_item_proveedor) {
    Swal.fire({
        title: '¿Esta seguro que desea eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
			const datosE = {
				id_item_proveedor: id_item_proveedor,
				proveedor: $('#id').val()
			};

            console.log('datos para eliminar: ',datosE);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'controlador/controlador.php',
				data: {
					datosE: datosE
				},
				success: function(data) {
					$('#jtableCriterio').DataTable().ajax.reload();
					buscarItems($('#id').val(), $('#tipo').val());
				}
			});
        }
    });
}		

		function abrirModal(consecutivoGuia, lote, status, tipo) {
			$('#titulo2').text('Consecutivo Guia: ' + consecutivoGuia);
			console.log('lote: ', lote);
			if(lote != '0'){
				$('#lotes').val(lote);
			}
			if((status==1) || (tipo == 0)){
				$('#btnNuevoCriterio').css('display', 'initial');
				$('#btnEditarCriterio').css('display', 'none');
			}else{
				$('#btnNuevoCriterio').css('display', 'none');
				$('#btnEditarCriterio').css('display', 'none');
			}
			$('#valorCriterio').val('');
			$('#temperatura').val('');
			$('#unidades').val('');
			$('#cajas').val('');
			$('#peso').val('');
		}

		function buscarItems(id, tipo) {
			$('#itemE').css('display', 'none');
			$('#loteItemE').css('display', 'none');
			$('#canastillasE').css('display', 'none');
			$('#pesoE').css('display', 'none');
			$('#id').val(id);
			$('#tipo').val(tipo);
			const datosItems = {
				id: id,
				tipo: tipo,
			};
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'controlador/controlador.php',
				data: {
					proveedor: datosItems
				},
				success: function(data) {
					$('#datalistValorCriterio').empty();
					for (i = 0; i < data.length; i++) {
						$('#datalistValorCriterio').append("<option data-value='" + data[i]['item'] + "' value='" + data[i]['descripcion'] + "'>" + data[i]['codigo'] + "</option>");
					}
					$('#valorCriterio').val('');
				}
			});

			$('#jtableCriterio').dataTable({    
        		"paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
        		"processing": true,
        		"serverSide": true,
        		"bDestroy": true,
        		"order": [
            		[0, 'desc']
        		],
        		"columnDefs": [{
            	"orderable": false,
            	"targets": [9]
        		}],
				"ajax": {
					url: "tablas/tablaCriterios.php",
					type: "post",
					data: {
						proveedor: id
					}
				},
				"language": {
            "searchPlaceholder": "Ingrese caracter",
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Consultar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "<<",
                "sLast": ">>",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        },
        "dom": '<"row"<"col-md-6"l><"col-md-6"f>><"row"<"col-md-12"tr>><"row"<"col-md-6"i><"col-md-6"p>>',
    });

    // Estilo personalizado para alinear y espaciar los botones de paginación
    $('#jtableCriterio_paginate').addClass('text-md-right mt-3').css('float', 'center');
    $('#jtableCriterio_paginate .paginate_button').addClass('ml-1');
};

		$('#btnNuevoCriterio').click(function() {
			validacionesCri = validacionesC();
			if (validacionesCri == ""){
				const datos = {
					item: $('#datalistValorCriterio [value="' + $('#valorCriterio').val() + '"]').data('value'),
					lote: $('#lotes').val(),
					temperatura: $('#temperatura').val(),
					unidades: $('#unidades').val(),
					cajas: $('#cajas').val(),
					peso: $('#peso').val(),
					proveedor: $('#id').val()
				};
				console.log('datos a enviar: ', datos);
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: 'controlador/controlador.php',
					data: {
						datos: datos
					},
					success: function(data) {
						$('#valorCriterio').val('');
						$('#temperatura').val('');
						$('#unidades').val('');
						$('#cajas').val('');
						$('#peso').val('');
						$('#jtableCriterio').DataTable().ajax.reload();
						buscarItems($('#id').val(), $('#tipo').val());
						Swal.fire({
        					title: 'Item registrado satisfactoriamente',
        					text: '',
        					icon: 'success',
        					timer: 1000, 
    						showConfirmButton: false
      					});
					}
				});
			}
		});

		$('#crearProveedor').click(function() {
			var today = new Date();
        	var day = String(today.getDate()).padStart(2, '0');
        	var month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
        	var year = today.getFullYear();
	        var formattedDate = year + '-' + month + '-' + day;
        
			$('#titulo').text('AGREGAR GUIA');
			$('#btnNuevoProveedor').css('display', 'initial');
			$('#btnEditProveedor').css('display', 'none');
        	$('#fechaexp').val(formattedDate);
			$('#consecutivog').val('');
			$('#responsable').val(<?php echo $_SESSION['usuario'];?>);
			$('#canales').val('');
			$('#destino').val('');
			$('#conductor').val('');
			$('#placa').val('');
			$('#producto').val('');
			$('#precinto').val('');
			$('#observaciones').val('');
			$('#fechaExpE').css('display', 'none');
			$('#productoE').css('display', 'none');
			$('#consecutivogE').css('display', 'none');
			$('#canalesE').css('display', 'none');
			$('#responsableE').css('display', 'none');
			$('#destinoE').css('display', 'none');
			$('#conductorE').css('display', 'none');
			$('#placaE').css('display', 'none');
			$('#precintoE').css('display', 'none');
		});

		$('#btnNuevoProveedor').click(function() {
    		let validacionesF = validaciones();

    		if (validacionesF == "") {
        	const datosGuia = {
            	fechaexp: $('#fechaexp').val(),
            	consecutivog: $('#consecutivog').val(),
            	responsable: $('#responsable').val(),
            	destino: $('#destino').val(),
            	conductor: $('#conductor').val(),
            	placa: $('#placa').val(),
            	producto: $('#producto').val(),
            	canales: $('#canales').val(),
            	precinto: $('#precinto').val(),
            	observaciones: $('#observaciones').val()
        	};

        	console.log('datos a guardar:', datosGuia);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'controlador/controlador.php',
            data: { datosGuia: datosGuia },
            success: function(response) {
                if (response.status === "success") {
                    $('#jtable').DataTable().ajax.reload();
                    $('#fechaexp').val('');
                    $('#consecutivog').val('');
                    $('#responsable').val('');
                    $('#destino').val('');
                    $('#conductor').val('');
                    $('#placa').val('');
                    $('#producto').val('');
                    $('#precinto').val('');
                    $('#observaciones').val('');
                    $("#modalNuevoProveedor").modal('hide');
                    Swal.fire({
                        title: 'Nuevo despacho registrado satisfactoriamente',
                        text: '',
                        icon: 'success',
                        timer: 1000, 
    					showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        timer: 1000, 
    					showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema con la solicitud. Inténtelo de nuevo más tarde.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.error('Error:', error);
            }
        });
    }
});

		function buscarGuia(idGuia,tipo) {
			$('#id_guia').val(idGuia);
			$('#titulo').text('EDITAR GUIA');
			$('#btnNuevoProveedor').css('display', 'none');
			$('#btnEditProveedor').css('display', 'initial');
			if(tipo == 'POLLO'){
				$('#consecutivog').prop('disabled', true).val('0');
			}else{
				$('#consecutivog').prop('disabled', false);
			}
			console.log('consulta: ', idGuia);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'controlador/controlador.php',
				data: {
					idGuia: idGuia
				},
				success: function(data) {
					console.log(data);
					$('#fechaexp').val(data[0].fechaexp);
					$('#consecutivog').val(data[0].consecutivog);
					$('#responsable').val(data[0].responsable);
					$('#conductor').val(data[0].conductor);
					$('#placa').val(data[0].placa);
					$('#destino').val(data[0].destino);
					$('#canales').val(data[0].canales);
					$('#producto').val(data[0].tipo);
					$('#precinto').val(data[0].precinto);
					$('#observacion').val(data[0].observacion);
				}
			});
		}

		function buscarCriterio(idcriterio) {
			$('#id_criterio').val(idcriterio);
			$('#titulo').text('Editar Registro');
			$('#btnNuevoCriterio').css('display', 'none');
			$('#btnEditarCriterio').css('display', 'initial');
			console.log('consulta: ', idcriterio);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'controlador/controlador.php',
				data: {
					idcriterio: idcriterio
				},
				success: function(data) {
					console.log('valores recibidos: ',data);
					$('#valorCriterio').val(data[0].item);
					$('#lote').val(data[0].lote);
					$('#temperatura').val(data[0].temperatura);
					$('#unidades').val(data[0].unidades);
					$('#cajas').val(data[0].cajas);
					$('#peso').val(data[0].peso);
				}
			});
		}

		function bloquearEdicion(idBloquear) {
			 $.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'controlador/controlador.php',
				data: {
					idBloquear: idBloquear
				},
				success: function(data) {
					$('#jtable').DataTable().ajax.reload();
				}
			});
		}

		$('#btnEditProveedor').click(function() {
			validacionesF = validaciones();
			if (validacionesF == "") {
				infoEdit = {
					"id_guia": $('#id_guia').val(),
					"fechaexp": $('#fechaexp').val(),
					"consecutivog": $('#consecutivog').val(),
					"producto": $('#producto').val(),
					"canales": $('#canales').val(),
					"responsable": $('#responsable').val(),
					"destino": $('#destino').val(),
					"conductor": $('#conductor').val(),
					"placa": $('#placa').val(),
					"precinto": $('#precinto').val(),
					"observaciones": $('#observaciones').val()
				};
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: 'controlador/controlador.php',
					data: {
						infoEdit
					},
					success: function(data) {
						$("#modalNuevoProveedor").modal('hide');
						$('#jtable').DataTable().ajax.reload();
						Swal.fire({
        					title: 'Despacho modificado satisfactoriamente',
        					text: '',
        					icon: 'success',
        					timer: 1000, 
    						showConfirmButton: false
      					});
					}
				});
			}
		});

		function validaciones() {
				$('#fechaExpE').css('display', 'none');
				$('#productoE').css('display', 'none');
				$('#consecutivogE').css('display', 'none');
				$('#canalesE').css('display', 'none');
				$('#responsableE').css('display', 'none');
				$('#destinoE').css('display', 'none');
				$('#conductorE').css('display', 'none');
				$('#placaE').css('display', 'none');
				$('#precintoE').css('display', 'none');

				if ($("#fechaexp").val() == null || $("#fechaexp").val() == "") {
                	$('#fechaExpE').css('display', 'block');
					return 'R';
                }
				if ($("#producto").val() == null || $("#producto").val() == "") {
					$('#productoE').css('display', 'block');
                    return 'R';
                }

				if ($("#consecutivog").val() == null || $("#consecutivog").val() == "") {
					$('#consecutivogE').css('display', 'block');
                    return 'R';
                }
				if ($("#canales").val() == null || $("#canales").val() == "") {
					$('#canalesE').css('display', 'block');
                    return 'R';
                }
				if ($("#responsable").val() == null || $("#responsable").val() == "") {
					$('#responsableE').css('display', 'block');
                    return 'R';
                }
				if ($("#destino").val() == null || $("#destino").val() == "") {
					$('#destinoE').css('display', 'block');
                    return 'R';
                }
				if ($("#conductor").val() == null || $("#conductor").val() == "") {
					$('#conductorE').css('display', 'block');
                    return 'R';
                }
				if ($("#placa").val() == null || $("#placa").val() == "") {
					$('#placaE').css('display', 'block');
                    return 'R';
                }
				if ($("#precinto").val() == null || $("#precinto").val() == "") {
					$('#precintoE').css('display', 'block');
                    return 'R';
                }
                return "";
            }

			$('#btnEditarCriterio').click(function() {
			validacionesCri = validacionesC();
			if (validacionesCri == "") {
				infoCriEdit = {
					"id_criterio": $('#id_criterio').val(),
					"item": $('#datalistValorCriterio [value="' + $('#valorCriterio').val() + '"]').data(
                                'value'),
					"lote": $('#lotes').val(),
					"temperatura": $('#temperatura').val(),
					"unidades": $('#unidades').val(),
					"cajas": $('#cajas').val(),
					"peso": $('#peso').val(),
				};
				console.log('datos enviados:',infoCriEdit);
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: 'controlador/controlador.php',
					data: {
						infoCriEdit
					},
					success: function(data) {
						$('#btnNuevoCriterio').css('display', 'initial');
						$('#btnEditarCriterio').css('display', 'none');
						$('#valorCriterio').val('');
						$('#lote').val('');
						$('#temperatura').val('');
						$('#unidades').val('');
						$('#cajas').val('');
						$('#peso').val('');
						$('#jtableCriterio').DataTable().ajax.reload();
						Swal.fire({
        					title: 'Item modificado satisfactoriamente',
        					text: '',
        					icon: 'success',
        					timer: 1000, 
    						showConfirmButton: false
      					});

					}
				});
			}
		});

		function validacionesC() {
				$('#itemE').css('display', 'none');
				$('#loteItemE').css('display', 'none');
				$('#canastillasE').css('display', 'none');
				$('#pesoE').css('display', 'none');

				if ($("#valorCriterio").val() == null || $("#valorCriterio").val() == "") {
                	$('#itemE').css('display', 'block');
					return 'R';
                }
				if ($("#lotes").val() == null || $("#lotes").val() == "") {
					$('#loteItemE').css('display', 'block');
                    return 'R';
                }
				if ($("#peso").val() == null || $("#peso").val() == "") {
					$('#pesoE').css('display', 'block');
                    return 'R';
                }
				if ($("#cajas").val() == null || $("#cajas").val() == "") {
					$('#canastillasE').css('display', 'block');
                    return 'R';
                }
                return "";
        }

  /* $('#producto').change(function() {
    var selectedValue = $(this).val();
    if (selectedValue === 'POLLO') {
        $('#consecutivog').prop('disabled', true).val('0'); 
        $('#labelCanales').contents().filter(function() {
            return this.nodeType === 3; 
        }).first().replaceWith('Nro de Pollos'); 
        $('#canales').attr('placeholder', 'Ingrese el Nro de Pollos'); // Cambia el placeholder del input
        $('#canalesE').text('Debe ingresar la cantidad de Pollos'); // Cambia el texto del mensaje de error
    } else {
        $('#consecutivog').prop('disabled', false).val(''); // Habilita el input y limpia el valor
        $('#labelCanales').contents().filter(function() {
            return this.nodeType === 3;
        }).first().replaceWith('Nro de Canales'); // Cambia el texto de vuelta a "Nro de Canales"
        $('#canales').attr('placeholder', 'Ingrese el Nro de Canales'); // Cambia el placeholder del input
        $('#canalesE').text('Debe ingresar la cantidad de Canales'); // Cambia el texto del mensaje de error
    } 
});*/


	</script>	
</html>