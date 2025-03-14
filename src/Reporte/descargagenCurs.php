<?php
//============================================================+
//
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: fanny
//
// 
//  
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
include('C:\xampp\htdocs\SistemaAcademia\library\tcpdf.php');
include '../../config/db.php';


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information
$pdf->SetCreator('Sistema Academia');
$pdf->SetAuthor('Sistema Academia');
$pdf->SetTitle('Reporte de Cursos');
$pdf->SetSubject('Listado Completo de Cursos');

$pdf->AddPage();

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


    
// Set some content to print
    $query = "SELECT * FROM `cargaacademicaprofesores`";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn));
    }

    $course = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (empty($course)) {
        die('No se encontraron profesores.');
    }

    // Crear contenido HTML para el PDF
    $html = '<h1>Reporte de Cursos</h1>';
    $html .= '<table border="1" cellpadding="4">';
    $html .= '<thead>
                <tr style="background-color:#f2f2f2;">
                    <th><b>ID</b></th>
                    <th><b>Nombre Profesor</b></th>
                    <th><b>Apellido</b></th>
                    <th><b>Nombre Curso </b></th>
                    <th><b>Créditos</b></th>
                </tr>
              </thead>';
    $html .= '<tbody>';

    foreach ($course as $course) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($course['Id_profesores']) . '</td>';
        $html .= '<td>' . htmlspecialchars($course['nombre_profesores']) . '</td>';
        $html .= '<td>' . htmlspecialchars($course['apellido_profesores']) . '</td>';
        $html .= '<td>' . htmlspecialchars($course['nombre_cursos']) . '</td>';
        $html .= '<td>' . htmlspecialchars($course['creditos']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+