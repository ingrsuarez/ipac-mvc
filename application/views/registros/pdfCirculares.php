<?php

require "FPDF/fpdf.php";
$enlace = new mysqli("127.0.0.1", "u540644031_suarroda", "Ipac2021", "u540644031_GestionIpac", 3306);


class PDF extends FPDF
{
public $fecha;
public $nombre;
public $sector;
public $dni;
public $id;
	
// Cabecera de página
	function Header()
	{
		
		$this->SetFont('Arial','B',15);
		// Calculamos ancho y posición del título.
		$w = 20+6;
		$this->SetX((120-$w)/2);
		// Colores de los bordes, fondo y texto
		$this->SetDrawColor(0,139,139);
		$this->SetFillColor(230,230,0);
		$this->SetTextColor(255,255,255);
		// Ancho del borde (1 mm)
		$this->SetLineWidth(0.8);
		// Logo
		$this->Image('images/logo-color.png',8,6,55);
		
		// Arial bold 15
		$this->SetFont('Times','B',18);
		// Título
		$this->SetDrawColor(0,139,139);
		$this->SetLineWidth(10);
		$this->Line(130, 18, 205, 18);
		$this->Cell(120,16,utf8_decode('CIRCULAR'),0,0,'R');
		$this->Ln(20);
		
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(15,10,'FECHA:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,$this -> fecha,0,0,'R');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(77,10,utf8_decode('NÚMERO:'),0,0,'R');
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(27,10,$this -> id,0,0,'L');
		$this->Ln(10);
		
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(30,10,'LEGUIZAMON 356',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		
		$this->Cell(89,10,utf8_decode('REALIZÓ:'),0,0,'R');
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(37,10,$this -> nombre,0,0,'L');
		$this->Ln(4);
		
		$this->Cell(30,10,'8300 - NEUQUEN',0,0,'L');
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(10,10,$this -> dni,0,0,'L');
		$this->Ln(4);
		
		$this->Cell(30,10,'Mail: calidad@ipac.com.ar',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(89,10,'SECTOR:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(10,10,$this -> sector,0,0,'L');
		$this->Ln(30);
	}

// Pie de página
	function Footer()
	{
		// Arial italic 8
		$this->SetFont('Arial','I',10);
		$this->Ln(50);
		$this->Cell(80,10,utf8_decode('Firma:'),0,1,'R');
		$this->Cell(80,25,utf8_decode('Aclaración:'),0,1,'R');
		$this->Cell(80,10,utf8_decode('Nº de Documento:'),0,0,'R');
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		
		// Número de página
		$this->Cell(0,10,utf8_decode('Página: ').$this->PageNo().'/{nb}',0,0,'R');
	}


}

$idc = $circular_selected['id'];

$nombre = strtoupper($circular_selected['apellido'])." ".strtoupper($circular_selected['nombre']);
$sector = mb_strtoupper($circular_selected['sector']);
//$dni = $circular_selected['dni'];
$titulo = mb_strtoupper($circular_selected['titulo']);
$descripcion = $circular_selected['descripcion'];
$tareas = $circular_selected['tareas'];
$fecha = date("d/m/Y", strtotime($circular_selected['fecha']));
$tipo = mb_strtoupper($circular_selected['tipo']);
$tareas = $circular_selected['tareas'];

$pdf = new PDF("P","mm","A4");
$pdf-> AliasNbPages();
$pdf-> sector = $sector; 
$pdf-> nombre = $nombre;

$pdf-> fecha = $fecha;
$pdf-> id = $idc;


$pdf-> AddPage();


$w = array(40, 110, 30);
$h = array(40, 110, 35);



$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(200,200,200);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);
// Cabecera
$pdf->Cell($h[0],7,utf8_decode('TÍTULO: '),0,0,'L',true);
$pdf->Cell($h[0],7,'    ',0,0,'L',false);
$pdf->Cell($h[0],7,utf8_decode('TIPO: '),0,0,'L',true);

$pdf->Ln(7);	
$pdf->SetLineWidth(0.4);
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(0,0,'','B',0,'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell($h[0],7,utf8_decode($titulo),0,0,'L',false);
$pdf->Cell($h[0],7,'    ',0,0,'L',false);
$pdf->Cell($h[0],7,utf8_decode($tipo),0,0,'L',false);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->Cell($h[0],7,utf8_decode('DESCRIPCIÓN: '),0,0,'L',true);
$pdf->Ln(7);	
$pdf->SetLineWidth(0.4);
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(0,0,'','B',0,'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Write(5,utf8_decode($descripcion));
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->Cell($h[0],7,utf8_decode('TAREAS: '),0,0,'L',true);
$pdf->Ln(7);	
$pdf->SetLineWidth(0.4);
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(0,0,'','B',0,'L');
$pdf->Ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Write(5,utf8_decode($tareas));


$pdf->Output();	



?>
