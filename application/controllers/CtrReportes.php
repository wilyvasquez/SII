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
        
        $this->load->helper('date');
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

		$this->pdf->SetFont('arial','',9);
		$j = 105; 
		$total  = 0;
		$precio_siva = 0;
		$resta = 0;
		if (!empty($articulos)) {
			foreach ($articulos ->result() as $resul) {  
				$this->pdf->Rect(10, $j, 190 , 8, '');
				$this->pdf->Rect(10, $j, 30 , 8, ''); # CLAVE ARTICULO
				$this->pdf->SetXY(10, $j+2);
				$this->pdf->Cell(5, 4,$resul->codigo_interno, 0 , 1);
				$this->pdf->Rect(40, $j, 60 , 8, ''); #DESCRIPCION
				$this->pdf->SetXY(40, $j+2);
				$this->pdf->Cell(5, 4,substr($resul->descripcion, 0, 30), 0 , 1);
				$this->pdf->Rect(100, $j, 20 , 8, ''); #p unitario
				$this->pdf->SetXY(100, $j+2);
				$this->pdf->Cell(5, 4,"$ ".number_format($resul->costo,2), 0 , 1);
				$this->pdf->Rect(120, $j, 20 , 8, ''); #descuento
				$this->pdf->SetXY(125, $j+2);
				$this->pdf->Cell(5, 4,number_format($resul->cantidad), 0 , 1);
				$this->pdf->Rect(140, $j, 20 , 8, ''); #impueto
				$this->pdf->SetXY(144, $j+2);
				$this->pdf->Cell(5, 4,number_format(16)." %", 0 , 1);
				$this->pdf->Rect(160, $j, 20 , 8, ''); #precio con iva
				$this->pdf->SetXY(160, $j+2);
				$this->pdf->Cell(5, 4,"$ ".number_format($resul->costo * 1.16,2), 0 , 1);
				$this->pdf->SetXY(180, $j+2);
				$this->pdf->Cell(5, 4,"$ ".number_format(($resul->costo * 1.16) * $resul->cantidad,2), 0 , 1);
				$precio_siva = $precio_siva +$resul->costo * $resul->cantidad;
				$total       = $total + ($resul->costo * 1.16) * $resul->cantidad;
				$j = $j + 8;
				if ($j > 270) {
					$this->pdf->AddPage();
					$j=5;
				}
				$resta       = $total - $precio_siva;
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
	    $this->pdf->Output("Cotizacion.pdf", 'I');
	}

	public function corte_caja()
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
		$this->pdf->Image('assets/img/logo_suzuki_2.png',20,120,170,90,'');
		$this->pdf->Image('assets/img/logo_suzuki.jpg',140,10,60,30,'');
		$this->pdf->Image('assets/img/nombre-atrum.jpg',20,20,100,10,'');
		$this->pdf->Image('assets/img/direccion_oaxaca.jpg',50,275,120,13,'');

		$this->pdf->SetXY(90, 64);
		$this->pdf->Cell(26, 6,"CORTE CAJA",0, 1);

	    $this->pdf->Output("Cotizacion.pdf", 'I');
	}
}