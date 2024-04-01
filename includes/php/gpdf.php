<?php
require('../fpdf185/fpdf.php');

class PDF extends FPDF {
    function Header() {
        // Logo
        $this->Image('../img/logo.png', 15, 15, 20);
        $this->SetFont('Arial', 'B', 10);

        // Establecer posición X para alinear el texto a la derecha del logo
        $this->SetX(50); // Puedes ajustar este valor según sea necesario

        // Address
        $this->Cell(100, 10, 'KGE TECNOLOGY', 0, 1, 'C');

        // Dirección
        $this->SetFont('Arial', '', 7);
        $this->SetX(60);
        $this->MultiCell(0, 5, utf8_decode('Calle 16 #337 x Av Aleman y Calle 21, Colonia Itzimna, Merida, Yucatan'));

        $this->SetX(93); /* Centrar texto en la celda */
        $this->MultiCell(0, 5, utf8_decode('ACTIVOS FIJOS '));

        // Email
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(40);
        $this->SetDrawColor(153, 204, 255); // Cambiamos el color de los bordes a azul claro
        $this->SetTextColor(55, 49, 47);
        $this->SetFillColor(204, 229, 255); // Cambiamos el color de fondo de las celdas a azul claro
        /* $this->Cell(118, 0, 'Reporte General', 0, 0, 'C'); */
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 9);
        $this->SetX(2);
        $this->Cell(7, 10, '#', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Clave', 1, 0, 'C', 1); // Agregamos 1 al final para alternar el color de fondo
        $this->Cell(21, 10, 'Marca', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Modelo', 1, 0, 'C', 1);
        $this->Cell(20, 10, 'Unidad', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'N-Parte', 1, 0, 'C', 1);
        /* $this->Cell(25, 10, 'Descripcion', 1, 0, 'C', 0); */
        $this->Cell(23, 10, 'Presentacion', 1, 0, 'C', 0);
        $this->Cell(21, 10, 'Grupo', 1, 0, 'C', 1);
        $this->Cell(23, 10, 'Tipo', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Precio', 1, 1, 'C', 1);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$con = new mysqli('localhost', 'root', '', 'kge');
$consulta = "SELECT * FROM products";
$resultado = mysqli_query($con, $consulta);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 10);
$i = 0; // Variable para alternar el color de fondo

while ($row = $resultado->fetch_assoc()) {
    $pdf->SetDrawColor(118, 129, 156, 1); // Cambiamos el color de los bordes a azul claro
    $pdf->SetX(2);
    $pdf->Cell(7, 10, $row['id'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(23, 10, $row['clave'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(21, 10, $row['marca'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(23, 10, $row['modelo'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(20, 10, $row['unidad'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(20, 10, $row['num_parte'], 1, 0, 'C', 0); // Sin color de fondo
    /* $pdf->Cell(25, 10, $row['descripcion'], 1, 0, 'C', 0); */
    $pdf->Cell(23, 10, $row['presentacion'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(21, 10, $row['grupo'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(23, 10, $row['tipo'], 1, 0, 'C', 0); // Sin color de fondo
    $pdf->Cell(23, 10, $row['precio'], 1, 1, 'C', 0); // Sin color de fondo
    $i++;
}

$pdf->Output();
?>