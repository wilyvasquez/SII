<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrRecibosPago extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_sucursal');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function pre_pagos()
    {
        $data = array(
            'timbrado'    => "active",
            'rpagos'      => "active",
            'title'       => "Recibo de pagos",
            'subtitle'    => "Crear Recibo pago",
            'contenido'   => "admin/rpagos/recibo_pagos",
            'menu'        => "admin/menu_admin",            
            'mcliente'    => $this->load->view('admin/factura/modal/modal-cliente',null,true), # MODAL REGISTRAR CLIENTE NUEVO CLIENTE
            'clientes'    => $this->Modelo_cliente->get_clientes(), # OBTENER TODOS LOS CLIENTES
            'fpagos'      => $this->Modelo_sat->get_formaPagos(),   # OBTENER FORMAS DE PAGO
            'mpagos'      => $this->Modelo_sat->get_metodoPagos(),  # OBTENER METODOS DE PAGO
            'ucfdis'      => $this->Modelo_sat->get_usoCfdi()      # OBTENER USO DEL CFDI
        );
        $data['info']     = $this->load->view('admin/factura/info-cliente',$data,true); # VISTAS PARA OBTENER LOS DATOS DEL CLIENTE
        $data["dcliente"] = $this->load->view('admin/factura/datos_cliente',$data,true);
        # ARCHIVOS JS
        $data["archivosJS"]  = $this->load->view('admin/rpagos/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);   
    }

    public function push_prepagos()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("forma") && $this->input->post("metodo") && $this->input->post("cfdi") && $this->input->post("cliente")) 
            {
                $preventa  = 1;
                $condicion = "CREDITO";
                $codigo    = $this->Modelo_timbrado->get_codigo(); # OBTENER EL ULTIMO CODIGO DE PREVENTA
                # CONDICION SOBRE SI YA EXISTE ALGUN REGISTRO (COMPROBAR SI ESTA BIEN, CREO HAY ERROR)
                if (!empty($codigo)) {
                    $preventa = $codigo->codigo_preventa + 1; # AGREGAMOS UN UNO AL ULTIMO CODIGO
                }
                if ($this->input->post("metodo") == "PUE") { # VALIDAMOS EL TIPO DE METODO ENVIADO
                    $condicion = "CONTADO";
                }
                # ARREGLO DE DATOS PARA GUARDAR
                $data = array(
                    'alta_preventa'    => date("Y-m-d H:i:s"),
                    'codigo_preventa'  => "001-A".$preventa,
                    'condicion_pago'   => $condicion,
                    'forma_pago'       => $this->input->post("forma"),
                    'metodo_pago'      => $this->input->post("metodo"),
                    'uso_cfdi'         => $this->input->post("cfdi"),
                    'ref_cliente'      => $this->input->post("cliente")
                );
                $id = $this->Modelo_timbrado->put_preventa($data); # GUADAR DATOS DE PRE RECIBO DE PAGO
                if($id){
                    echo '<a href="'.base_url().'rpagos/'.$id.'" class="btn btn-primary btn-sm pull-left">Agregar Complemento</a>'; 
                }else{
                    echo '<div class="alert alert-danger" role="alert">Error, al subir datos, contactar a sistemas.</div>'; # MOSTRAR VISTA ERROR
                }
            }else{
                echo '<div class="alert alert-danger" role="alert">Error, al generar el recibo de pago.</div>'; # MOSTRAR VISTA ERROR
            }
        }
    }

    public function recibo_pagos($id)
    {
        $this->funciones->validacion_timbrado($id,$tipo = "prepagos");
        $data["id"]         = $id;
        $data['icliente']   = $this->Modelo_cliente->datos_cliente($id);
        $id_cliente         = $data['icliente']->id_cliente;
        $data["nombre"]     = $data['icliente']->cliente;
        $data['facturas']   = $this->Modelo_cliente->get_facturaCliente($id_cliente);
        $data['rdocto']     = $this->Modelo_timbrado->get_relacionDocto($id);
        $data["precios"]    = $this->funciones->precios($id);

        $data = array(
            'timbrado'   => "active",
            'rpagos'     => "active",
            'title'      => "Recibo de pagos",
            'subtitle'   => "Timbrar Recibo pago",
            'contenido'  => "admin/trpagos/trpagos",
            'menu'       => "admin/menu_admin",
            'articulo'   => $this->load->view('admin/trpagos/agregar_docto',$data,true),
            'tarticulos' => $this->load->view('admin/tfactura/tabla-articulos',$data,true),
            'tdoctos'    => $this->load->view('admin/trpagos/tabla_doctos',$data,true),
            'precios'    => $this->load->view('admin/trpagos/timbrar_rpagos',$data,true),
            'meuuid'     => $this->load->view('admin/trpagos/modal/eliminar_uuidRpagos',$data,true)
        );        
        # ARCHIVOS JS
        $data["archivosJS"] = $this->load->view('admin/trpagos/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);
    }

    public function agregar_docto()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("uuid") && $this->input->post("monto") && $this->input->post("parcialidad") && $this->input->post("ids")) 
            {
                # FUNCIONALIDAD DE AGREGAR UUID A LOS RECIBOS DE PAGOS
                $uuid        = $this->input->post("uuid");
                $monto       = $this->input->post("monto");
                $id_preventa = $this->input->post("ids"); 

                # FUNCION PARA SABER EL COSTO RESTANTE DE UNA FACTURA
                $factura  = $this->funciones->saldoRestanteCliente($uuid);
                $cantidad = $factura;

                if ($monto <= $cantidad ) {
                    $data = array(
                        'uuid'         => $uuid, 
                        'parcialidad'  => $this->input->post("parcialidad"), 
                        'monto'        => $monto,
                        'ref_preventa' => $this->input->post("ids")
                    );
                    $this->Modelo_timbrado->put_documento($data);        

                    $data['rdocto'] = $this->Modelo_timbrado->get_relacionDocto($id_preventa);
                    $this->load->view('admin/trpagos/ajax/ajax_trpagos',$data);
                }else{
                    $msg = "Error, El saldo restante es $ ".number_format($cantidad,2);
                    echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
                }
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
            }
        }
    }

    # OBTENEMOS LA PARCIALIDAD DEL CLIENTE
    function get_parcialidad()
    {
        if ($this->input->post("uuid")) 
        {
            $uuid          = $this->input->post("uuid");
            $resul         = $this->Modelo_timbrado->get_recibosPagos($uuid);
            $saldoRestante = $this->funciones->saldoRestanteCliente($uuid);
            if ($saldoRestante != 0) {
                if (!empty($resul)) {
                    $id    = $resul->factura_hijo;
                    $res   = $this->Modelo_timbrado->get_contarComprobantesPago($id);
                    if (!empty($res)) {
                        if ($res->numero == 0) {
                            $parcialidad = 1;
                        }else{
                            $parcialidad = $res->numero + 1;
                        }
                    }
                }else{
                    $parcialidad = 1;
                }
                $msg = "bien";
            }else{
                 $msg = "error"; 
                 $parcialidad = 0;
            }
            echo json_encode($this->resultadosPagos($parcialidad,$saldoRestante,$msg));
        }
    }

    # ENVIAMOS EL ARREGLO DE LOS DATOS 
    function resultadosPagos($parcialidad,$saldoRestante,$msg)
    {
        $result = array(
            'parcialidad' => $parcialidad,
            'total'       => number_format($saldoRestante,2),
            'msg'         => $msg
        );
        return $result;
    }

    function deleteUuidRecibosPago()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("uuid") && $this->input->post("ids")) 
            {
                $id_uuid = $this->input->post("uuid");
                $id      = $this->input->post("ids");
                $this->Modelo_timbrado->delete_relacionDocto($id_uuid);
                
                $data['rdocto'] = $this->Modelo_timbrado->get_relacionDocto($id);
                $this->load->view('admin/trpagos/ajax/ajax_trpagos',$data);
            }else{
                $msg = "Error, No se han eliminado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
            }
        }
    }
}