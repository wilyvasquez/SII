<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrRecibosPago extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
    }

    public function pre_pagos()
    {
        $data["timbrado"]    = "active";
        $data["rpagos"]      = "active";
        $data["title"]       = "Recibo de pagos";
        $data["subtitle"]    = "Crear Recibo pago";
        $data["contenido"]   = "admin/rpagos/recibo_pagos";
        $data["menu"]        = "admin/menu_admin";

        $data['clientes']    = $this->Modelo_cliente->get_clientes();
        $data['fpagos']      = $this->Modelo_sat->get_formaPagos();
        $data['mpagos']      = $this->Modelo_sat->get_metodoPagos();
        $data['ucfdis']      = $this->Modelo_sat->get_usoCfdi();

        $data["info"]        = $this->load->view('admin/factura/info-cliente',$data,true);
        $data["mcliente"]    = $this->load->view('admin/factura/modal/modal-cliente',null,true);
        # ARCHIVOS JS
        $data["archivosJS"]  = $this->load->view('admin/rpagos/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);   
    }

    public function push_prepagos()
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
                'codigo_preventa'  => "001-A".$preventa,
                'condicion_pago'   => $condicion,
                'forma_pago'       => $this->input->post("forma"),
                'metodo_pago'      => $this->input->post("metodo"),
                'uso_cfdi'         => $this->input->post("cfdi"),
                'ref_cliente'      => $this->input->post("cliente")
            );
            $id = $this->Modelo_timbrado->put_preventa($data);
            echo '<a href="'.base_url().'rpagos/'.$id.'" class="btn btn-primary btn-sm pull-left">Agregar Complemento</a>';
        }
    }

    public function recibo_pagos($id)
    {
        $data["timbrado"]      = "active";
        $data["rpagos"]        = "active";
        $data["title"]         = "Recibo de pagos";
        $data["subtitle"]      = "Timbrar Recibo pago";
        $data["contenido"]     = "admin/trpagos/trpagos";
        $data["menu"]          = "admin/menu_admin";
        
        $data["id"]            = $id;
        $data['icliente']      = $this->Modelo_cliente->datos_cliente($id);
        $id_cliente            = $data['icliente']->id_cliente;
        $data["nombre"]        = $data['icliente']->cliente;
        $data['facturas']      = $this->Modelo_cliente->get_factura($id_cliente);
        $data['rdocto']        = $this->Modelo_timbrado->get_relacionDocto($id);

        $data["precios"]     =  $this->funciones->precios($id);
        $data["articulo"]    = $this->load->view('admin/trpagos/agregar_docto',$data,true);
        $data["tarticulos"]  = $this->load->view('admin/tfactura/tabla-articulos',$data,true);
        $data["tdoctos"]     = $this->load->view('admin/trpagos/tabla_doctos',$data,true);
        $data["precios"]     = $this->load->view('admin/trpagos/timbrar_rpagos',$data,true);
        // $data["marticulo"]   = $this->load->view('admin/tfactura/modal/modal-editar-articulo',null,true);
        // $data["mearticulo"]  = $this->load->view('admin/tfactura/modal/modal-eliminar-articulo',null,true);
        $data["meuuid"]      = $this->load->view('admin/trpagos/modal/eliminar_uuidRpagos',$data,true);
        // $data["mtimbrar"]    = $this->load->view('admin/tncredito/modal/modal-timbrar',null,true);
        # ARCHIVOS JS
        $data["archivosJS"]  = $this->load->view('admin/trpagos/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);
    }

    public function agregar_docto()
    {
        $uuid    = $this->input->post("uuid");
        $monto   = $this->input->post("monto");
        
        $factura  = $this->Modelo_timbrado->get_factura($uuid);
        $cantidad = $factura->total_factura;

        if ($monto <= $cantidad ) {
            $data = array(
                'uuid'         => $uuid, 
                'parcialidad'  => $this->input->post("parcialidad"), 
                'monto'        => $monto,
                'ref_preventa' => $this->input->post("ids")
            );
            $this->Modelo_timbrado->put_documento($data);

        }
        $id_preventa    = $this->input->post("ids");
        $data['rdocto'] = $this->Modelo_timbrado->get_relacionDocto($id_preventa);
        $this->load->view('admin/trpagos/ajax/ajax_trpagos',$data);

    }

    function get_parcialidad()
    {
        $uuid = $this->input->post("uuid");
        $res  = $this->Modelo_timbrado->get_recibosPagos($uuid);
        if (!empty($res)) {
            # code...
        }else{
            echo 1;
        }
    }

    function deleteUuidRecibosPago()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id_uuid = $this->input->post("uuid");
            $id      = $this->input->post("ids");
            $this->Modelo_timbrado->delete_relacionDocto($id_uuid);
            
            $data['rdocto'] = $this->Modelo_timbrado->get_relacionDocto($id);
            $this->load->view('admin/trpagos/ajax/ajax_trpagos',$data);
        }
    }

}