<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrNotaCredito extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Facturapi');
        $this->facturas = 'assets/pdf/facturas/';
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
    }

    public function pre_factura()
    {
        $data["timbrado"]    = "active";
        $data["ncredito"]    = "active";
        $data["title"]       = "Pre - Nota Credito";
        $data["subtitle"]    = "Crear Nota Credito";
        $data["contenido"]   = "admin/ncredito/nota_credito";
        $data["menu"]        = "admin/menu_admin";
        $data['clientes']    = $this->Modelo_cliente->get_clientes();
        $data['fpagos']      = $this->Modelo_sat->get_formaPagos();
        $data['mpagos']      = $this->Modelo_sat->get_metodoPagos();
        $data['ucfdis']      = $this->Modelo_sat->get_usoCfdi();

        $data["info"]        = $this->load->view('admin/factura/info-cliente',$data,true);
        $data["mcliente"]    = $this->load->view('admin/factura/modal/modal-cliente',null,true);
        $this->load->view('universal/plantilla',$data);
    }

    public function push_prencredito()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $preventa  = 1;
            $condicion = "CREDITO";
            $codigo    = $this->Modelo_timbrado->get_codigo();

            if (!empty($codigo)) {
                $preventa = $codigo->codigo_preventa + 1;
            }
            if ($this->input->post("metodo") == "PUE") {
                $condicion = "CONTADO";
            }

            $data = array(
                'alta_preventa'    => date("Y-m-d H:i:s"),
                'estatus_preventa' => "activo",
                'codigo_preventa'  => "001-A".$preventa,
                'condicion_pago'   => $condicion,
                'ref_cliente'      => $this->input->post("cliente"),
                'ref_formapago'    => $this->input->post("forma"),
                'ref_metodopago'   => $this->input->post("metodo"),
                'ref_usocfdi'      => $this->input->post("cfdi"),
            );
            $id = $this->Modelo_timbrado->put_preventa($data);
            echo '<a href="'.base_url().'ncredito/'.$id.'" class="btn btn-primary btn-sm pull-left">Vincular Factura</a>';
        }
    }

    public function nota_credito($id)
    {
        $this->validacion_timbrado($id);        
        $data["timbrado"]    = "active";
        $data["ncredito"]    = "active";
        $data["title"]       = "Nota Credito";
        $data["subtitle"]    = "Timbrar Nota Credito";
        $data["contenido"]   = "admin/tncredito/tncredito";
        $data["menu"]        = "admin/menu_admin";

        # CONSULTA OBTENER ARTICULAR A FACTURAR
        $data['articulos']   = $this->Modelo_articulos->get_articulos();
        $data['tarticulos']  = $this->Modelo_articulos->get_articulo($id);

        # CONSULTA FACTURAS Y TIPOS DE RELACION PARA VINCULAR
        $data['facturas']    = $this->Modelo_cliente->get_facturas();
        $data['trelacion']   = $this->Modelo_sat->get_tipoRelacion();

        # CONSULTA PRA OBTENER LOS UUID VINCULADOS
        $data['tuuid']       = $this->Modelo_timbrado->get_relacion($id);

        # CONSULTA OBTENER DATOS DEL CLIENTE
        $data["id"]          = $id;
        $data['icliente']    = $this->Modelo_cliente->datos_cliente($id);
        $data["precios"]     = $this->precios($id);

        # VISTAS FACTURAS
        $data["articulo"]    = $this->load->view('admin/tfactura/agregar-articulo',$data,true);
        $data["tarticulos"]  = $this->load->view('admin/tfactura/tabla-articulos',$data,true);
        
        # VISTAS NOTAS DE CREDITO
        $data["tuuid"]       = $this->load->view('admin/tncredito/tabla_uuid',$data,true);
        $data["precios"]     = $this->load->view('admin/tncredito/timbrar_ncredito',$data,true);

        # MODALES
        $data["marticulo"]   = $this->load->view('admin/tfactura/modal/modal-editar-articulo',null,true);
        $data["mearticulo"]  = $this->load->view('admin/tfactura/modal/modal-eliminar-articulo',null,true);
        $data["meuuid"]      = $this->load->view('admin/tncredito/modal/modal-eliminar-uuid',null,true);
        $data["mtimbrar"]    = $this->load->view('admin/tncredito/modal/modal-timbrar',null,true);
        $this->load->view('universal/plantilla',$data);
    }

    public function agregar_uuid()
    {
        $id   = $this->input->post("ids");
        $data = array(
            'uuid'            => $this->input->post("uuid"),
            't_relacion'      => $this->input->post("relacion"),
            'ref_preventa'    => $id
        );
        $peticion = $this->Modelo_timbrado->put_relacion($data);
        $url      = "ajax_tuuid";
        echo json_encode($this->resultado($peticion,$url));
    }

    public function ajax_tuuid()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id            = $this->input->post("ids");
            $data["tuuid"] = $this->Modelo_timbrado->get_relacion($id);
            $this->load->view('admin/tncredito/ajax/ajax_tuuid',$data);
        }
    }

    /**
     * FUNCION DE IMPRIMIR RESULTADO
     */
    function resultado($peticion,$url)
    {
        if($peticion)
        {
            $result = array(
                'respuesta' => 'correcto',
                'msg'       => '<div class="alert alert-success" role="alert">Accion realizada Correctamente</div>',
                'url'       => $url
            );
        }else{
            $result = array(
                'respuesta' => 'error',
                'msg'       => '<div class="alert alert-danger" role="alert">Error en la accion</div>',
                'url'       => $url
            );
        }
        return $result;
    }

    function precios($id)
    {
        $importe   = 0;
        $subtotal  = 0;
        $iva       = 0;
        $total     = 0;
        $descuento = 0;

        $articulos = $this->Modelo_articulos->get_articulosVenta($id);
        if (!empty($articulos)) {
            foreach ($articulos ->result() as $articulo) 
            {
                $importe = $importe + $articulo->importe;
                $descuento = $descuento + $articulo->descuento;
            }
            $subtotal  = number_format($importe,2);
            $iva       = number_format($subtotal * 0.16,2);
            $total     = number_format($importe + $iva,2);
            $descuento = number_format($descuento,2);
        }
         return array($subtotal,$iva,$descuento,$total);
    }

    function validacion_timbrado($id)
    {
        $timbrado = $this->Modelo_timbrado->validacion($id);
        if (!empty($timbrado)) 
        {
            $result   = $timbrado->estatus_preventa;
            $cliente  = $timbrado->ref_cliente;
            if ($result == "timbrado") {
                redirect(base_url().'pcliente/'.$cliente);
            }else if($result == "activo"){

            }           
        }else{
            redirect(base_url().'prefactura');
        }
    }
}