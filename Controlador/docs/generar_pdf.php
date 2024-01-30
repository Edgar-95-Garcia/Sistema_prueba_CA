<?php
include_once("../../Static/Lib/fpdf184/fpdf.php");
class PDF extends FPDF
{
    function Header()
    {
        // Encabezado
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Datos', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function TablaDatos($header, $data)
    {
        // Cabecera
        foreach ($header as $col) {
            $this->Cell(40, 10, $col, 1);
        }
        $this->Ln();

        // Datos
        foreach ($data as $datos) {
            $id = $datos['ID'];
            $nombre = $datos['NOMBRE'];
            $nacimiento = $datos['NACIMIENTO'];
            $sexo = $datos['SEXO'];

            //Calculos para obtener la edad
            $fecha_nacimiento = new DateTime($nacimiento);
            $fecha_Actual = new DateTime();
            $edad = $fecha_Actual->diff($fecha_nacimiento);

            $this->Cell(40, 10, $id, 1);
            $this->Cell(40, 10, $nombre, 1);
            $this->Cell(40, 10, $nacimiento, 1);
            $this->Cell(40, 10, $sexo, 1);
            $this->Cell(40, 10, $edad->y, 1);

            $this->Ln();
        }

        // foreach ($data as $row) {
        //     foreach ($row as $col) {
        //         $this->Cell(40, 10, $col, 1);
        //     }
        //     $this->Ln();
        // }
    }
}

include_once("../../Modelo/Usuarios/Consultar_usuario.php");
$obj_usuarios = new Consultar_usuario();
$datos_usuario = $obj_usuarios->selectAllUsers_docs();


// Crear instancia de PDF
$pdf = new PDF();
$pdf->AddPage();

// Cabecera y datos
$header = array('ID', 'Nombre', 'Fecha', 'Sexo', 'Edad');
$pdf->TablaDatos($header, $datos_usuario);

// Salida del PDF
$pdf->Output('reporte.pdf', 'F');

// Devolver la URL del archivo generado
$response = array('url' => 'reporte.pdf');
header('Content-Type: application/json');
echo json_encode($response);

