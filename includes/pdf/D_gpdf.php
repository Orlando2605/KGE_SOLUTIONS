<?php
require('../fpdf185/fpdf.php');

class PDF extends FPDF {
    function Header() {
        // Logo
        $this->Image('../img/logo.png', 15, 15, 20);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(50);
        $this->Cell(100, 10, 'KGE SOLUTIONS', 0, 1, 'C');
        $this->SetFont('Arial', '', 7);
        $this->SetX(60);
        $this->MultiCell(0, 5, utf8_decode('Calle 16 #337 x Av Aleman y Calle 21, Colonia Itzimna, Merida, Yucatan'));
        $this->SetX(93);
        $this->MultiCell(0, 5, utf8_decode('ACTIVOS FIJOS '));
        $this->SetX(82);
        $this->MultiCell(0, 5, utf8_decode('REPORTE DE ESTADO INACTIVO'));
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(40);
        $this->SetDrawColor(14, 13, 12, 0.18);
        $this->SetFillColor(175, 102, 34, 1);
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(2);
        $this->SetDrawColor(128, 128, 128);
        $this->SetLineWidth(0.2);
        $this->Cell(30, 10, 'Clave', 1, 0, 'C', 0);
        $this->Cell(70, 10, 'Descripcion', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Adquisicion', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Serie', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'N_factura', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Costo', 1, 1, 'C', 0);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$con = new mysqli('localhost', 'root', '', 'kge');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 7);
$pdf->SetDrawColor(160, 184, 191, 1);
$pdf->SetLineWidth(0.1);
$consulta = "SELECT * FROM act_fijos WHERE activo = '0'";
$resultado = mysqli_query($con, $consulta);

while ($row = $resultado->fetch_assoc()) {
    $pdf->SetX(2);
    $pdf->Cell(30, 10, $row['clave'], 1, 0, 'C');

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $width = 70;
    $pdf->MultiCell($width, 10, $row['descripcion'], 1, 'C'); // Cambia 10 a 5 para un interlineado más pequeño
    $height = $pdf->GetY() - $y;
    $pdf->SetXY($x + $width, $y);

    $pdf->Cell(25, $height, $row['fecha_adquisicion'], 1, 0, 'C');
    $pdf->Cell(25, $height, $row['serie'], 1, 0, 'C');
    $pdf->Cell(25, $height, $row['n_factura'], 1, 0, 'C');
    $pdf->Cell(25, $height, $row['costo'], 1, 1, 'C');
}




$pdf->Output();
?>