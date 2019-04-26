<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ireporte extends CI_Controller {

    public function __construct()
    {
    	$CI =& get_instance(); 
        $CI->load->model('Modelo_cliente');
        $CI->load->model('Modelo_timbrado');
        $CI->load->model('Modelo_articulos');
        $CI->load->library('pdf');
        $CI->load->library('Numero_letra');

        $CI->facturas = 'assets/pdf/comprobantes/';
        date_default_timezone_set('America/Monterrey');
    }

	public function reporte($id,$xml)
	{
		$CI =& get_instance();
	    $CI->pdf = new Pdf('P','mm','A5');
	    $CI->pdf->AddPage();
	    $CI->pdf->AddFont('agency_fb');
	    $CI->pdf->SetTitle("Cotizacion");

	    $mesesfecha = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=date('d').' de '.$mesesfecha[date('n')-1]. ' de '.date('Y');
		$CI->pdf->SetFont('Arial','',10.5);

		$CI->pdf->SetXY(120, 50);
		$CI->pdf->Cell(5, 6,'Oaxaca de Juarez, Oaxaca,'.' '.$fecha, 0 , 1);
		$CI->pdf->Image('assets/img/logo_suzuki_2.png',25,140,170,90,'');
		$CI->pdf->Image('assets/img/logo_suzuki.jpg',140,10,60,30,'');
		$CI->pdf->Image('assets/img/nombre-atrum.jpg',20,20,100,10,'');
		$CI->pdf->Image('assets/img/direccion_oaxaca.jpg',50,275,120,13,'');

		// $articulos = $CI->Modelo_articulos->obtenerArticulosFactura($id);
		$resultado = $CI->Modelo_articulos->get_datosFacturacion($id);

		$CI->pdf->SetFillColor(194, 195, 188);
		$CI->pdf->SetFont('arial','B',10);
		$CI->pdf->Rect(10, 65, 190 , 20, '');
		$CI->pdf->SetXY(14, 68);
		$CI->pdf->Cell(26, 6,"PROVEEDOR",0, 1,'C',true);
		$CI->pdf->SetXY(12, 78);
		$CI->pdf->Cell(26, 6,$resultado->proveedor,0, 1);
		$CI->pdf->SetXY(90, 68);
		$CI->pdf->Cell(26, 6,"FACTURA", 0, 1,'C',true);
		$CI->pdf->SetXY(95, 78);
		$CI->pdf->Cell(26, 6,$resultado->factura,0, 1);
		$CI->pdf->SetXY(160, 68);
		$CI->pdf->Cell(35, 6,"FECHA CAPTURA", 0, 1,'C',true);		
		$CI->pdf->SetXY(160, 78);
		$CI->pdf->Cell(26, 6,$resultado->alta_dfacturacion,0, 1);
		$CI->pdf->Rect(10, 90, 190 , 8, 'DF');
		$CI->pdf->Rect(10, 90, 30 , 8, ''); # CLAVE ARTICULO
		$CI->pdf->SetXY(13, 92);
		$CI->pdf->Cell(5, 4,"Clave articulo", 0 , 1);
		$CI->pdf->Rect(40, 90, 60 , 8, ''); #DESCRIPCION
		$CI->pdf->SetXY(48, 92);
		$CI->pdf->Cell(5, 4,"Descripcion del articulo", 0 , 1);
		$CI->pdf->Rect(100, 90, 20 , 8, ''); #DESCUENTO
		$CI->pdf->SetXY(100, 92);
		$CI->pdf->Cell(5, 4,"P. Unitario", 0 , 1);
		$CI->pdf->Rect(120, 90, 20 , 8, ''); #IMPUESTO
		$CI->pdf->SetXY(122, 92);
		$CI->pdf->Cell(5, 4,"Cantidad", 0 , 1);
		$CI->pdf->Rect(140, 90, 20 , 8, ''); #P CON IVA
		$CI->pdf->SetXY(142, 92);
		$CI->pdf->Cell(5, 4,"Impuesto", 0 , 1);
		$CI->pdf->Rect(160, 90, 20 , 8, ''); #IMPORTE
		$CI->pdf->SetXY(160, 92);
		$CI->pdf->Cell(5, 4,"P. con IVA", 0 , 1);
		$CI->pdf->SetXY(183, 92);
		$CI->pdf->Cell(5, 4,"Importe", 0 , 1);
		
		$j = 105; 
		$total  = 0;
		$precio_siva = 0;
		$resta = 0;
		if (!empty($xml)) {
			foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {  

				$descuento  = 0;
	            $Concepto['Descuento'];
	            if (!empty($Concepto['Descuento'])) {
	                $descuento = $Concepto['Descuento'];
	            }
				$CI->pdf->SetFont('arial','',7.5);
				$CI->pdf->Rect(10, $j, 190 , 8, '');
				$CI->pdf->Rect(10, $j, 30 , 8, ''); # CLAVE ARTICULO
				$CI->pdf->SetXY(10, $j+2);
				$CI->pdf->Cell(5, 4,$Concepto['NoIdentificacion'], 0 , 1);
				$CI->pdf->SetFont('arial','',9);
				$CI->pdf->Rect(40, $j, 60 , 8, ''); #DESCRIPCION
				$CI->pdf->SetXY(40, $j+2);
				$CI->pdf->Cell(5, 4,substr($Concepto['Descripcion'], 0, 30), 0 , 1);
				$CI->pdf->Rect(100, $j, 20 , 8, ''); #p unitario
				$CI->pdf->SetXY(100, $j+2);
				$CI->pdf->Cell(5, 4,$Concepto['ValorUnitario'], 0 , 1);
				$CI->pdf->Rect(120, $j, 20 , 8, ''); #descuento
				$CI->pdf->SetXY(125, $j+2);
				$CI->pdf->Cell(5, 4,$Concepto['Cantidad'], 0 , 1);
				$CI->pdf->Rect(140, $j, 20 , 8, ''); #impueto
				$CI->pdf->SetXY(144, $j+2);
				$CI->pdf->Cell(5, 4,number_format(16)." %", 0 , 1);
				$CI->pdf->Rect(160, $j, 20 , 8, ''); #precio con iva

				$costoIVA = $Concepto['ValorUnitario']  * 1.16;

				$CI->pdf->SetXY(160, $j+2);
				$CI->pdf->Cell(5, 4,$costoIVA, 0 , 1);
				$CI->pdf->SetXY(180, $j+2);
				$importe  = ( $costoIVA * $Concepto['Cantidad']) - ($descuento * 1.16);

				// $importe = $Concepto['Importe'];
				$CI->pdf->Cell(5, 4,"$ ".number_format($importe,2), 0 , 1);

				$precio_siva = $precio_siva + ($Concepto['ValorUnitario'] * $Concepto['Cantidad']);
				$total       = $total + $importe;
				$j = $j + 8;
				if ($j > 270) {
					$CI->pdf->AddPage();
					$j=5;
				}
				$resta = $total - $precio_siva;
			}
		}
		$CI->pdf->SetFont('arial','B',9);
		$CI->pdf->Rect(10, $j+5, 190 , 20, '');
		$CI->pdf->SetXY(15, $j+6);
		$CI->pdf->Cell(18, 5,"*Total con letra*", 0 , 1);
		$CI->pdf->SetXY(12, $j+15);
		$CI->pdf->Cell(18, 5,$CI->numero_letra->numtoletras($total), 0 , 1);
		$CI->pdf->SetXY(150, $j+6);
		$CI->pdf->Cell(18, 5,"IMPORTE", 0 , 1,'',true);
		$CI->pdf->SetXY(175, $j+6);
		$CI->pdf->Cell(5, 4,"$ ". number_format($precio_siva,2), 0 , 1);
		$CI->pdf->SetXY(150, $j+12);
		$CI->pdf->Cell(18, 5,"IMPUESTO", 0 , 1,'',true);
		$CI->pdf->SetXY(175, $j+12);
		$CI->pdf->Cell(5, 4,"$ ". number_format($resta,2), 0 , 1);
		$CI->pdf->SetXY(150, $j+18);
		$CI->pdf->Cell(18, 5,"TOTAL", 0 , 1,'',true);
		$CI->pdf->SetXY(175, $j+18);
		$CI->pdf->Cell(5, 4,"$ ". number_format($total,2), 0 , 1);

		$ruta_destino = $CI->facturas;
		$hoy          = date("dmyhis");
		$pdfFilePath  = "inv_".$hoy.".pdf";

		$CI->pdf->Output($ruta_destino.$pdfFilePath, "F");

		return $pdfFilePath;
	}

	public function reporte_compra($id,$datos)
	{
		$CI =& get_instance();
	    $CI->pdf = new Pdf('P','mm','A5');
	    $CI->pdf->AddPage();
	    $CI->pdf->AddFont('agency_fb');
	    $CI->pdf->SetTitle("Cotizacion");

	    $mesesfecha = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=date('d').' de '.$mesesfecha[date('n')-1]. ' de '.date('Y');
		$CI->pdf->SetFont('Arial','',10.5);

		$CI->pdf->SetXY(120, 50);
		$CI->pdf->Cell(5, 6,'Oaxaca de Juarez, Oaxaca,'.' '.$fecha, 0 , 1);
		$CI->pdf->Image('assets/img/logo_suzuki_2.png',25,140,170,90,'');
		$CI->pdf->Image('assets/img/logo_suzuki.jpg',140,10,60,30,'');
		$CI->pdf->Image('assets/img/nombre-atrum.jpg',20,20,100,10,'');
		$CI->pdf->Image('assets/img/direccion_oaxaca.jpg',50,275,120,13,'');

		// $articulos = $CI->Modelo_articulos->obtenerArticulosFactura($id);
		$resultado = $CI->Modelo_articulos->get_datosFacturacion($id);

		$CI->pdf->SetFillColor(194, 195, 188);
		$CI->pdf->SetFont('arial','B',10);
		$CI->pdf->Rect(10, 65, 190 , 20, '');
		$CI->pdf->SetXY(14, 68);
		$CI->pdf->Cell(26, 6,"PROVEEDOR",0, 1,'C',true);
		$CI->pdf->SetXY(12, 78);
		$CI->pdf->Cell(26, 6,$resultado->proveedor,0, 1);
		$CI->pdf->SetXY(90, 68);
		$CI->pdf->Cell(26, 6,"FACTURA", 0, 1,'C',true);
		$CI->pdf->SetXY(95, 78);
		$CI->pdf->Cell(26, 6,$resultado->factura,0, 1);
		$CI->pdf->SetXY(160, 68);
		$CI->pdf->Cell(35, 6,"FECHA CAPTURA", 0, 1,'C',true);		
		$CI->pdf->SetXY(160, 78);
		$CI->pdf->Cell(26, 6,$resultado->alta_dfacturacion,0, 1);
		$CI->pdf->Rect(10, 90, 190 , 8, 'DF');
		$CI->pdf->Rect(10, 90, 30 , 8, ''); # CLAVE ARTICULO
		$CI->pdf->SetXY(13, 92);
		$CI->pdf->Cell(5, 4,"Clave articulo", 0 , 1);
		$CI->pdf->Rect(40, 90, 60 , 8, ''); #DESCRIPCION
		$CI->pdf->SetXY(48, 92);
		$CI->pdf->Cell(5, 4,"Descripcion del articulo", 0 , 1);
		$CI->pdf->Rect(100, 90, 20 , 8, ''); #DESCUENTO
		$CI->pdf->SetXY(100, 92);
		$CI->pdf->Cell(5, 4,"P. Unitario", 0 , 1);
		$CI->pdf->Rect(120, 90, 20 , 8, ''); #IMPUESTO
		$CI->pdf->SetXY(122, 92);
		$CI->pdf->Cell(5, 4,"Cantidad", 0 , 1);
		$CI->pdf->Rect(140, 90, 20 , 8, ''); #P CON IVA
		$CI->pdf->SetXY(142, 92);
		$CI->pdf->Cell(5, 4,"Impuesto", 0 , 1);
		$CI->pdf->Rect(160, 90, 20 , 8, ''); #IMPORTE
		$CI->pdf->SetXY(160, 92);
		$CI->pdf->Cell(5, 4,"P. con IVA", 0 , 1);
		$CI->pdf->SetXY(183, 92);
		$CI->pdf->Cell(5, 4,"Importe", 0 , 1);
		
		$j = 105; 
		$total  = 0;
		$precio_siva = 0;
		$resta = 0;
		if (!empty($datos)) {
			foreach ($datos ->result() as $articulo) 
			{
				$descuento  = 0;
	            // if (!empty($Concepto['Descuento'])) {
	            //     $descuento = $Concepto['Descuento'];
	            // }
				$CI->pdf->SetFont('arial','',7.5);
				$CI->pdf->Rect(10, $j, 190 , 8, '');
				$CI->pdf->Rect(10, $j, 30 , 8, ''); # CLAVE ARTICULO
				$CI->pdf->SetXY(10, $j+2);
				$CI->pdf->Cell(5, 4,$articulo->codigo, 0 , 1);
				$CI->pdf->SetFont('arial','',9);
				$CI->pdf->Rect(40, $j, 60 , 8, ''); #DESCRIPCION
				$CI->pdf->SetXY(40, $j+2);
				$CI->pdf->Cell(5, 4,substr($articulo->descripcion, 0, 30), 0 , 1);
				$CI->pdf->Rect(100, $j, 20 , 8, ''); #p unitario
				$CI->pdf->SetXY(100, $j+2);
				$CI->pdf->Cell(5, 4,$articulo->costo_proveedor, 0 , 1);
				$CI->pdf->Rect(120, $j, 20 , 8, ''); #descuento
				$CI->pdf->SetXY(125, $j+2);
				$CI->pdf->Cell(5, 4,$articulo->cantidad, 0 , 1);
				$CI->pdf->Rect(140, $j, 20 , 8, ''); #impueto
				$CI->pdf->SetXY(144, $j+2);
				$CI->pdf->Cell(5, 4,number_format(16)." %", 0 , 1);
				$CI->pdf->Rect(160, $j, 20 , 8, ''); #precio con iva

				$costoIVA = $articulo->costo_proveedor  * 1.16;

				$CI->pdf->SetXY(160, $j+2);
				$CI->pdf->Cell(5, 4,$costoIVA, 0 , 1);
				$CI->pdf->SetXY(180, $j+2);
				$importe  = ( $costoIVA * $articulo->cantidad) - ($descuento * 1.16);

				// $importe = $Concepto['Importe'];
				$CI->pdf->Cell(5, 4,"$ ".number_format($importe,2), 0 , 1);

				$precio_siva = $precio_siva + ($articulo->costo_proveedor * $articulo->cantidad);
				$total       = $total + $importe;
				$j = $j + 8;
				if ($j > 270) {
					$CI->pdf->AddPage();
					$j=5;
				}
				$resta = $total - $precio_siva;
			}
		}
		$CI->pdf->SetFont('arial','B',9);
		$CI->pdf->Rect(10, $j+5, 190 , 20, '');
		$CI->pdf->SetXY(15, $j+6);
		$CI->pdf->Cell(18, 5,"*Total con letra*", 0 , 1);
		$CI->pdf->SetXY(12, $j+15);
		$CI->pdf->Cell(18, 5,$CI->numero_letra->numtoletras($total), 0 , 1);
		$CI->pdf->SetXY(150, $j+6);
		$CI->pdf->Cell(18, 5,"IMPORTE", 0 , 1,'',true);
		$CI->pdf->SetXY(175, $j+6);
		$CI->pdf->Cell(5, 4,"$ ". number_format($precio_siva,2), 0 , 1);
		$CI->pdf->SetXY(150, $j+12);
		$CI->pdf->Cell(18, 5,"IMPUESTO", 0 , 1,'',true);
		$CI->pdf->SetXY(175, $j+12);
		$CI->pdf->Cell(5, 4,"$ ". number_format($resta,2), 0 , 1);
		$CI->pdf->SetXY(150, $j+18);
		$CI->pdf->Cell(18, 5,"TOTAL", 0 , 1,'',true);
		$CI->pdf->SetXY(175, $j+18);
		$CI->pdf->Cell(5, 4,"$ ". number_format($total,2), 0 , 1);

		$ruta_destino = $CI->facturas;
		$hoy          = date("dmyhis");
		$pdfFilePath  = "inv_".$hoy.".pdf";

		$CI->pdf->Output($ruta_destino.$pdfFilePath, "F");

		return $pdfFilePath;
	}
}