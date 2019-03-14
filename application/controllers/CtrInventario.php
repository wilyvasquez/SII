<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrInventario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');
        
        $this->load->model('Modelo_articulos');
        $this->load->model('Modelo_inventario');
        $this->load->model('Modelo_sat');
        $this->permisos->redireccion();

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function inventario()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "rinventario" => "active",
            "inventario" => "active",
            "title"      => "Articulos",
            "subtitle"   => "Alta de inventario",
            "contenido"  => "admin/inventario/inventario",
            "menu"       => $pmenu,
            "modal_f"    => $this->load->view('admin/inventario/modal/modal-fabricante',null,true), # AGREGAR NUEVO FABRICANTE
            "modal_l"    => $this->load->view('admin/inventario/modal/modal-linea',null,true), # AGREGAR NUEVA LINEA
            "modal_m"    => $this->load->view('admin/inventario/modal/modal-marca',null,true), # AGREGAR NUNEVA MARCA
            "modal_i"    => $this->load->view('admin/inventario/modal/modal-inventario',null,true), # AGREGAR NUNEVA MARCA
            "archivosJS" => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
            "clave"      => $this->Modelo_sat->get_claveSat(),
            "articulos"  => $this->Modelo_articulos->get_articulos(),
            "marcas"     => $this->Modelo_inventario->get_marca(),
            "lineas"     => $this->Modelo_inventario->get_linea(),
            "fabricantes"=> $this->Modelo_inventario->get_fabricante(),
            "tabla"      => $this->load->view('admin/inventario/tabla_inventario',null,true),
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function hinventario()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "rinventario" => "active",
            "historial"   => "active",
            "title"       => "Articulos",
            "subtitle"    => "Alta de inventario",
            "contenido"   => "admin/inventario/tabla_inventario",
            "menu"        => $pmenu,
            "articulos"   => $this->Modelo_articulos->get_articulos(),
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function put_inventario()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("articulo") && $this->input->post("clave") && $this->input->post("costo") && $this->input->post("unidad") && $this->input->post("codigoi") && $this->input->post("cantidad")) 
            {
                $id_clave = $this->input->post("unidad");
                $clave    = $this->Modelo_sat->get_clave($id_clave);

                $data = array(
                    'articulo'         => $this->input->post("articulo"),
                    'codigo_sat'       => $this->input->post("clave"),
                    'descripcion'      => $this->input->post("descripcion"),
                    'costo'            => $this->input->post("costo"),
                    'tipo'             => $this->input->post("tipo"),
                    'unidad'           => $clave->clave,
                    'clave_sat'        => $clave->c_ClaveUnidad,
                    'codigo_interno'   => $this->input->post("codigoi"),
                    'cantidad'         => $this->input->post("cantidad"),
                    'estatus_articulo' => "Activo",
                    'ref_marca'        => $this->input->post("marca"),
                    'ref_linea'        => $this->input->post("linea"),
                    'ref_fabricante'   => $this->input->post("fabricante"),
                    );
                $url      = "";
                $peticion = $this->Modelo_inventario->put_inventario($data);
                $msg      = "Exito, Articulo agregado correctamente";
                echo json_encode($this->funciones->resultado($peticion,$url,$msg));
            }else{
                $msg      = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
            }
        }
    }

    public function agregar_marca()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("marca") && $this->input->post("nombre")) 
            {
                $data = array(
                    'marca'       => $this->input->post("marca"),
                    'nombre'      => $this->input->post("nombre"),
                    'descripcion' => $this->input->post("observaciones")
                );
                $peticion = $this->Modelo_inventario->put_marca($data);
                if ($peticion) {
                    $url      = "ajax_marca";
                    $msg      = "Exito, Marca agregado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg));
                }
            }else{
                $msg      = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
            }
        }
    }

    public function ajax_marca()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $data['marcas'] = $this->Modelo_inventario->get_marca();
            $this->load->view('admin/marca/ajax/ajax_marca',$data);
        }
    }

    public function agregar_linea()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("linea") && $this->input->post("nombre") && $this->input->post("observaciones")) 
            {
                $data = array(
                    'linea'       => $this->input->post("linea"),
                    'nombre'      => $this->input->post("nombre"),
                    'descripcion' => $this->input->post("observaciones")
                );
                $peticion = $this->Modelo_inventario->put_linea($data);
                if ($peticion) {
                    $url      = "ajax_linea";
                    $msg      = "Exito, Linea agregado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg));
                }
            }else{
                $msg      = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
            }
        }
    }

    public function ajax_linea()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $data['lineas'] = $this->Modelo_inventario->get_linea();
            $this->load->view('admin/linea/ajax/ajax_linea',$data);
        }
    }

    public function agregar_fabricante()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            if ($this->input->post("fabricante") && $this->input->post("direccion") && $this->input->post("telefono") &&  $this->input->post("rfc")) 
            {
                $data = array(
                    'fabricante'  => $this->input->post("fabricante"),
                    'direccion'   => $this->input->post("direccion"),
                    'telefono'    => $this->input->post("telefono"),
                    'rfc'         => $this->input->post("rfc"),
                    'descripcion' => $this->input->post("observaciones")
                );
                $peticion = $this->Modelo_inventario->put_fabricante($data);
                if ($peticion) {
                    $url      = "ajax_fabricante";
                    $msg      = "Exito, Fabricante agregado correctamente";
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg));
                }
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg));
            }
        }
    }

    public function ajax_fabricante()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $data['fabricantes'] = $this->Modelo_inventario->get_fabricante();
            $this->load->view('admin/fabricante/ajax/ajax_fabricante',$data);
        }
    }

    public function up_inventario()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $id = $this->input->post("mid");
            $data = array(
                'articulo'       => $this->input->post("marticulo"),
                'codigo_interno' => $this->input->post("mcodigo"),
                'cantidad'       => $this->input->post("mcantidad"),
                'costo'          => $this->input->post("mcosto"),
                'clave_sat'      => $this->input->post("msat")
            );
            $peticion = $this->Modelo_articulos->update_articulo($id,$data);
            if ($peticion) {
                $msg = "Exito, Actualizado correctamente";
                echo json_encode($this->funciones->resultado($peticion, $url = "", $msg));
            }else{
                $msg = "Error, Accion no ejecutada";
                echo json_encode($this->funciones->resultado($peticion, $url = "", $msg));
            }
        }
    }

    public function getInventario()
    {
        $start      = $this->input->post("start");
        $length     = $this->input->post("length");
        $search     = $this->input->post("search")['value'];
        
        $result     = $this->Modelo_inventario->get_inventario($start,$length,$search);
        $resultado  = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();
        foreach ($resultado->result_array() as $row) {
            $array = array();
            $array['id_articulo']    = $row['id_articulo'];
            $array['articulo']       = $row['articulo'];
            $array['codigo_interno'] = $row['codigo_interno'];
            $array['cantidad']       = $row['cantidad'];
            $array['costo']          = $row['costo'];
            $array['codigo_sat']     = $row['codigo_sat'];

            $datos[] = $array;
        }

        $totalDatoObtenido = $resultado->num_rows();

        $json_data = array(
            'draw'            => intval($this->input->post('draw')), 
            'recordsTotal'    => intval($totalDatoObtenido),
            'recordsFiltered' => intval($totalDatos),
            'data'            => $datos
        );
        echo json_encode($json_data);
    }
}