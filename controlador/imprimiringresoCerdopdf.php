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

/* $sql = "SELECT distinct plantilla.item, descripcion, lote
        FROM plantilla, item_proveedor 
        WHERE plantilla.item = item_proveedor.item 
        AND item_proveedor.proveedor = " . $id . "
        ORDER BY registro DESC"; */
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
$pdf->multiCell(100, 6, utf8_decode('FORMATO RECEPCIÓN CANALES PORCINAS            '), 1, 0, 'C');
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

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(53, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(72, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(65, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(18, 5, utf8_decode('No Canales:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(35, 5, utf8_decode($rs2['canales']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(21, 5, utf8_decode('Lote Beneficio:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(64, 5, utf8_decode($rs2['lotep']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(33, 5, utf8_decode('Fecha Beneficio:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(32, 5, utf8_decode($rs2['fechasac']), 0, 1, '');

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(46, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(81, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(63, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(15, 5, utf8_decode('Guia ICA:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(31, 5, utf8_decode($rs2['ica']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(50, 5, utf8_decode('Guia Transporte de Carne en Canal:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(31, 5, utf8_decode($rs2['guiat']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(33, 5, utf8_decode('Certificado de Calidad:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(30, 5, utf8_decode($rs2['certificadoc']), 0, 1, '');

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(77, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(76, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(37, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(32, 5, utf8_decode('Nombre Responsable:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(45, 5, utf8_decode($rs4['nombres']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(28, 5, utf8_decode('Nombre Conductor:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(48, 5, utf8_decode($rs40['nombres']), 0, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(23, 5, utf8_decode('Placa Vehiculo:'), 0, 0, '');
$pdf->SetFont('Arial', '', 8);$pdf->Cell(40, 5, utf8_decode($rs2['placa']), 0, 1, '');
$pdf->ln(2);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 5, utf8_decode('Cumplimiento Practicas Higiénicas Personal Manipulador'), 1, 1, '');

//$pdf->SetFont('DejaVu', '', 6);
$pdf->SetFont('ZapfDingbats', '', 6);
//$checkmark = html_entity_decode('&#10004;', ENT_COMPAT, 'UTF-8');
//$checkmark = mb_convert_encoding(chr(10004), 'UTF-8', 'UTF-32BE');
//$checkmark = '✔';

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(34, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(41, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(43, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(46, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(26, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 6);

$rs2['cph1'] == 1 ? $checkmark1 = chr(51) : $checkmark1 = chr(53);
$rs2['cph2'] == 1 ? $checkmark2 = chr(51) : $checkmark2 = chr(53);
$rs2['cph3'] == 1 ? $checkmark3 = chr(51) : $checkmark3 = chr(53);
$rs2['cph4'] == 1 ? $checkmark4 = chr(51) : $checkmark4 = chr(53);
$rs2['cph5'] == 1 ? $checkmark5 = chr(51) : $checkmark5 = chr(53);

$pdf->Cell(25, 5, 'Usa cofia y tapabocas: ', 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(9, 5, $checkmark1  , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(32, 5, utf8_decode('Capa limpia y en buen estado:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(9, 5,  $checkmark2 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(34, 5, utf8_decode('Botas limpias y en buen estado:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(9, 5,  $checkmark3 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(37, 5, utf8_decode('Uñas cortas limpias y sin esmalte:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(9, 5,  $checkmark4 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(21, 5, utf8_decode('No usa accesorios:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(5, 5,  $checkmark5 , 0, 1, '');

$pdf->SetFont('Arial', 'B', 6);

$pdf->ln(2);

$rs2['chv2'] == 1 ? $checkmark1 = chr(51) : $checkmark1 = chr(53);
$rs2['chv3'] == 1 ? $checkmark2 = chr(51) : $checkmark2 = chr(53);
$rs2['chv4'] == 1 ? $checkmark3 = chr(51) : $checkmark3 = chr(53);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 5, utf8_decode('Cumplimento Condiciones Higiénico Sanitarias Del Vehículo De Transporte'), 1, 1, '');

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(32, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(45, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(62, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(51, 5,'', 1, 1, '');
$pdf->ln(-5);
$pdf->SetFont('Arial', 'B', 6);

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(28, 5, utf8_decode('Temperatura del Vehículo:'), 0, 0, '');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(4, 5, utf8_decode($rs2['chv1']."°"), 1, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(41, 5, utf8_decode('¿Vehículo limpio y ausente de plagas?:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 9);
$pdf->Cell(4, 5,  $checkmark1 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(58, 5, utf8_decode('¿Se transportan sustancias químicas con las canales?:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 9);
$pdf->Cell(4, 5,  $checkmark2 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(47, 5, utf8_decode('¿Se transporta canales de una sola especie?:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 9);
$pdf->Cell(3, 5,  $checkmark3 , 0, 1, '');

$pdf->SetFont('Arial', 'B', 6);

$pdf->ln(3);

$pdf->Cell(190, 5, utf8_decode('Cumplimiento Características Organolépticas e Higiénico Sanitarias De La Canales'), 1, 1, '');
$pdf->SetFont('Arial', '', 6);

$rs2['ccoh1'] == 1 ? $checkmark1 = chr(51) : $checkmark1 = chr(53);
$rs2['ccoh2'] == 1 ? $checkmark2 = chr(51) : $checkmark2 = chr(53);
$rs2['ccoh3'] == 1 ? $checkmark3 = chr(51) : $checkmark3 = chr(53);
$rs2['ccoh4'] == 1 ? $checkmark4 = chr(51) : $checkmark4 = chr(53);
$rs2['ccoh5'] == 1 ? $checkmark5 = chr(51) : $checkmark5 = chr(53);
$rs2['ccoh6'] == 1 ? $checkmark6 = chr(51) : $checkmark6 = chr(53);
$rs2['ccoh7'] == 1 ? $checkmark7 = chr(51) : $checkmark7 = chr(53);
$rs2['ccoh8'] == 1 ? $checkmark8 = chr(51) : $checkmark8 = chr(53);
$rs2['ccoh9'] == 1 ? $checkmark9 = chr(51) : $checkmark9 = chr(53);
$rs2['ccoh10'] == 1 ? $checkmark10 = chr(51) : $checkmark10 = chr(53);

$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(9, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(11, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(13, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(27, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(22, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(34, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(18, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(16, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(19, 5,'', 1, 0, '');
$pdf->SetFont('Arial', 'B', 8);$pdf->Cell(21, 5,'', 1, 1, '');
$pdf->ln(-5);

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(5, 5, utf8_decode('Olor:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark1 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(7, 5, utf8_decode('Color:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark2 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(9, 5, utf8_decode('Sin Pelo:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark3 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(23, 5, utf8_decode('Contenido Estomacal:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark4 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(18, 5, utf8_decode('Sin Materia Fecal:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark5 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(30, 5, utf8_decode('Sin coágulos ni hematomas:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark6 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(14, 5, utf8_decode('Sin Riñones:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark7 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(12, 5, utf8_decode('Sin Leche:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark8 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(15, 5, utf8_decode('Sin Fracturas:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark9 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(16, 5, utf8_decode('Sin Dermatitis:'), 0, 0, '');
$pdf->SetFont('ZapfDingbats', '', 7);
$pdf->Cell(4, 5,  $checkmark10 , 0, 0, '');

$pdf->SetFont('Arial', 'B', 6);
$pdf->ln(7);

$pdf->Cell(190, 5, utf8_decode('PESOS CANALES'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 6);
$granTotal = 0;
//empieza 1
$r = $resultado[0];
$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Temp.'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('Peso Canal'), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Temp.'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('Peso Canal'), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Temp.'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('Peso Canal'), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Turno'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode('Temp.'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('Peso Canal'), 1, 1, 'C');

// 1
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
$temperatura46 = $r['temperatura'];

$granTotal = $granTotal+$peso1+$peso16+$peso31+$peso46;

$pdf->Cell(7.5, 5, utf8_decode('1'), 1, 0, 'C');
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
$pdf->Cell(20, 5, utf8_decode($peso46), 1, 1, 'C');
//termina 1

// 2
$r = $resultado[1];
$peso2 = $r['estomago1'];
$turno2 = $r['turno'];
$temperatura2 = $r['temperatura'];
// 17
$r = $resultado[16];
$peso17 = $r['estomago1'];
$turno17 = $r['turno'];
$temperatura17 = $r['temperatura'];
// 32
$r = $resultado[31];
$peso32 = $r['estomago1'];
$turno32 = $r['turno'];
$temperatura32 = $r['temperatura'];
// 47
$r = $resultado[46];
$peso47 = $r['estomago1'];
$turno47 = $r['turno'];
$temperatura47 = $r['temperatura'];

$granTotal = $granTotal+$peso2+$peso17+$peso32+$peso47;

$pdf->Cell(7.5, 5, utf8_decode('2'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno2), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura2), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso2), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('17'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno17), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura17), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso17), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('32'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno32), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura32), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso32), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('47'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno47), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura47), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso47), 1, 1, 'C');
//termina 2

// 3
$r = $resultado[2];
$peso3 = $r['estomago1'];
$turno3 = $r['turno'];
$temperatura3 = $r['temperatura'];
// 18
$r = $resultado[17];
$peso18 = $r['estomago1'];
$turno18 = $r['turno'];
$temperatura18 = $r['temperatura'];
// 33
$r = $resultado[32];
$peso33 = $r['estomago1'];
$turno33 = $r['turno'];
$temperatura33 = $r['temperatura'];
// 48
$r = $resultado[47];
$peso48 = $r['estomago1'];
$turno48 = $r['turno'];
$temperatura48 = $r['temperatura'];

$granTotal = $granTotal+$peso3+$peso18+$peso33+$peso48;

$pdf->Cell(7.5, 5, utf8_decode('3'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno3), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura3), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso3), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('18'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno18), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura18), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso18), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('33'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno33), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura33), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso33), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('48'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno48), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura48), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso48), 1, 1, 'C');
//termina 3

// 4
$r = $resultado[3];
$peso4 = $r['estomago1'];
$turno4 = $r['turno'];
$temperatura4 = $r['temperatura'];
// 19
$r = $resultado[18];
$peso19 = $r['estomago1'];
$turno19 = $r['turno'];
$temperatura19 = $r['temperatura'];
// 34
$r = $resultado[33];
$peso34 = $r['estomago1'];
$turno34 = $r['turno'];
$temperatura34 = $r['temperatura'];
// 49
$r = $resultado[48];
$peso49 = $r['estomago1'];
$turno49 = $r['turno'];
$temperatura49 = $r['temperatura'];

$granTotal = $granTotal+$peso4+$peso19+$peso34+$peso49;

$pdf->Cell(7.5, 5, utf8_decode('4'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno4), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura4), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso4), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('19'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno19), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura19), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso19), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('34'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno34), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura34), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso34), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('49'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno49), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura49), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso49), 1, 1, 'C');
//termina 4

// 5
$r = $resultado[4];
$peso5 = $r['estomago1'];
$turno5 = $r['turno'];
$temperatura5 = $r['temperatura'];
// 20
$r = $resultado[19];
$peso20 = $r['estomago1'];
$turno20 = $r['turno'];
$temperatura20 = $r['temperatura'];
// 35
$r = $resultado[34];
$peso35 = $r['estomago1'];
$turno35 = $r['turno'];
$temperatura35 = $r['temperatura'];
// 50
$r = $resultado[49];
$peso50 = $r['estomago1'];
$turno50 = $r['turno'];
$temperatura50 = $r['temperatura'];

$granTotal = $granTotal+$peso5+$peso20+$peso35+$peso50;

$pdf->Cell(7.5, 5, utf8_decode('5'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno5), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura5), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso5), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('20'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno20), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura20), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso20), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('35'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno35), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura35), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso35), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('50'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno50), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura50), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso50), 1, 1, 'C');
//termina 5

// 6
$r = $resultado[5];
$peso6 = $r['estomago1'];
$turno6 = $r['turno'];
$temperatura6 = $r['temperatura'];
// 21
$r = $resultado[20];
$peso21 = $r['estomago1'];
$turno21 = $r['turno'];
$temperatura21 = $r['temperatura'];
// 36
$r = $resultado[35];
$peso36 = $r['estomago1'];
$turno36 = $r['turno'];
$temperatura36 = $r['temperatura'];
// 51
$r = $resultado[50];
$peso51 = $r['estomago1'];
$turno51 = $r['turno'];
$temperatura51 = $r['temperatura'];

$granTotal = $granTotal+$peso6+$peso21+$peso36+$peso51;

$pdf->Cell(7.5, 5, utf8_decode('6'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno6), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura6), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso6), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('21'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno21), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura21), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso21), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('36'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno36), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura36), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso36), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('51'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno51), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura51), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso51), 1, 1, 'C');
//termina 6

// 7
$r = $resultado[6];
$peso7 = $r['estomago1'];
$turno7 = $r['turno'];
$temperatura7 = $r['temperatura'];
// 22
$r = $resultado[21];
$peso22 = $r['estomago1'];
$turno22 = $r['turno'];
$temperatura22 = $r['temperatura'];
// 37
$r = $resultado[36];
$peso37 = $r['estomago1'];
$turno37 = $r['turno'];
$temperatura37 = $r['temperatura'];
// 52
$r = $resultado[51];
$peso52 = $r['estomago1'];
$turno52 = $r['turno'];
$temperatura52 = $r['temperatura'];

$granTotal = $granTotal+$peso7+$peso22+$peso37+$peso52;

$pdf->Cell(7.5, 5, utf8_decode('7'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno7), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura7), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso7), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('22'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno22), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura22), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso22), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('37'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno37), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura37), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso37), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('52'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno52), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura52), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso52), 1, 1, 'C');
//termina 7

// 8
$r = $resultado[7];
$peso8 = $r['estomago1'];
$turno8 = $r['turno'];
$temperatura8 = $r['temperatura'];
// 23
$r = $resultado[22];
$peso23 = $r['estomago1'];
$turno23 = $r['turno'];
$temperatura23 = $r['temperatura'];
// 38
$r = $resultado[37];
$peso38 = $r['estomago1'];
$turno38 = $r['turno'];
$temperatura38 = $r['temperatura'];
// 53
$r = $resultado[52];
$peso53 = $r['estomago1'];
$turno53 = $r['turno'];
$temperatura53 = $r['temperatura'];

$granTotal = $granTotal+$peso8+$peso23+$peso38+$peso53;

$pdf->Cell(7.5, 5, utf8_decode('8'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno8), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura8), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso8), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('23'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno23), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura23), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso23), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('38'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno38), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura38), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso38), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('53'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno53), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura53), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso53), 1, 1, 'C');
//termina 8

// 9
$r = $resultado[8];
$peso9 = $r['estomago1'];
$turno9 = $r['turno'];
$temperatura9 = $r['temperatura'];
// 24
$r = $resultado[23];
$peso24 = $r['estomago1'];
$turno24 = $r['turno'];
$temperatura24 = $r['temperatura'];
// 39
$r = $resultado[38];
$peso39 = $r['estomago1'];
$turno39 = $r['turno'];
$temperatura39 = $r['temperatura'];
// 54
$r = $resultado[53];
$peso54 = $r['estomago1'];
$turno54 = $r['turno'];
$temperatura54 = $r['temperatura'];

$granTotal = $granTotal+$peso9+$peso24+$peso39+$peso54;

$pdf->Cell(7.5, 5, utf8_decode('9'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno9), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura9), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso9), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('24'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno24), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura24), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso24), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('39'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno39), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura39), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso39), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('54'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno54), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura54), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso54), 1, 1, 'C');
//termina 9

// 10
$r = $resultado[9];
$peso10 = $r['estomago1'];
$turno10 = $r['turno'];
$temperatura10 = $r['temperatura'];
// 25
$r = $resultado[24];
$peso25 = $r['estomago1'];
$turno25 = $r['turno'];
$temperatura25 = $r['temperatura'];
// 40
$r = $resultado[39];
$peso40 = $r['estomago1'];
$turno40 = $r['turno'];
$temperatura40 = $r['temperatura'];
// 55
$r = $resultado[54];
$peso55 = $r['estomago1'];
$turno55 = $r['turno'];
$temperatura55 = $r['temperatura'];

$granTotal = $granTotal+$peso10+$peso25+$peso40+$peso55;

$pdf->Cell(7.5, 5, utf8_decode('10'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno10), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura10), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso10), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('25'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno25), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura25), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso25), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('40'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno40), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura40), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso40), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('55'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno55), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura55), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso55), 1, 1, 'C');
//termina 10

// 11
$r = $resultado[10];
$peso11 = $r['estomago1'];
$turno11 = $r['turno'];
$temperatura11 = $r['temperatura'];
// 26
$r = $resultado[25];
$peso26 = $r['estomago1'];
$turno26 = $r['turno'];
$temperatura26 = $r['temperatura'];
// 41
$r = $resultado[40];
$peso41 = $r['estomago1'];
$turno41 = $r['turno'];
$temperatura41 = $r['temperatura'];
// 56
$r = $resultado[55];
$peso56 = $r['estomago1'];
$turno56 = $r['turno'];
$temperatura56 = $r['temperatura'];

$granTotal = $granTotal+$peso11+$peso26+$peso41+$peso56;

$pdf->Cell(7.5, 5, utf8_decode('11'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno11), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura11), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso11), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('26'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno26), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura26), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso26), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('41'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno41), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura41), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso41), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('56'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno56), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura56), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso56), 1, 1, 'C');
//termina 11

// 12
$r = $resultado[11];
$peso12 = $r['estomago1'];
$turno12 = $r['turno'];
$temperatura12 = $r['temperatura'];
// 27
$r = $resultado[26];
$peso27 = $r['estomago1'];
$turno27 = $r['turno'];
$temperatura27 = $r['temperatura'];
// 42
$r = $resultado[41];
$peso42 = $r['estomago1'];
$turno42 = $r['turno'];
$temperatura42 = $r['temperatura'];
// 57
$r = $resultado[56];
$peso57 = $r['estomago1'];
$turno57 = $r['turno'];
$temperatura57 = $r['temperatura'];

$granTotal = $granTotal+$peso12+$peso27+$peso42+$peso57;

$pdf->Cell(7.5, 5, utf8_decode('12'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno12), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura12), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso12), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('27'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno27), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura27), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso27), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('42'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno42), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura42), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso42), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('57'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno57), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura57), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso57), 1, 1, 'C');
//termina 12

// 13
$r = $resultado[12];
$peso13 = $r['estomago1'];
$turno13 = $r['turno'];
$temperatura13 = $r['temperatura'];
// 28
$r = $resultado[27];
$peso28 = $r['estomago1'];
$turno28 = $r['turno'];
$temperatura28 = $r['temperatura'];
// 43
$r = $resultado[42];
$peso43 = $r['estomago1'];
$turno43 = $r['turno'];
$temperatura43 = $r['temperatura'];
// 58
$r = $resultado[57];
$peso58 = $r['estomago1'];
$turno58 = $r['turno'];
$temperatura58 = $r['temperatura'];

$granTotal = $granTotal+$peso13+$peso28+$peso43+$peso58;

$pdf->Cell(7.5, 5, utf8_decode('13'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno13), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura13), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso13), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('28'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno28), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura28), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso28), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('43'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno43), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura43), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso43), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('58'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno58), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura58), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso58), 1, 1, 'C');
//termina 13

// 14
$r = $resultado[13];
$peso14 = $r['estomago1'];
$turno14 = $r['turno'];
$temperatura14 = $r['temperatura'];
// 29
$r = $resultado[28];
$peso29 = $r['estomago1'];
$turno29 = $r['turno'];
$temperatura29 = $r['temperatura'];
// 44
$r = $resultado[43];
$peso44 = $r['estomago1'];
$turno44 = $r['turno'];
$temperatura44 = $r['temperatura'];
// 59
$r = $resultado[58];
$peso59 = $r['estomago1'];
$turno59 = $r['turno'];
$temperatura59 = $r['temperatura'];

$granTotal = $granTotal+$peso14+$peso29+$peso44+$peso59;

$pdf->Cell(7.5, 5, utf8_decode('14'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno14), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura14), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso14), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('29'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno29), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura29), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso29), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('44'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno44), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura44), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso44), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('59'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno59), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura59), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso59), 1, 1, 'C');
//termina 14

// 15
$r = $resultado[14];
$peso15 = $r['estomago1'];
$turno15 = $r['turno'];
$temperatura15 = $r['temperatura'];
// 30
$r = $resultado[29];
$peso30 = $r['estomago1'];
$turno30 = $r['turno'];
$temperatura30 = $r['temperatura'];
// 45
$r = $resultado[44];
$peso45 = $r['estomago1'];
$turno45 = $r['turno'];
$temperatura45 = $r['temperatura'];
// 60
$r = $resultado[59];
$peso60 = $r['estomago1'];
$turno60 = $r['turno'];
$temperatura60 = $r['temperatura'];

$granTotal = $granTotal+$peso15+$peso30+$peso45+$peso60;

$pdf->Cell(7.5, 5, utf8_decode('15'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno15), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura15), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso15), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('30'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno30), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura30), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso30), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('45'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno45), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura45), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso45), 1, 0, 'C');
$pdf->Cell(7.5, 5, utf8_decode('60'), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($turno60), 1, 0, 'C');
$pdf->Cell(10, 5, utf8_decode($temperatura60), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode($peso60), 1, 1, 'C');
//termina 15

$pdf->ln(5);

$porcentajeTotalEstomago = ($totalEstomagos/$granTotal)*100;
$porcentajeTotalPierna= ($totalPiernas/$granTotal)*100;

$pdf->Cell(31, 5, utf8_decode('Total Kilos: '.$granTotal.' Kg.'), 1, 0, '');
$pdf->Cell(34, 5, utf8_decode('Peso Promedio Canal: '.number_format(round($granTotal/$canales)).' Kg.'), 1, 1, '');
$pdf->ln(5);
$pdf->Cell(190, 5, utf8_decode('Observaciones: '.$rs2['observaciones']), 0, 1, '');
$pdf->Cell(35, 10, utf8_decode('Hora Inicial: '.$fin), 0, 0,'');
$pdf->Cell(31, 10, utf8_decode('Hora Final: '.$inicio), 0, 0, '');
$pdf->Cell(31, 10, utf8_decode('Tiempo Total: '.$tiempoTranscurrido), 0, 0, '');
$pdf->Cell(28, 10,'Canales: '.$canales, 0, 0, '');

//$pdf->Cell(65, 10, utf8_decode('Firma Responsable:____________________________'), 0, 1, '');

if($rs2['responsable'] != 12345678){
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $firma = '../assets/img/firmas/'.$rs2['responsable'].'.jpg';
        $pdf->Image($firma, $x+25, $y+1, 30, 10);
        $pdf->ln(5);
        $pdf->Cell(130, 5, '', 0, 0, '');
        $pdf->Cell(60, 5, utf8_decode('Firma Responsable:____________________________'), 0, 1, '');
}
$pdf->Output('formato_recepcion', 'I');
