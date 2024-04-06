<?php
require_once "../modelo/conexion.php";
require "../fpdf186/fpdf.php";

class PDF extends FPDF{

    // Cabecera de página
    function Header(){
    // Logo
    $this->Image("../vista/logo.png",23,10,25,10);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(30);
    // Título    
    $this->Ln(4);
    $this->Ln(4);
    $this->Ln(5);
    $this->Cell(180,0,'INFORME DE CLIENTES',0,0,'C');
    $this->Ln(10);
    }

    // Pie de página
    function Footer(){

    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

 if(isset($_POST["id"])){
     $id=$_POST["id"];
     $sql = "SELECT * FROM tcliente WHERE id = $id";
 }else{
     $sql = "SELECT * FROM tcliente";
 }

$stmt = Conexion::conectar()->prepare($sql);
$stmt->execute();

// Imprimir cabeceras
$pdf->Cell(40, 10, 'ID');
$pdf->Cell(40, 10, 'Documento');
$pdf->Cell(40, 10, 'Nombre');
$pdf->Cell(40, 10, 'Telefono');
$pdf->Ln();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, $row['id']);
    $pdf->Cell(40, 10, $row['documento']);
    $pdf->Cell(40, 10, $row['nombre']);
    $pdf->Cell(40, 10, $row['telefono']);
    $pdf->Ln(); // Salto de línea para la siguiente fila
}

$pdf->Output("reporteCliente.pdf",'F');

 print '../reporte/reporteCliente.pdf';
 
?>

