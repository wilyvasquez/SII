<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrInventario extends CI_Controller {

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

    public function agregar_marca()
    {
        $data = array(
            'marca'       => $this->input->post("marca"),
            'nombre'      => $this->input->post("nombre"),
            'descripcion' => $this->input->post("observaciones")
        );
        $peticion = $this->Modelo_inventario->put_marca($data);
        $url      = "ajax_marca";
        echo json_encode($this->resultado($peticion,$url));
    }

    public function ajax_marca()
    {
        $data['marcas'] = $this->Modelo_inventario->get_marca();
        $this->load->view('admin/marca/ajax/ajax_marca',$data);
    }
    /**
     * agregar nueva linea
     * @return [type] [description]
     */
    public function agregar_linea()
    {
        $data = array(
            'linea'       => $this->input->post("linea"),
            'nombre'      => $this->input->post("nombre"),
            'descripcion' => $this->input->post("observaciones")
        );
        $peticion = $this->Modelo_inventario->put_linea($data);
        $url      = "ajax_linea";
        echo json_encode($this->resultado($peticion,$url));
    }

    public function ajax_linea()
    {
        $data['lineas'] = $this->Modelo_inventario->get_linea();
        $this->load->view('admin/linea/ajax/ajax_linea',$data);
    }

    /**
     * agregar nueva fabricante
     * @return [type] [description]
     */
    public function agregar_fabricante()
    {
        $data = array(
            'fabricante'  => $this->input->post("fabricante"),
            'direccion'   => $this->input->post("direccion"),
            'telefono'    => $this->input->post("telefono"),
            'rfc'         => $this->input->post("rfc"),
            'descripcion' => $this->input->post("observaciones")
        );
        $peticion = $this->Modelo_inventario->put_fabricante($data);
        $url      = "ajax_fabricante";
        echo json_encode($this->resultado($peticion,$url));
    }

    public function ajax_fabricante()
    {
        $data['fabricantes'] = $this->Modelo_inventario->get_fabricante();
        $this->load->view('admin/fabricante/ajax/ajax_fabricante',$data);
    }

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

}