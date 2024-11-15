<?php
session_start();

ini_set("display_errors", false);

function fsalida($cad2)
{
    $uno = substr($cad2, 8, 2);
    $dos = substr($cad2, 5, 2);
    $tres = substr($cad2, 2, 2);
    return $uno . '-' . $dos . '-' . $tres;
}

function fsalidaconsecutivo($cad, $cad2)
{
    $uno = "213DM";
    $dos = str_pad($cad, 6, '0', STR_PAD_LEFT);
    $tres = substr($cad2, 2, 2);
    return $uno . "-" . $dos . "-" . $tres;
}

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
$fecha_actual = date("Y-m-d");
include("../config.php");

$sqlg = "SELECT * 
        FROM recepcionpollo 
        ";
$c = mysqli_query($link, $sqlg) or die("aqui 1 " . mysqli_error($link));

/* $sql3 = "SELECT empresa, sede, direccion, municipio 
         FROM destinos 
         WHERE id='" . $rs2['destino'] . "'";
$c3 = mysqli_query($link, $sql3) or die("aqui 2 " . mysqli_error($link));
$rs3 = mysqli_fetch_array($c3);

$sql30 = "SELECT sede, municipio 
          FROM beneficio 
          WHERE id='" . $rs2['beneficio'] . "'";
$c30 = mysqli_query($link, $sql30) or die("aqui 2 " . mysqli_error($link));
$rs30 = mysqli_fetch_array($c30);

$sql4 = "SELECT nombres, telefono 
         FROM responsables 
         WHERE cedula='" . $rs2['responsable'] . "'";
$c4 = mysqli_query($link, $sql4) or die("aqui 3 " . mysqli_error($link));
$rs4 = mysqli_fetch_array($c4);

$sql40 = "SELECT nombres 
          FROM conductores_recepcion 
          WHERE cedula='" . $rs2['conductor'] . "'";
$c40 = mysqli_query($link, $sql40) or die("aqui 3 " . mysqli_error($link));
$rs40 = mysqli_fetch_array($c40); */

/* $sql = "SELECT distinct plantilla.item, descripcion, lote
        FROM plantilla, item_proveedor 
        WHERE plantilla.item = item_proveedor.item 
        AND item_proveedor.proveedor = " . $id . "
        ORDER BY registro DESC"; */
/* $sql = "SELECT DISTINCT p.item,ip.lote, p.descripcion 
        FROM plantilla p
        JOIN item_proveedor ip ON p.item = ip.item
        WHERE ip.proveedor = " . $id . "
        ORDER BY p.descripcion ASC";
$c = mysqli_query($link, $sql) or die("aqui 1:" . mysqli_error($link)); */

/* $sql5 = "SELECT *
        FROM recepcion_pesos 
        WHERE id_recepcion = " . $id . "
        ORDER BY turno ASC";
$c5 = mysqli_query($link, $sql5) or die("aqui 1:" . mysqli_error($link)); */
//$rs5 = mysqli_fetch_array($c5);

/* $resultado = [];

while ($row = mysqli_fetch_assoc($c5)) {
    $resultado[] = $row;
} */
/* $canales = count($resultado);

$horaInicio = $resultado[0];
$horaFin = $resultado[$canales - 1];

$inicio = date('H:i', strtotime($horaInicio['registro']));
$fin = date('H:i', strtotime($horaFin['registro']));

$inicioDateTime = new DateTime($inicio);
$finDateTime = new DateTime($fin);
$diferencia = $inicioDateTime->diff($finDateTime); */

/* $tiempoTranscurrido = $diferencia->format('%H:%I');

$sql6 = "SELECT nombres, telefono 
        FROM conductores 
        WHERE cedula=" . $rs2['conductor'];
$c6 = mysqli_query($link, $sql6) or die(mysqli_error($link));
$rs6 = mysqli_fetch_array($c6); */

require('pdf/fpdf.php');
class PDF extends FPDF {}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'Letter');

$pdf->AddFont('DejaVu', '', 'DejaVuSans.php', true);

$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);

$logo = '../assets/img/logo-mercamio.jpg';
$pdf->Image($logo, 10, 7, 50, 15);
$pdf->ln(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY($pdf->GetX() + 60, $pdf->GetY() - 12);
$pdf->multiCell(190, 6, utf8_decode('FORMATO RECEPCIÓN POLLO                                                        '), 1, 0, 'C');
$pdf->SetXY($pdf->GetX() + 250, $pdf->GetY() - 12);
$pdf->Cell(30, 6, '', 0, 1, 'C');
$pdf->SetXY($pdf->GetX() + 250, $pdf->GetY());
$pdf->Cell(30, 6, utf8_decode('Página 1 de 1'), 1, 1, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40, 5, utf8_decode('AREA'), 1, 0, 'C');
$pdf->Cell(70, 5, utf8_decode('FECHA DE CREACIÓN'), 1, 0, 'C');
$pdf->Cell(70, 5, utf8_decode('FECHA DE REVISIÓN'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('VERSIÓN'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('CÓDIGO'), 1, 1, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 5, utf8_decode('Producción'), 1, 0, 'C');
$pdf->Cell(70, 5, utf8_decode('7/11/2023'), 1, 0, 'C');
$pdf->Cell(70, 5, utf8_decode('7/11/2024'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('3'), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('FTO-PDM-04'), 1, 1, 'C');
$pdf->ln(35.5);

$encabezado = '../assets/img/encabezado.jpg';
$pdf->Image($encabezado, 9.3, 25, 282, 35);
$i = 0;
while ($row = mysqli_fetch_array($c)) {

    $sqlg2 = "SELECT sum(peso) as peso, sum(unidades) as unidades, temperatura
              FROM recepcion_pesos_pollo 
              WHERE proveedor=" . $row['id_recepcion'] . "";
    $c2 = mysqli_query($link, $sqlg2) or die("aqui 10 " . mysqli_error($link));

    $sqlg3 = "SELECT sede as proveedor 
              FROM proveedorpollo 
              WHERE id=" . $row['beneficio'] . "";
    $c3 = mysqli_query($link, $sqlg3) or die("aqui 10 " . mysqli_error($link));
    $row3 = mysqli_fetch_array($c3);

    $row['guiat'] != '' ? $checkmark3 = chr(51) : $checkmark3 = chr(53);

    $row['ccoh1'] == 1 ? $checkmark1 = chr(51) : $checkmark1 = chr(53);
    $row['ccoh2'] == 1 ? $checkmark2 = chr(51) : $checkmark2 = chr(53);

    /* $rs['cph3'] == 1 ? $checkmark3 = chr(51) : $checkmark3 = chr(53);
    $rs['cph4'] == 1 ? $checkmark4 = chr(51) : $checkmark4 = chr(53);
    $rs['cph5'] == 1 ? $checkmark5 = chr(51) : $checkmark5 = chr(53);
 */
    if ($row2 = mysqli_fetch_array($c2)) {
        $i += 1;
        $pdf->SetFont('Arial', '', 6);
        $pdf->Cell(12.9, 6, fsalida($row['fecharec']), 1, 0, 'C');
        $pdf->Cell(8.9, 6, $row['id_recepcion'], 1, 0, 'C');
        $pdf->Cell(20.7, 6, $row['especie'].' '.$row['tipo'], 1, 0, 'C');
        $pdf->Cell(18.5, 6, $row3['proveedor'], 1, 0, 'C');
        $pdf->Cell(14.8, 6, $row2['lote'], 1, 0, 'C');
        $pdf->Cell(17, 6, fsalida($row['fechasac']), 1, 0, 'C');
        $pdf->Cell(9.9, 6, $row2['peso'], 1, 0, 'C');
        $pdf->Cell(13.5, 6, $row2['unidades'], 1, 0, 'C');
        $pdf->Cell(7, 6, $row['chv1'], 1, 0, 'C');
        $pdf->SetFont('ZapfDingbats', '', 8);
        $pdf->Cell(6.9, 6, $checkmark3, 1, 0, 'C');
        $pdf->SetFont('Arial', '', 6);
        $pdf->Cell(6.8, 6, $row2['temperatura'], 1, 0, 'C');
        $pdf->SetFont('ZapfDingbats', '', 8);
        $pdf->Cell(6.9, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(7, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(7.8, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(6.8, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(9.5, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(4.6, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(5.9, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(5.8, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(5.4, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(8.2, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(6.1, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(7.6, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(7.3, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(7.3, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(7.2, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(19, 6, $checkmark1, 1, 0, 'C');
        $pdf->Cell(21.1, 6, '', 1, 0, 'C');

        $x = 270;
        $y = 53 + ($i * 6);
        $firma = '../assets/img/firmas/16763409.jpg';
        $pdf->Image($firma, $x, $y + 1, 15, 5);
        $pdf->ln();
    }
}

$pdf->Output('formato_recepcion.pdf', 'I');
