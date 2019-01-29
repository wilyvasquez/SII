<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrUniversal extends CI_Controller {

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

    public function push_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $cantidad = $this->input->post("cantidad");
            $costo    = $this->input->post("costo");
            $data = array(
                'cantidad_venta'       => $cantidad,
                'alta_apreventa'       => date("Y-m-d H:i:s"),
                'importe'              => $cantidad * $costo,
                'descuento'            => 0,
                'descripcion_preventa' => $this->input->post("descripcion"),
                'ref_articulo'         => $this->input->post("codigo"),
                'ref_preventa'         => $this->input->post("ids")
            );
            $url      = "ajax_tarticulos";
            $peticion = $this->Modelo_articulos->put_articulo($data);
            $msg      = "";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
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

    public function agregar_uuid()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id   = $this->input->post("ids");
            $data = array(
                'uuid'            => $this->input->post("uuid"),
                't_relacion'      => $this->input->post("relacion"),
                'ref_preventa'    => $id
            );
            $peticion = $this->Modelo_timbrado->put_relacion($data);
            $url      = "ajax_tuuid";
            $msg      = "Exito, Agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
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

    public function get_valorUnitario()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $codigo   = $this->input->post("codigo");
            $articulo = $this->Modelo_timbrado->get_importe($codigo);
            $result = array(
                'importe' => $articulo->costo,
                'msg'     => $articulo->descripcion,
            );
            echo json_encode($result);
        }
    }

    public function get_importe()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $cantidad = $this->input->post("cantidad");
            $costo    = $this->input->post("costo");

            $importe = $cantidad * $costo;
            $result = array(
                'importe' => $importe,
            );
            echo json_encode($result);
        }
    }

    public function eliminar_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id = $this->input->post("articulo");
            $this->Modelo_articulos->delete_articulo($id);
            $peticion = true;
            $url      = "ajax_tarticulos";
            $msg      = "Exito, Articulo eliminado correctamente";
            echo json_encode($this->funciones->resultado($peticion,$url,$msg));
        }
    }

    public function editar_articulo()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id        = $this->input->post("articulo");
            $costo     = $this->input->post("costo");
            $cantidad  = $this->input->post("cantidad");
            $descuento = $this->input->post("descuento");
            $importe   = $costo * $cantidad;

            if ($descuento <= $importe) 
            {
                $total   = $importe - $descuento;

                $data = array(
                    'cantidad_venta' => $cantidad,
                    'importe'        => $total,
                    'descuento'      => $descuento,
                );
                $this->Modelo_timbrado->up_articuloTimbrado($id,$data);

                $articulo = $this->input->post("idArticulo");
                $datos = array(
                    'descripcion' => $this->input->post("descripcion")
                );
                $this->Modelo_articulos->update_articulo($articulo,$datos);

                $peticion = true;
                $url      = "ajax_tarticulos";
                $msg      = "Exito, Descuento aplicado correctamente";
                echo json_encode($this->funciones->resultado($peticion,$url,$msg));
            }else{
                $peticion = false;
                $url      = "ajax_tarticulos";
                $msg      = "Error, descuento mayor que total";
                echo json_encode($this->funciones->resultado($peticion,$url,$msg));
            }
        }
    }

    public function ajax_precios()
    {
        if(!$this->input->is_ajax_request())
        {
         show_404();
        }else{
            $id = $this->input->post("ids");
            $data["precios"] = $this->funciones->precios($id);
            $this->load->view('admin/tfactura/ajax/ajax_precio',$data);
        }   
    }

    public function not_found()
    {
        $data = array(
            "title"     => "404 Error Pagina",
            "subtitle"  => "Error",
            "contenido" => "universal/not_found",
            "menu"      => "admin/menu_admin",
            "archivosJS"=> $this->load->view('admin/factura/archivos/archivosJS',null,true)  # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);

    }
}