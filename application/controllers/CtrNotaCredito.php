<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrNotaCredito extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');
        
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_timbrado');
        $this->load->model('Modelo_sat');
        $this->permisos->redireccion();

        $this->facturas = 'assets/pdf/facturas/';
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function pre_factura()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            'timbrado'    => "active",
            'ncredito'    => "active",
            'title'       => "Nota Credito",
            'subtitle'    => "Crear Nota Credito",
            'contenido'   => "admin/ncredito/nota_credito",
            'menu'        => $pmenu,
            'clientes'    => $this->Modelo_cliente->get_clientes(), # OBTENER TODOS LOS CLIENTES
            'fpagos'      => $this->Modelo_sat->get_formaPagos(),   # OBTENER FORMAS DE PAGO
            'mpagos'      => $this->Modelo_sat->get_metodoPagos(),  # OBTENER METODOS DE PAGO
            'ucfdis'      => $this->Modelo_sat->get_usoCfdi()       # OBTENER USO DEL CFDI
        );
        # VISTAS PARA OBTENER LOS DATOS DEL CLIENTE
        $data["info"]       = $this->load->view('admin/factura/info-cliente',$data,true); 
        # MODAL REGISTRAR CLIENTE NUEVO CLIENTE
        $data["mcliente"]   = $this->load->view('admin/factura/modal/modal-cliente',null,true);
        $data["dcliente"]   = $this->load->view('admin/factura/datos_cliente',$data,true);
        # ARCHIVOS JS
        $data["archivosJS"] = $this->load->view('admin/ncredito/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);
    }

    public function push_prencredito()
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
                    'codigo_preventa'  => "001-A0000".$preventa,
                    'condicion_pago'   => $condicion,
                    'forma_pago'       => $this->input->post("forma"),
                    'metodo_pago'      => $this->input->post("metodo"),
                    'uso_cfdi'         => $this->input->post("cfdi"),
                    'ref_cliente'      => $this->input->post("cliente"),
                    'tipo_preventa'    => "NotaCredito",
                );
                $id = $this->Modelo_timbrado->put_preventa($data); # GUADAR DATOS DE PRE NOTA DE CREDITO
                if($id){
                    # MOSTRAR VISTA BIEN
                    echo '<a href="'.base_url().'ncredito/'.$id.'" class="btn btn-primary btn-sm pull-left">Vincular Factura</a>'; 
                }else{
                    echo '<div class="alert alert-danger" role="alert">Error, al subir datos, contactar a sistemas.</div>'; # MOSTRAR VISTA ERROR
                }
            }else{
                echo '<div class="alert alert-danger" role="alert">Error, al generar la Nota de Credito.</div>'; # MOSTRAR VISTA ERROR
            }
        }
    }

    public function nota_credito($id)
    {
        $pmenu = $this->permisos->menu();
        $this->funciones->validacion_timbrado($id,$tipo = "prencredito");   
        # CONSULTA OBTENER ARTICULOS A FACTURAR
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
        $data["nombre"]      = $data['icliente']->cliente;
        $data["idCliente"]   = $data['icliente']->id_cliente;
        $data["precios"]     = $this->funciones->precios($id);
        $data["opciones"]    = $this->load->view('admin/tfactura/menu_opciones',$data,true);
        $data["permiso"]     = $this->funciones->permisos();
        
        $data = array(
            'timbrado'    => "active",
            'ncredito'    => "active",
            'title'       => "Nota Credito",
            'subtitle'    => "Timbrar Nota Credito",
            'contenido'   => "admin/tncredito/tncredito",
            'menu'        => $pmenu,
            'articulo'    => $this->load->view('admin/tfactura/agregar-articulo',$data,true), # VISTA DE AGREGAR ARTICULO
            'tarticulos'  => $this->load->view('admin/tfactura/tabla-articulos',$data,true),  # VISTA TABLA ARTICULOS
            'tuuid'       => $this->load->view('admin/tncredito/tabla_uuid',$data,true),      # VISTA DE TABLA UUID
            'precios'     => $this->load->view('admin/tncredito/timbrar_ncredito',$data,true),# VISTA DE TABLA DE PRECIOS
            'marticulo'   => $this->load->view('admin/tfactura/modal/modal-editar-articulo',null,true),  # MODAL EDITAR ARTICULO
            'mearticulo'  => $this->load->view('admin/tfactura/modal/modal-eliminar-articulo',null,true),# MODAL ELIMINAR ARTICULO
            'meuuid'      => $this->load->view('admin/tncredito/modal/modal-eliminar-uuid',null,true),   # MODAL ELIMINAR UUID
            'mtimbrar'    => $this->load->view('admin/tncredito/modal/modal-timbrar',null,true)          # MODAL AGREGAR UUID
        );    
        # ARCHIVOS JS
        $data["archivosJS"]  = $this->load->view('admin/tncredito/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);
    }

    public function generar_notasCredito($id)
    {
        $pmenu = $this->permisos->menu();

        $factura = $this->Modelo_timbrado->search_factura($id);
        $datos = array(
            'alta_preventa'    => date("Y-m-d H:i:s"),
            'condicion_pago'   => $factura->condicion_pago,
            'estatus_preventa' => "activo",
            'ref_cliente'      => $factura->ref_cliente,
            'forma_pago'       => $factura->forma_pago,
            'metodo_pago'      => $factura->metodo_pago,
            'uso_cfdi'         => $factura->uso_cfdi
        );
        $rid = $this->Modelo_timbrado->put_preventa($datos);

        $data = array(
            'timbrado'    => "active",
            'ncredito'    => "active",
            'title'       => "Nota Credito",
            'subtitle'    => "Crear Nota Credito",
            'contenido'   => "admin/ncredito/generar_ncredito",
            'menu'        => $pmenu,
            'rid'         => $rid
        );
        # ARCHIVOS JS
        $data["archivosJS"] = $this->load->view('admin/ncredito/archivos/archivosJS',null,true);
        $this->load->view('universal/plantilla',$data);
    }
}