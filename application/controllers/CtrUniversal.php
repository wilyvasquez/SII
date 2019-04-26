<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrUniversal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');
        
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_timbrado');
        $this->permisos->redireccion();

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function push_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("cantidad") && $this->input->post("costo") && $this->input->post("codigo") && $this->input->post("ids")) 
            {
                $cantidad    = $this->input->post("cantidad");
                $costo       = round($this->input->post("costo") / 1.16,2);
                $id_articulo = $this->input->post("codigo");
                $resul       = $this->Modelo_articulos->obtener_articulo($id_articulo);
                $disponible  = $resul->cantidad;
                if ($cantidad <= $disponible) {
                    $data = array(
                        'cantidad_venta'       => $cantidad,
                        'alta_apreventa'       => date("Y-m-d H:i:s"),
                        'importe'              => $cantidad * $costo,
                        'descuento'            => 0,
                        'descripcion_preventa' => $this->input->post("descripcion"),
                        'ref_articulo'         => $this->input->post("codigo"),
                        'ref_preventa'         => $this->input->post("ids")
                    );
                    $peticion = $this->Modelo_articulos->put_articulo($data);
                    if ($peticion) {
                        $url  = "ajax_tarticulos";
                        echo json_encode($this->funciones->resultado($peticion, $url, $msg = null, null));
                    }
                }else{
                    $msg = "Error, Cantidad no suficiente";
                    echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));    
                }
            }else{
                $msg = "Error, No se agrego el articulo";
                echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
            }
        }
    }

    public function ajax_tarticulos()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("ids")) 
            {
                $id   = $this->input->post("ids");
                $data["tarticulos"] = $this->Modelo_articulos->get_articulo($id);
                $this->load->view('admin/tfactura/ajax/ajax_tarticulos',$data);
            }
        }
    }

    function delete_uuid()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if($this->input->post("uuid") && $this->input->post("ids"))
            {
                $id_uuid = $this->input->post("uuid");
                $id      = $this->input->post("ids");

                $peticion = $this->Modelo_timbrado->delete_relacion($id_uuid);
                if ($peticion)
                {
                    $data["tuuid"] = $this->Modelo_timbrado->get_relacion($id);
                    $this->load->view('admin/tncredito/ajax/ajax_tuuid',$data);
                }
            }else{
                $msg = "Error, No se han eliminado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
            }
        }
    }

    public function agregar_uuid()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("ids") && $this->input->post("uuid") && $this->input->post("relacion")) 
            {
                $id   = $this->input->post("ids");
                $data = array(
                    'uuid'         => $this->input->post("uuid"),
                    't_relacion'   => $this->input->post("relacion"),
                    'ref_preventa' => $id
                );
                $peticion = $this->Modelo_timbrado->put_relacion($data);
                if ($peticion) 
                {
                    $url      = "ajax_tuuid";
                    $msg      = "Exito, Agregado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
                }
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
            }
        }
    }

    public function ajax_tuuid()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("ids")) 
            {
                $id            = $this->input->post("ids");
                $data["tuuid"] = $this->Modelo_timbrado->get_relacion($id);
                $this->load->view('admin/tncredito/ajax/ajax_tuuid',$data);
            }
        }
    }

    function codigos_permisos($codigo)
    {
        $permiso = "";
        if ($this->session->userdata('permiso') == "admin") 
        {
            return $permiso;
        }else{
            $codigos = array("84101702", "84101704", "84111506");
            if (in_array($codigo, $codigos)) {
                return $permiso;
            }else{
                return "readonly";
            }            
        }
    }

    public function get_valorUnitario()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if($this->input->post("codigo"))
            {
                $codigo   = $this->input->post("codigo");
                $articulo = $this->Modelo_timbrado->get_importe($codigo);
                $permiso = $this->codigos_permisos($articulo->codigo_sat);
                // if ($articulo->codigo_sat == "84101702") {
                //     $permiso = "";
                // }else{
                //     $permiso = "disabled";
                // }
                $result = array(
                    'importe' => round($articulo->costo * 1.16,2),
                    'msg'     => $articulo->descripcion,
                    'permiso' => $permiso,
                );
                echo json_encode($result);                
            }
        }
    }

    public function get_importe()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("cantidad") && $this->input->post("costo")) 
            {
                $cantidad = $this->input->post("cantidad");
                $costo    = $this->input->post("costo");

                $importe = $cantidad * $costo;
                $result  = array(
                    'importe' => $importe,
                );
                echo json_encode($result);
            }
        }
    }

    public function eliminar_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("articulo")) 
            {
                $id = $this->input->post("articulo");
                $this->Modelo_articulos->delete_articulo($id);
                $url      = "ajax_tarticulos";
                $msg      = "Exito, Articulo eliminado correctamente";
                echo json_encode($this->funciones->resultado($peticion = true, $url, $msg,null));
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg,null));
            }
        }
    }

    public function editar_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if($this->input->post("articulo") && $this->input->post("costo") && $this->input->post("cantidad") && ($this->input->post("descuento") != null))
            {
                $id        = $this->input->post("articulo");
                $costo     = $this->input->post("costo");
                $cantidad  = $this->input->post("cantidad");
                $descuento = $this->input->post("descuento");
                $importe   = $costo; # MULTIPLICAMOS EL COSTO POR LA CANTIDAD PARA OBTENER EL IMPORTE
                $importe   = $importe;
                $descuento = $importe * ( $descuento / 100 ); # CONVERTIMOS EL PORCENTAJE EN PESOS

                if ($descuento <= $importe) 
                {
                    // $total   = $importe - $descuento;
                    $total   = $importe;

                    $data = array(
                        'cantidad_venta' => $cantidad,
                        'importe'        => $costo,
                        'descuento'      => $descuento,
                    );
                    $this->Modelo_timbrado->up_articuloTimbrado($id,$data);

                    $articulo = $this->input->post("idArticulo");
                    $datos = array(
                        'descripcion' => $this->input->post("descripcion")
                    );
                    $peticion = $this->Modelo_articulos->update_articulo($articulo, $datos);
                    if ($peticion) {
                        $url      = "ajax_tarticulos";
                        $msg      = "Exito, Descuento aplicado correctamente";
                        echo json_encode($this->funciones->resultado($peticion, $url, $msg, null));
                    }
                }else{
                    $url      = "ajax_tarticulos";
                    $msg      = "Error, descuento mayor que total";
                    echo json_encode($this->funciones->resultado($peticion = false, $url, $msg, null));
                }
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
            }
        }
    }

    public function ajax_precios()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if($this->input->post("ids"))
            {
                $id = $this->input->post("ids");
                $data["precios"] = $this->funciones->precios($id);
                $this->load->view('admin/tfactura/ajax/ajax_precio',$data);                
            }
        }   
    }

    public function principal()
    {        
        $pmenu = $this->permisos->menu();
        #CONSULTAS DASHBOARD
        $facturas         = $this->Modelo_cliente->get_doctoTipo('I');
        $ncredito         = $this->Modelo_cliente->get_doctoTipo('E');
        $rpagos           = $this->Modelo_cliente->get_doctoTipo('P');
        $total            = $this->Modelo_cliente->get_allFacturas();        

        $datos["facturas"] = 0;
        $datos["ncredito"] = 0;
        $datos["rpagos"]   = 0;
        $datos["total"]    = 0;

        if (!empty($facturas)) { $datos["facturas"] = $facturas->num_rows(); }
        if (!empty($ncredito)) { $datos["ncredito"] = $ncredito->num_rows(); }
        if (!empty($rpagos)) { $datos["rpagos"]   = $rpagos->num_rows(); }
        if (!empty($total)) { $datos["total"]    = $total->num_rows(); }

        $data = array(
            "home"          => "active",
            "title"         => "Dashboard",
            "subtitle"      => "Estadisticas",
            "contenido"     => "admin/home/home",
            "menu"          => $pmenu,
            "info"          => $this->load->view('admin/home/informacion',$datos,true),
            "grafica"       => $this->load->view('admin/home/grafica_estadisticas',null,true),
            "pastel"        => $this->load->view('admin/home/grafica_pastel',null,true),
            "tareas"        => $this->load->view('admin/home/tareas',null,true),
            "archivosJS"    => $this->load->view('admin/home/archivos/archivosJS',null,true),
        );

        $this->load->view('universal/plantilla',$data);
    }

    # VISTA PREDETERMINADA NOT FOUND EN EL ARCHIVO ROUTES
    public function not_found()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "title"     => "404 Error Pagina",
            "subtitle"  => "Error",
            "contenido" => "universal/not_found",
            "menu"      => $pmenu,
            "archivosJS"=> $this->load->view('admin/factura/archivos/archivosJS',null,true)  # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function get_datosCliente()
    {
        if(!$this->input->is_ajax_request())
        {
            // $this->not_found->not_found();
        }else{
            if($this->input->post("id"))
            {
                $id = $this->input->post("id");                
                $resul = $this->Modelo_cliente->obtener_cliente($id);
                echo json_encode(
                    $result = array(
                        'cliente'    => $resul->cliente,
                        'rfc'        => $resul->rfc,
                        'correo'     => $resul->correo,
                        'telefono'   => $resul->telefono,
                        'direccion'  => $resul->direccion,
                        'id_cliente' => $resul->id_cliente
                    )
                );
            }
        } 

    }

    public function get_allTimbrado()
    {
        $pmenu          = $this->permisos->menu();
        $datos["docto"] = $this->Modelo_cliente->get_allFacturas();
        $data = array(
            "global"      => "active",
            "doctos"      => "active",
            "title"       => "Documentos Timbrado",
            "subtitle"    => "Timbrado",
            "contenido"   => "admin/timbrado/timbrado",
            "menu"        => $pmenu,
            "tabla"       => $this->load->view('admin/timbrado/tabla_timbrado',$datos,true),
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true)  # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function global_rfactura()
    {
        $pmenu          = $this->permisos->menu();
        $datos['ifacturas'] = $this->Modelo_cliente->global_facturas();
        $data = array(
            "global"      => "active",
            "gfacturas"   => "active",
            "title"       => "Documentos Timbrado",
            "subtitle"    => "Timbrado",
            "contenido"   => "admin/global/gfacturas_relacion",
            "menu"        => $pmenu,
            "tabla"       => $this->load->view('admin/timbrado/tabla_timbrado',$datos,true),
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true)  # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function datos_factura($id)
    {   
        $pmenu             = $this->permisos->menu();
        $dato["dato"]      = $this->Modelo_timbrado->search_factura($id);
        $id_cliente        = $dato["dato"]->ref_cliente;
        $dato["clientes"]  = $this->Modelo_cliente->obtener_cliente($id_cliente);
        $dato["articulos"] = $this->Modelo_articulos->get_articuloFacturado($id);   
        $data = array(
            "global"      => "active",
            "doctos"      => "active",
            "title"       => "INFORMACION DE DOCTO",
            "subtitle"    => "Archivo",
            "contenido"   => "admin/timbrado/datos_factura",
            "menu"        => $pmenu,
            "datos"       => $this->load->view('admin/timbrado/datos_factura',$dato,true)
        );
        $this->load->view('universal/plantilla',$data);
    }
}