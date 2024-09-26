<?php
session_start();

ini_set("display_errors", false);

function fsalida($cad2){
    $uno = substr($cad2, 11, 5);
    return $uno;
 }

 function fsalidaconsecutivo($cad,$cad2){
        $uno = "213DM";
        $dos = str_pad($cad, 6, '0', STR_PAD_LEFT);
        $tres = substr($cad2, 2, 2);
        return $uno."-".$dos."-".$tres;
     }

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
$fecha_actual = date("Y-m-d");
include("../config.php");

$sqlg = "SELECT id_recepcion, fecharec, remision, destino, beneficio, canales, consecutivog, fechasac, lotep, ica, guiat, certificadoc, responsable, conductor, placa, cph1, cph2, cph3, cph4, cph5, chv1, chv2, chv3, chv4, ccoh1, ccoh2, ccoh3, ccoh4, ccoh5, ccoh6, ccoh7, ccoh8, ccoh9, ccoh10, tipo, observaciones 
        FROM recepcion 
        WHERE id_recepcion = " . $id;
$c2 = mysqli_query($link, $sqlg) or die("aqui 1 ".mysqli_error($link));
$rs2 = mysqli_fetch_array($c2);

$sql3 = "SELECT empresa, sede, direccion, municipio 
         FROM destinos 
         WHERE id='".$rs2['destino']."'";
$c3 = mysqli_query($link, $sql3) or die("aqui 2 ".mysqli_error($link));
$rs3 = mysqli_fetch_array($c3);

$sql30 = "SELECT sede, municipio 
          FROM beneficio 
          WHERE id='".$rs2['beneficio']."'";
$c30 = mysqli_query($link, $sql30) or die("aqui 2 ".mysqli_error($link));
$rs30 = mysqli_fetch_array($c30);

$sql4 = "SELECT nombres, telefono 
         FROM responsables 
         WHERE cedula='".$rs2['responsable']."'";
$c4 = mysqli_query($link, $sql4) or die("aqui 3 ".mysqli_error($link));
$rs4 = mysqli_fetch_array($c4);

$sql40 = "SELECT nombres 
          FROM conductores_recepcion 
          WHERE cedula='".$rs2['conductor']."'";
$c40 = mysqli_query($link, $sql40) or die("aqui 3 ".mysqli_error($link));
$rs40 = mysqli_fetch_array($c40);

$sql = "SELECT DISTINCT p.item,ip.lote, p.descripcion 
        FROM plantilla p
        JOIN item_proveedor ip ON p.item = ip.item
        WHERE ip.proveedor = ".$id."
        ORDER BY p.descripcion ASC";        
$c = mysqli_query($link, $sql) or die("aqui 1:".mysqli_error($link));

$sql5 = "SELECT *
        FROM recepcion_pesos 
        WHERE id_recepcion = " . $id . "
        ORDER BY turno ASC";
$c5 = mysqli_query($link, $sql5) or die("aqui 1:".mysqli_error($link));
//$rs5 = mysqli_fetch_array($c5);

$resultado = [];

while ($row = mysqli_fetch_assoc($c5)) {
    $resultado[] = $row;
}
$canales = count($resultado);

$horaInicio = $resultado[0]; 
$horaFin = $resultado[$canales-1]; 

$inicio = date('H:i', strtotime($horaInicio['registro']));
$fin = date('H:i', strtotime($horaFin['registro']));

$inicioDateTime = new DateTime($inicio);
$finDateTime = new DateTime($fin);
$diferencia = $inicioDateTime->diff($finDateTime);

$tiempoTranscurrido = $diferencia->format('%H:%I');

$sql6 = "SELECT nombres, telefono 
        FROM conductores 
        WHERE cedula=".$rs2['conductor'];
$c6 = mysqli_query($link, $sql6) or die(mysqli_error($link));
$rs6 = mysqli_fetch_array($c6);

require('pdf/fpdf.php');
class PDF extends FPDF{}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Letter');

$pdf->AddFont('DejaVu','','DejaVuSans.php',true);

$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);

$logo = '../assets/img/logo-mercamio.jpg';
$pdf->Image($logo, 10, 10, 50, 15);
$pdf->ln(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY($pdf->GetX() + 60, $pdf->GetY() - 12);
$pdf->multiCell(100, 6, utf8_decode('DIFERENCIA PESOS            '), 1, 0, 'C');
$pdf->SetXY($pdf->GetX() + 160, $pdf->GetY() - 12);
$pdf->Cell(30, 6, str_pad($rs2['id_recepcion'], 6, '0', STR_PAD_LEFT), 1, 1, 'C');
$pdf->SetXY($pdf->GetX() + 160, $pdf->GetY());
$pdf->Cell(30, 12, utf8_decode('Página 1 de 1'), 1, 1, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, utf8_decode('AREA'), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode('FECHA DE CREACIÓN'), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode('FECHA DE REVISIÓN'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('VERSIÓN'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('CÓDIGO'), 1, 1, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, utf8_decode('Producción'), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode('7/11/2023'), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode('7/11/2024'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('3'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('FTO-PDM-04'), 1, 1, 'C');
$pdf->ln(3);

$pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(150, 5, utf8_decode('INFORMACIÓN RECEPCIÓN'), 1, 0, 'C');
//$pdf->Cell(40, 5, utf8_decode('LOTE PLANTA DM'), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(43, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(38, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(64, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(45, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(26, 5, utf8_decode('Fecha Recepción:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(17, 5, utf8_decode($rs2['fecharec']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(21, 5, utf8_decode('Nro Remisión:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(17, 5, utf8_decode($rs2['remision']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(21, 5, utf8_decode('Sede Destino:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(43, 5, utf8_decode($rs3['empresa']." - ".$rs3['sede']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(23,5, utf8_decode('Lote Producto:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(22, 5, utf8_decode($rs2['consecutivog']), 0, 1, '');

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(137, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(53, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(61, 5, utf8_decode('Nombre o Razón Social Planta de Beneficio:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(76, 5, utf8_decode($rs30['sede']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(16, 5, utf8_decode('Dirección:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(37, 5, utf8_decode($rs30['municipio']."-VALLE"), 0, 1, '');

$pdf->ln(7);

$pdf->Cell(190, 5, utf8_decode('PESOS CANALES'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 6);
$granTotal = 0;
//empieza 1
$r = $resultado[0];
$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Indicado'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Pesado'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Dif. gr.'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Dif. %'), 1, 0, 'C');
$pdf->Cell(9, 5, utf8_decode(''), 0, 0, 'C');

$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Indicado'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Pesado'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Dif. gr.'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Dif. %'), 1, 0, 'C');
$pdf->Cell(8.5, 5, utf8_decode(''), 0, 0, 'C');

$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Indicado'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Pesado'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Dif. gr.'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Dif. %'), 1, 1, 'C');

/* // 1
$r = $resultado[0];
$peso1 = $r['estomago1'];
$turno1 = $r['turno'];
$temperatura1 = $r['temperatura'];
// 16
$r = $resultado[15];
$peso16 = $r['estomago1'];
$turno16 = $r['turno'];
$temperatura16 = $r['temperatura'];
// 31
$r = $resultado[30];
$peso31 = $r['estomago1'];
$turno31 = $r['turno'];
$temperatura31 = $r['temperatura'];
// 46
$r = $resultado[45];
$peso46 = $r['estomago1'];
$turno46 = $r['turno'];
$temperatura46 = $r['temperatura']; */

$granTotal = $granTotal+$peso1+$peso16+$peso31+$peso46;

/* $pdf->Cell(7.5, 5, utf8_decode('1'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno1), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura1), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso1), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('16'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno16), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura16), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso16), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('31'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno31), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura31), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso31), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('46'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno46), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura46), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso46), 1, 1, 'C'); */
//termina 1

$pdf->ln(5);

$porcentajeTotalEstomago = ($totalEstomagos/$granTotal)*100;
$porcentajeTotalPierna= ($totalPiernas/$granTotal)*100;

$pdf->Cell(31, 5, utf8_decode('Total diferencia: '.$granTotal.' Kg.'), 1, 0, '');
/* $pdf->Cell(34, 5, utf8_decode('Peso Promedio Canal: '.number_format(round($granTotal/$canales)).' Kg.'), 1, 1, '');
$pdf->ln(5);
$pdf->Cell(190, 5, utf8_decode('Observaciones: '.$rs2['observaciones']), 0, 1, '');
$pdf->Cell(35, 10, utf8_decode('Hora Inicial: '.$fin), 0, 0,'');
$pdf->Cell(31, 10, utf8_decode('Hora Final: '.$inicio), 0, 0, '');
$pdf->Cell(31, 10, utf8_decode('Tiempo Total: '.$tiempoTranscurrido), 0, 0, '');
$pdf->Cell(28, 10,'Canales: '.$canales, 0, 0, '');
$pdf->Cell(65, 10, utf8_decode('Firma Responsable:____________________________'), 0, 1, ''); */
$pdf->Output('formato_recepcion', 'I');
