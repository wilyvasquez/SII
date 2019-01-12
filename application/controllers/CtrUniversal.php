<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrUniversal extends CI_Controller {

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

    public function push_articulo()
    {
        $cantidad = $this->input->post("cantidad");
        $costo    = $this->input->post("costo");
        $data = array(
            'cantidad_venta'       => $cantidad,
            'alta_apreventa'       => date("Y-m-d H:i:s"),
            'importe'              => $cantidad * $costo,
            'descuento'            => 0,
            'descripcion_preventa' => $this->input->post("descripcion"),
            'ref_articulo'         => $this->input->post("codigo"),
            'ref_pre_venta'        => $this->input->post("ids")
        );
        $url      = "ajax_tarticulos";
        $peticion = $this->Modelo_articulos->put_articulo($data);
        echo json_encode($this->resultado($peticion,$url));
    }

    public function ajax_tarticulos()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id   = $this->input->post("ids");
            $data["tarticulos"] = $this->Modelo_articulos->get_articulo($id);
            $this->load->view('admin/tfactura/ajax/ajax_tarticulos',$data);
        }
    }

    function delete_uuid()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id_uuid = $this->input->post("uuid");
            $id      = $this->input->post("ids");

            $this->Modelo_timbrado->delete_relacion($id_uuid);
            $data["tuuid"] = $this->Modelo_timbrado->get_relacion($id);
            $this->load->view('admin/tncredito/ajax/ajax_tuuid',$data);
        }
    }

    // public function ajax_tarticulos()
    // {
    //     if(!$this->input->is_ajax_request())
    //     {
    //      show_404();
    //     }else{
    //         $id   = $this->input->post("ids");
    //         $data["tarticulos"] = $this->Modelo_articulos->get_articulo($id);
    //         $this->load->view('admin/tfactura/ajax/ajax_tarticulos',$data);
    //     }
    // }

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