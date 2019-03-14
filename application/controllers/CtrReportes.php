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

        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
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
}