<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrReportes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');
        $this->load->library('pdf');
        $this->load->library('Numero_letra');

        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_articulos');
        $this->permisos->redireccion();
        $this->load->library('html2pdf');
        $this->load->helper('date');

        $this->facturas = 'assets/pdf/comprobantes/';
        date_default_timezone_set('America/Monterrey');
    }

    public function reporte()
	{
	    $this->pdf = new Pdf('P','mm','A5');
	    $this->pdf->AddPage();
	    $this->pdf->AddFont('agency_fb');
	    $this->pdf->SetTitle("Cotizacion");

	    $mesesfecha = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=date('d').' de '.$mesesfecha[date('n')-1]. ' de '.date('Y');
		$this->pdf->SetFont('Arial','',10.5);

		$this->pdf->SetXY(120, 50);
		$this->pdf->Cell(5, 6,'Oaxaca de Juarez, Oaxaca,'.' '.$fecha, 0 , 1);
		$this->pdf->Image('assets/img/logo_suzuki_2.png',25,140,170,90,'');
		$this->pdf->Image('assets/img/logo_suzuki.jpg',140,10,60,30,'');
		$this->pdf->Image('assets/img/nombre-atrum.jpg',20,20,100,10,'');
		$this->pdf->Image('assets/img/direccion_oaxaca.jpg',30,275,120,13,'');

		$this->pdf->SetFillColor(215, 216, 210);
		$this->pdf->Rect(10, 40, 40 , 25, '');
		$this->pdf->Rect(10, 40, 40 , 5, 'FD');# NUM COTIZACION
		$this->pdf->SetXY(19, 41);
		$this->pdf->Cell(5, 4,'Cotizacion', 0 , 1);
		$this->pdf->Rect(10, 52, 40 , 5, 'FD');# FECHA
		$this->pdf->SetXY(14, 53);
		$this->pdf->Cell(1, 4,date("Y-m-d H:i:s"), 0 , 1);

		$this->pdf->Rect(10, 70, 90 , 20, '');	   
		$this->pdf->Rect(10, 70, 90 , 5, 'FD');	   
		$this->pdf->SetXY(14, 71);
		$this->pdf->Cell(5, 4,"Vendedor", 0 , 1);

		$this->pdf->Rect(110, 70, 90 , 20, '');	   
		$this->pdf->Rect(110, 70, 90 , 5, 'FD');	   
		$this->pdf->SetXY(115, 71);
		$this->pdf->Cell(5, 4,"Destinatario", 0 , 1);

		$this->pdf->Rect(10, 100, 190 , 20, '');
		$this->pdf->Rect(10, 100, 190 , 5, 'FD');
		$this->pdf->Rect(10, 100, 38 , 20, '');	 
		$this->pdf->SetXY(21, 101);
		$this->pdf->Cell(5, 4,"Pedido", 0 , 1); 
		$this->pdf->Rect(48, 100, 38 , 20, '');
		$this->pdf->SetXY(60, 101);
		$this->pdf->Cell(5, 4,"Metodo", 0 , 1);	   
		$this->pdf->Rect(86, 100, 38 , 20, '');	   
		$this->pdf->SetXY(91, 101);
		$this->pdf->Cell(5, 4,"Lugar Expedicion", 0 , 1);
		$this->pdf->Rect(124, 100, 38 , 20, '');
		$this->pdf->SetXY(129, 101);
		$this->pdf->Cell(5, 4,"Condicion de pago", 0 , 1);

		$this->pdf->Rect(10, 125, 190 , 135, '');
		$this->pdf->Rect(10, 125, 190 , 8, 'FD'); # cantidad
		$this->pdf->Rect(10, 125, 20 , 125, ''); #unidad
		$this->pdf->SetXY(12, 127);
		$this->pdf->Cell(5, 4,"Cantidad", 0 , 1);
		$this->pdf->Rect(30, 125, 20 , 125, ''); #codigo	   
		$this->pdf->SetXY(33, 127);
		$this->pdf->Cell(5, 4,"Unidad", 0 , 1);
		$this->pdf->Rect(50, 125, 20 , 125, '');  # p. unitario
		$this->pdf->SetXY(54, 127);
		$this->pdf->Cell(5, 4,"Codigo", 0 , 1);
		$this->pdf->Rect(160, 125, 20 , 125, ''); #valor
		$this->pdf->SetXY(110, 127);
		$this->pdf->Cell(5, 4,"Descripcion", 0 , 1);
		$this->pdf->SetXY(161, 127);
		$this->pdf->Cell(5, 4,"P. Unitario", 0 , 1);
		$this->pdf->SetXY(185, 127);
		$this->pdf->Cell(5, 4,"Total", 0 , 1);
		$this->pdf->Rect(10, 250, 190 , 10, '');
		$this->pdf->SetXY(20, 251);
		$this->pdf->Cell(5, 4,"Importe con letra", 0 , 1);
		$this->pdf->Rect(160, 260, 20 , 15, ''); #letras subtotal
		$this->pdf->SetXY(160, 260.5);

		$this->pdf->SetFont('Arial','',9);
		$this->pdf->Cell(5, 4,"Sub Total", 0 , 1);
		$this->pdf->SetXY(160, 265);
		$this->pdf->Cell(5, 4,"IVA (16 %)", 0 , 1);
		$this->pdf->SetXY(160, 270);
		$this->pdf->Cell(5, 4,"Total", 0 , 1);
		$this->pdf->Rect(180, 260, 20 , 15, ''); #totales

	    $this->pdf->Output("Cotizacion.pdf", 'I');
	}

	public function reporte_inventario($id)
	{
	    $this->pdf = new Pdf('P','mm','A5');
	    $this->pdf->AddPage();
	    $this->pdf->AddFont('agency_fb');
	    $this->pdf->SetTitle("Cotizacion");

	    $mesesfecha = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=date('d').' de '.$mesesfecha[date('n')-1]. ' de '.date('Y');
		$this->pdf->SetFont('Arial','',10.5);

		$this->pdf->SetXY(120, 50);
		$this->pdf->Cell(5, 6,'Oaxaca de Juarez, Oaxaca,'.' '.$fecha, 0 , 1);
		$this->pdf->Image('assets/img/logo_suzuki_2.png',25,140,170,90,'');
		$this->pdf->Image('assets/img/logo_suzuki.jpg',140,10,60,30,'');
		$this->pdf->Image('assets/img/nombre-atrum.jpg',20,20,100,10,'');
		$this->pdf->Image('assets/img/direccion_oaxaca.jpg',50,275,120,13,'');

		$articulos = $this->Modelo_articulos->obtenerArticulosFactura($id);
		$resultado = $this->Modelo_articulos->get_datosFacturacion($id);

		$this->pdf->SetFillColor(194, 195, 188);
		$this->pdf->SetFont('arial','B',10);
		$this->pdf->Rect(10, 65, 190 , 20, '');
		$this->pdf->SetXY(14, 68);
		$this->pdf->Cell(26, 6,"PROVEEDOR",0, 1,'C',true);
		$this->pdf->SetXY(12, 78);
		$this->pdf->Cell(26, 6,$resultado->proveedor,0, 1);
		$this->pdf->SetXY(90, 68);
		$this->pdf->Cell(26, 6,"FACTURA", 0, 1,'C',true);
		$this->pdf->SetXY(95, 78);
		$this->pdf->Cell(26, 6,$resultado->factura,0, 1);
		$this->pdf->SetXY(160, 68);
		$this->pdf->Cell(35, 6,"FECHA CAPTURA", 0, 1,'C',true);		
		$this->pdf->SetXY(160, 78);
		$this->pdf->Cell(26, 6,$resultado->alta_dfacturacion,0, 1);
		$this->pdf->Rect(10, 90, 190 , 8, 'DF');
		$this->pdf->Rect(10, 90, 30 , 8, ''); # CLAVE ARTICULO
		$this->pdf->SetXY(13, 92);
		$this->pdf->Cell(5, 4,"Clave articulo", 0 , 1);
		$this->pdf->Rect(40, 90, 60 , 8, ''); #DESCRIPCION
		$this->pdf->SetXY(48, 92);
		$this->pdf->Cell(5, 4,"Descripcion del articulo", 0 , 1);
		$this->pdf->Rect(100, 90, 20 , 8, ''); #DESCUENTO
		$this->pdf->SetXY(100, 92);
		$this->pdf->Cell(5, 4,"P. Unitario", 0 , 1);
		$this->pdf->Rect(120, 90, 20 , 8, ''); #IMPUESTO
		$this->pdf->SetXY(122, 92);
		$this->pdf->Cell(5, 4,"Cantidad", 0 , 1);
		$this->pdf->Rect(140, 90, 20 , 8, ''); #P CON IVA
		$this->pdf->SetXY(142, 92);
		$this->pdf->Cell(5, 4,"Impuesto", 0 , 1);
		$this->pdf->Rect(160, 90, 20 , 8, ''); #IMPORTE
		$this->pdf->SetXY(160, 92);
		$this->pdf->Cell(5, 4,"P. con IVA", 0 , 1);
		$this->pdf->SetXY(183, 92);
		$this->pdf->Cell(5, 4,"Importe", 0 , 1);
		
		$j = 105; 
		$total  = 0;
		$precio_siva = 0;
		$resta = 0;
		if (!empty($articulos)) {
			foreach ($articulos ->result() as $resul) {  
				$this->pdf->SetFont('arial','',7.5);
				$this->pdf->Rect(10, $j, 190 , 8, '');
				$this->pdf->Rect(10, $j, 30 , 8, ''); # CLAVE ARTICULO
				$this->pdf->SetXY(10, $j+2);
				$this->pdf->Cell(5, 4,$resul->codigo_interno, 0 , 1);
				$this->pdf->SetFont('arial','',9);
				$this->pdf->Rect(40, $j, 60 , 8, ''); #DESCRIPCION
				$this->pdf->SetXY(40, $j+2);
				$this->pdf->Cell(5, 4,substr($resul->descripcion, 0, 30), 0 , 1);
				$this->pdf->Rect(100, $j, 20 , 8, ''); #p unitario
				$this->pdf->SetXY(100, $j+2);
				$this->pdf->Cell(5, 4,"$ ".number_format($resul->costo_proveedor,2), 0 , 1);
				$this->pdf->Rect(120, $j, 20 , 8, ''); #descuento
				$this->pdf->SetXY(125, $j+2);
				$this->pdf->Cell(5, 4,number_format($resul->cantidad), 0 , 1);
				$this->pdf->Rect(140, $j, 20 , 8, ''); #impueto
				$this->pdf->SetXY(144, $j+2);
				$this->pdf->Cell(5, 4,number_format(16)." %", 0 , 1);
				$this->pdf->Rect(160, $j, 20 , 8, ''); #precio con iva
				$this->pdf->SetXY(160, $j+2);
				$this->pdf->Cell(5, 4,"$ ".number_format($resul->costo_proveedor * 1.16,2), 0 , 1);
				$this->pdf->SetXY(180, $j+2);
				$costoIVA = $resul->costo_proveedor  * 1.16;
				$importe  = ( $costoIVA * $resul->cantidad) - ($resul->desc_proveedor * 1.16);
				$this->pdf->Cell(5, 4,"$ ".number_format($importe,2), 0 , 1);
				$precio_siva = $precio_siva + ($resul->costo_proveedor * $resul->cantidad);
				$total       = $total + $importe;
				$j = $j + 8;
				if ($j > 270) {
					$this->pdf->AddPage();
					$j=5;
				}
				$resta = $total - $precio_siva;
			}
		}
		$this->pdf->SetFont('arial','B',9);
		$this->pdf->Rect(10, $j+5, 190 , 20, '');
		$this->pdf->SetXY(15, $j+6);
		$this->pdf->Cell(18, 5,"*Total con letra*", 0 , 1);
		$this->pdf->SetXY(12, $j+15);
		$this->pdf->Cell(18, 5,$this->numero_letra->numtoletras($total), 0 , 1);
		$this->pdf->SetXY(150, $j+6);
		$this->pdf->Cell(18, 5,"IMPORTE", 0 , 1,'',true);
		$this->pdf->SetXY(175, $j+6);
		$this->pdf->Cell(5, 4,"$ ". number_format($precio_siva,2), 0 , 1);
		$this->pdf->SetXY(150, $j+12);
		$this->pdf->Cell(18, 5,"IMPUESTO", 0 , 1,'',true);
		$this->pdf->SetXY(175, $j+12);
		$this->pdf->Cell(5, 4,"$ ". number_format($resta,2), 0 , 1);
		$this->pdf->SetXY(150, $j+18);
		$this->pdf->Cell(18, 5,"TOTAL", 0 , 1,'',true);
		$this->pdf->SetXY(175, $j+18);
		$this->pdf->Cell(5, 4,"$ ". number_format($total,2), 0 , 1);

		// $ruta_destino = $this->facturas;
		$hoy          = date("dmyhis");
		$pdfFilePath  = "inv_".$hoy.".pdf";

		// $this->pdf->Output($ruta_destino.$pdfFilePath, "F");
	 //    $this->pdf->Output($pdfFilePath, 'F');
	    $this->pdf->Output($pdfFilePath, 'I');
	}

	public function corte_caja($fechas)
	{
	    $this->pdf = new Pdf('P','mm','A5');
	    $this->pdf->AddPage();
	    $this->pdf->AddFont('agency_fb');
	    $this->pdf->SetTitle("Corte");

	    $mesesfecha = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=date('d').' de '.$mesesfecha[date('n')-1]. ' de '.date('Y');
		$this->pdf->SetFont('Arial','',10.5);

		$this->pdf->SetXY(120, 50);
		$this->pdf->Cell(5, 6,'Oaxaca de Juarez, Oaxaca,'.' '.$fecha, 0 , 1);
		$this->pdf->Image('assets/img/logo_suzuki_2.png',20,120,170,90,'');
		$this->pdf->Image('assets/img/logo_suzuki.jpg',140,10,60,30,'');
		$this->pdf->Image('assets/img/nombre-atrum.jpg',20,20,100,10,'');
		$this->pdf->Image('assets/img/direccion_oaxaca.jpg',50,275,120,13,'');

		$this->pdf->SetXY(90, 60);
		$this->pdf->Cell(26, 6,"CORTE CAJA",0, 1);

		$this->pdf->SetFillColor(194, 195, 188);
		$this->pdf->SetFont('Arial','B',10.5);
		$this->pdf->Rect(10, 70, 190 , 6, ''); # ANTICIPOS
		$this->pdf->SetXY(90, 70);
		$this->pdf->Cell(26, 6,"TIMBRADO",0, 1);
		$this->pdf->SetXY(20, 70);
		$this->pdf->Cell(26, 6,"FECHA: ". date("Y-m-d"),0, 1);

		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Rect(10, 76, 190 , 6, ''); # titulos
		$this->pdf->Rect(10, 76, 25 , 6, ''); # recibo anticipo
		$this->pdf->SetXY(16, 76);
		$this->pdf->Cell(26, 6,"Factura",0, 1);
		$this->pdf->Rect(35, 76, 22 , 6, ''); # factura
		$this->pdf->SetXY(39, 76);
		$this->pdf->Cell(26, 6,"Anticipo",0, 1);
		$this->pdf->Rect(57, 76, 68 , 6, ''); # nombre
		$this->pdf->SetXY(85, 76);
		$this->pdf->Cell(26, 6,"Nombre",0, 1);
		$this->pdf->SetXY(132, 76);
		$this->pdf->Cell(26, 6,"Tipo",0, 1);
		$this->pdf->Rect(150, 76, 15 , 6, ''); # forma de pago
		$this->pdf->SetXY(152, 76);
		$this->pdf->Cell(26, 6,"Forma",0, 1);
		$this->pdf->Rect(165, 76, 15, 6, ''); # forma de pago
		$this->pdf->SetXY(166, 76);
		$this->pdf->Cell(26, 6,"Metodo",0, 1);
		$this->pdf->SetXY(182, 76);
		$this->pdf->Cell(26, 6,"Monto",0, 1);

		$fecha        = $fechas;
		$motocicletas = $this->Modelo_timbrado->facturasEmitidas($fecha);
		$total = $credito = $caja = $cajaC = $motos = $motocicleta = $accesorios = $acces = $refacciones = $refacc = 0;
		$j = 82;
		if (!empty($motocicletas)) {
			foreach ($motocicletas ->result() as $moto) {  
				$this->pdf->SetXY(10, $j+1);
				$this->pdf->Cell(24, 4,$moto->serie."-".$moto->folio,0, 1,"C",true);
				$this->pdf->SetXY(58, $j);
				$this->pdf->Cell(26, 6,substr($moto->cliente, 0, 50),0, 1);
				$this->pdf->SetXY(128, $j);
				$this->pdf->Cell(26, 6,"",0, 1);	
				$this->pdf->SetXY(155, $j);
				$this->pdf->Cell(26, 6,$moto->forma_pago,0, 1);
				$this->pdf->SetFont('Arial','',7.5);
				$this->pdf->SetXY(165, $j);
				$this->pdf->Cell(26, 6,$moto->condicion_pago,0, 1);
				$this->pdf->SetFont('Arial','',10);
				$this->pdf->SetXY(180, $j);
				$this->pdf->Cell(26, 6,"$ ".number_format($moto->total_factura,2),0, 1);

				if ($moto->condicion_pago != "CREDITO") {
					$total = $total + $moto->total_factura;
					if ($moto->forma_pago == "01" && $moto->tipo_comprobante == "I") {
						$caja = $caja + $moto->total_factura;
					}
				}
				$j = $j + 6;
			}
		}
		$recibo = $this->Modelo_timbrado->facturasComprobantes($fecha);
		if (!empty($recibo)) {
			foreach ($recibo ->result() as $complemento) {  
				$this->pdf->SetXY(10, $j+1);
				$this->pdf->Cell(24, 4,$complemento->serie."-".$complemento->folio,0, 1,"C",true);
				$this->pdf->SetXY(58, $j);
				$this->pdf->Cell(26, 6,substr($complemento->cliente, 0, 50),0, 1);
				$this->pdf->SetXY(128, $j);
				$this->pdf->Cell(26, 6,"",0, 1);	
				$this->pdf->SetXY(155, $j);
				$this->pdf->Cell(26, 6,$complemento->forma_pago,0, 1);
				$this->pdf->SetFont('Arial','',7.5);
				$this->pdf->SetXY(165, $j);
				$this->pdf->Cell(26, 6,$complemento->condicion_pago,0, 1);
				$this->pdf->SetFont('Arial','',10);
				$this->pdf->SetXY(180, $j);
				$this->pdf->Cell(26, 6,"$ ".number_format($complemento->total_factura,2),0, 1);
				$j = $j + 6;
				$facturas = $this->Modelo_timbrado->get_facturasCom($complemento->id_factura);
				if (!empty($facturas)) {
					foreach ($facturas ->result() as $factura) {  
						$this->pdf->SetXY(34, $j+1);
						$this->pdf->Cell(22, 4,$factura->serie."-".$factura->folio,0, 1,"C",true);
						$this->pdf->SetXY(58, $j);
						$this->pdf->Cell(26, 6,"Factura",0, 1);
						$this->pdf->SetXY(155, $j);
						$this->pdf->Cell(26, 6,$factura->forma_pago,0, 1);
						$this->pdf->SetFont('Arial','',7.5);
						$this->pdf->SetXY(165, $j);
						$this->pdf->Cell(26, 6,$factura->condicion_pago,0, 1);
						$this->pdf->SetFont('Arial','',10);
						$this->pdf->SetXY(180, $j);
						$this->pdf->Cell(18, 4,"$ ".number_format($factura->total_factura,2),0, 1,"C",true);
						$j = $j + 6;						
					}
				}
				$credito = $credito + $complemento->total_factura;
				if ($factura->forma_pago == "01") {
					$cajaC   = $cajaC + $complemento->total_factura;
				}
			}
		}
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Rect(12, $j+8, 180 , 9, ''); # forma de pago
		$this->pdf->SetXY(15, $j+10);
		$this->pdf->Cell(30, 6,"Total: $ ".number_format($total + $credito,2),0, 1);
		$this->pdf->SetXY(70, $j+10);
		$this->pdf->Cell(26, 6,"Caja: $ ".number_format($caja + $cajaC,2),0, 1);
		// $this->pdf->SetXY(80, $j+10);
		// $this->pdf->Cell(26, 6,"Refacciones: $ ".number_format($refacciones + $refacc,2),0, 1);
		// $this->pdf->SetXY(120, $j+10);
		// $this->pdf->Cell(26, 6,"Accesorios: $ ".number_format($accesorios + $acces,2),0, 1);
		// $this->pdf->SetXY(160, $j+10);
		// $this->pdf->Cell(26, 6,"Motocicletas: $ ".number_format($motocicleta + $motos,2),0, 1);
	    $this->pdf->Output("Cortes.pdf", 'I');
	}

	/*public function pdf_inventario()
    {    
        $data = [];

		$hoy = date("dmyhis");

		$html         = $this->load->view('admin/reportes/reporte_inventario',null,true);
		$pdfFilePath  = "inv_".$hoy.".pdf";
		$ruta_destino = $this->facturas;
 
        //cargamos la libreria mPDF
        $this->load->library('M_pdf');
        $mpdf = new mPDF('c', 'A4'); 
 		$mpdf->WriteHTML($html);
		$mpdf->Output($ruta_destino.$pdfFilePath, "F");
		$mpdf->Output($ruta_destino.$pdfFilePath, "I"); 
    }*/

    public function show_pdf($nombre)
    {
        if(is_dir("./assets/pdf/comprobantes"))
        {
            $filename = $nombre; 
            $route = base_url("assets/pdf/comprobantes/".$nombre); 
            if(file_exists("./assets/pdf/comprobantes/".$filename))
            {
                header('Content-type: application/pdf'); 
                readfile($route);
            }
        }
    }
}