<?php

require "FPDF/fpdf.php";
$enlace = new mysqli("127.0.0.1", "u540644031_suarroda", "Ipac2021", "u540644031_GestionIpac", 3306);


class PDF extends FPDF
{
//$numero = date("y").date("m").date("d").$_SESSION['uid'].$_SESSION['pdfprov'][1];	
public $prov;
public $domi;
public $num;
public $fecha;
	
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
		$this->SetTextColor(0,0,0);
		// Ancho del borde (1 mm)
		$this->SetLineWidth(0.8);
		// Logo
		$this->Image('images/logohoriz.png',10,8,33);
		
		// Arial bold 15
		$this->SetFont('Times','',10);
		// Título
		$this->Cell(100,15,utf8_decode('DOCUMENTO NO VÁLIDO'),0,0,'C');
		$this->Ln(4);
		$this->Cell(195,15,'COMO FACTURA',0,0,'C');
		$this->Ln(20);
		
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(30,10,'LEGUIZAMON 356',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		
		$this->Cell(100,10,'ORDEN DE COMPRA:',0,0,'R');
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(19,10,$this -> num,0,0,'R');
		$this->Ln(4);
		
		$this->Cell(30,10,'8300 - NEUQUEN',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(100,10,'CUIT:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,'27-29145034-8',0,0,'R');
		$this->Ln(4);
		
		$this->Cell(30,10,'Mail: compras@ipac.com.ar',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(101,10,'Ing. Brutos: ',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(40,10,utf8_decode('Neuquén 000-131564/01'),0,0,'R');
		$this->Ln(10);
		

		
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(40,10,$this -> prov,0,0,'L');
		$this->Cell(100,10,'FECHA:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,$this -> fecha,0,0,'R');
		$this->Ln(4);
		
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(30,10,$this -> domi,0,0,'L');
		$this->Ln(4);

		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(30,10,utf8_decode('Cond. Vta.: 30 días'),0,0,'L');
		
		$this->Ln(10);
		$this->SetLineWidth(0.4);
		$this->SetDrawColor(0,0,0);
		$this->Cell(0,0,'','B',0,'L');
		$this->Ln(1);
	}

// Pie de página
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,utf8_decode('Página: ').$this->PageNo().'/{nb}',0,0,'C');
	}


}

// if (array_key_exists('pdf',$_POST)) { //Generar PDF
			
	//Proveedor $idprov
	

	// //Listado de articulos a imprimir $ocitems
	
	//Imprimo un pagina por cada Orden de compra
	// $querynoc = "SELECT * from ocpendientes WHERE numero = ".$ocitems;
	// $resultadonoc = mysqli_query($enlace,$querynoc);
	// $row = mysqli_fetch_assoc($resultadonoc);
	
	// $queryp = "SELECT * FROM `proveedores` WHERE `id` = '".$idprov."'";
	// $resultadop = mysqli_query($enlace,$queryp);
	// $filaprov = mysqli_fetch_assoc($resultadop);
	//array datos del proveedor
	$pdfprov = array($idprov,$filaprov['nombre'],$filaprov['cuit'],$filaprov['domicilio']);
	$cont = 0;
	
	$fecha = substr($numero, 4, 2)."/".substr($numero, 2, 2)."/20".substr($numero, 0, 2);
	
	$pdf = new PDF("P","mm","A4");
	$pdf-> AliasNbPages();
	$pdf-> prov = $pdfprov[1]; 
	$pdf-> num = $numero;
	$pdf-> domi = $pdfprov[3];
	$pdf-> fecha = $fecha;
	$pdf-> AddPage();
	

	$w = array(40, 80, 50);
	$h = array(40, 80, 50, 30);
	$header = array('Cantidad',utf8_decode('Descripción'),'Marca',utf8_decode('Código'));
	$pdf->SetFont('Arial','B',11);
	// Cabecera
	$pdf->Cell($h[0],7,$header[0],0,0,'L',false);
	$pdf->Cell($h[1],7,$header[1],0,0,'L',false);
	$pdf->Cell($h[2],7,$header[2],0,0,'L',false);
	$pdf->Cell($h[3],7,$header[3],0,0,'L',false);
	$pdf->Ln(7);	
	$pdf->SetLineWidth(0.4);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(0,0,'','B',0,'L');
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',10);
	
	foreach ($items as $fila){
		$pdf->Cell($w[0],6,"      ".$fila['cantidad'],0,0,'L',false);
		$pdf->Cell($w[1],6,substr($fila['descripcion'],0,40),0,0,'L',false);
		$pdf->Cell($w[2],6,substr($fila['marca'],0,40),0,0,'L',false);
		$pdf->Cell($w[2],6,$fila['codprov'],0,0,'L',false);//Codigo proveedor
		$pdf->Ln();
		$idoc = $fila['id'];
		$queryup = "UPDATE `ordencompra` SET `estatus` = 'enviada' WHERE `ordencompra`.`id` = '".$idoc."'";
		mysqli_query($enlace,$queryup);
						
	}
		
	
	
	$pdf->Output("OfficeForm.pdf", "I");





/*session_start();
$proveedor = "MERINO ALEJANDRO RUBEN";
$numero = "132435";
$domicilio = " TUPUNGATO 1085";
$pdf = new PDF("P","mm","A4");
$pdf-> AliasNbPages();
$pdf-> prov = $proveedor; 
$pdf-> num = $numero;
$pdf-> domi = $domicilio;

$pdf-> AddPage();


$w = array(40, 110, 30);
$h = array(40, 110, 35);
$header = array('Cantidad',utf8_decode('Descripción'),utf8_decode('Código'));

		
	
$query = "SELECT * FROM `ordencompra` WHERE `estatus` LIKE 'creada' AND `proveedor` = '".$_SESSION['pdfprov'][0]."'";
$result = mysqli_query($enlace,$query);
$pdf->SetFont('Arial','B',11);
// Cabecera
$pdf->Cell($h[0],7,$header[0],0,0,'L',false);
$pdf->Cell($h[1],7,$header[1],0,0,'L',false);
$pdf->Cell($h[3],7,$header[2],0,0,'L',false);
$pdf->Ln(7);	
$pdf->SetLineWidth(0.4);
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(0,0,'','B',0,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','',10);
foreach ($_SESSION['pdfocid'] as $idoc) {
		$query = "SELECT * FROM `ordencompra` WHERE `id` = '".$idoc."'";
		$result = mysqli_query($enlace,$query);
		$fila = mysqli_fetch_array($result);
		$pdf->Cell($w[0],6,"      ".$fila[5],0,0,'L',false);
		$pdf->Cell($w[1],6,substr($fila[11],0,40),0,0,'L',false);
		$pdf->Cell($w[2],6,'COD123',0,0,'L',false);
		$pdf->Ln();
		
	}
	
$pdf->Output();	*/
	



?>
