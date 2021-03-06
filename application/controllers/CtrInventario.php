<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrInventario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Facturapi');
        $this->load->library('Funciones');
        $this->load->library('Not_found');
        $this->load->library('Permisos');
        $this->load->library('Ireporte');
        
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
            "inventario"  => "active",
            "title"       => "Articulos",
            "subtitle"    => "Alta de inventario",
            "contenido"   => "admin/inventario/inventario",
            "menu"        => $pmenu,
            "tcreditos"   => $this->facturapi->consultarCreditos(),
            "modal_f"     => $this->load->view('admin/inventario/modal/modal-fabricante',null,true), # AGREGAR NUEVO FABRICANTE
            "modal_l"     => $this->load->view('admin/inventario/modal/modal-linea',null,true), # AGREGAR NUEVA LINEA
            "modal_m"     => $this->load->view('admin/inventario/modal/modal-marca',null,true), # AGREGAR NUNEVA MARCA
            "modal_i"     => $this->load->view('admin/inventario/modal/modal-inventario',null,true), # AGREGAR NUNEVA MARCA
            "modal_c"     => $this->load->view('admin/inventario/modal/modal_cerrar_inventario',null,true), # AGREGAR NUNEVA MARCA
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
            "clave"       => $this->Modelo_sat->get_claveSat(),
            "articulos"   => $this->Modelo_articulos->get_articulos(),
            "marcas"      => $this->Modelo_inventario->get_marca(),
            "lineas"      => $this->Modelo_inventario->get_linea(),
            "fabricantes" => $this->Modelo_inventario->get_fabricante(),
            "tabla"       => $this->load->view('admin/inventario/tabla_inventario',null,true),
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
            "subtitle"    => "Total Inventario",
            "contenido"   => "admin/inventario/tablaInventario",
            "modal_i"     => $this->load->view('admin/inventario/modal/modal-inventario',null,true), # AGREGAR NUNEVA MARCA
            "menu"        => $pmenu,
            "tcreditos"   => $this->facturapi->consultarCreditos(),
            // "articulos"   => $this->Modelo_articulos->get_articulos(),
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function ifacturas()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "tfacturas"   => "active",
            "idfactura"   => "active",
            "title"       => "Facturas",
            "subtitle"    => "Facturas Inventario",
            "contenido"   => "admin/inventario/tabla_ifacturas",
            "menu"        => $pmenu,
            "tcreditos"   => $this->facturapi->consultarCreditos(),
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
                    'costo_proveedor'  => $this->input->post("costoProv"),
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
                $this->load->view('admin/inventario/ajax/ajax_tablaInventario',null);
                // echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
            }else{
                $msg      = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
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
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
                }
            }else{
                $msg      = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
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
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
                }
            }else{
                $msg      = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
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

    public function get_datosArticulo()
    {
        if(!$this->input->is_ajax_request())
        {
            $this->not_found->not_found();
        }else{
            $id     = $this->input->post("id");
            $resul  = $this->Modelo_articulos->obtener_articulo($id);
            echo json_encode(
                $result = array(
                    'costo'        => $resul->costo,
                    'costo_provee' => $resul->costo_proveedor,
                    'codigo'       => $resul->codigo_interno,
                    'clave'        => $resul->clave_sat,
                    'cantidad'     => $resul->cantidad,
                    'unidad'       => $resul->unidad,
                    'tipo'         => $resul->tipo,
                    'descripcion'  => $resul->descripcion
                )
            );
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
                    echo json_encode($this->funciones->resultado($peticion,$url,$msg,null));
                }
            }else{
                $msg = "Error, No se han actualizado los datos";
                echo json_encode($this->funciones->resultado($peticion = false,$url = null,$msg,null));
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
                'articulo'        => $this->input->post("marticulo"),
                'codigo_interno'  => $this->input->post("mcodigo"),
                'cantidad'        => $this->input->post("mcantidad"),
                'costo'           => $this->input->post("mcosto"),
                'costo_proveedor' => $this->input->post("mcostop"),
                'codigo_sat'      => $this->input->post("msat"),
                'descripcion'     => $this->input->post("mtextos")
            );
            $peticion = $this->Modelo_articulos->update_articulo($id,$data);
            if ($peticion) {
                // $this->load->view('admin/inventario/ajax/ajax_tablaInventario',null);
                $msg = "Exito, Actualizado correctamente";
                echo json_encode($this->funciones->resultado($peticion, $url = "", $msg,null));
            }else{
                $msg = "Error, Accion no ejecutada";
                echo json_encode($this->funciones->resultado($peticion, $url = "", $msg,null));
            }
        }
    }

    public function compras()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "rinventario" => "active",
            "compras"     => "active",
            "title"       => "Articulos",
            "subtitle"    => "Alta de inventario",
            "contenido"   => "admin/inventario/compras/compras",
            "menu"        => $pmenu,
            "tcreditos"   => $this->facturapi->consultarCreditos(),
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
            "acompras"    => $this->Modelo_articulos->get_compras(),
            "articulos"   => $this->Modelo_articulos->get_articulos(),
            // "marcas"      => $this->Modelo_inventario->get_marca(),
            // "lineas"      => $this->Modelo_inventario->get_linea(),
            // "fabricantes" => $this->Modelo_inventario->get_fabricante(),
            // "tabla"       => $this->load->view('admin/inventario/compras/tabla_compras',null,true),
        );
        $data["tabla"] = $this->load->view('admin/inventario/compras/tabla_compras',$data,true);
        $this->load->view('universal/plantilla',$data);
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
            $array['costop']         = $row['costo_proveedor'];
            $array['codigo_sat']     = $row['codigo_sat'];
            $array['descripcion']    = $row['descripcion'];

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

    public function getTablaInventario()
    {
        $start      = $this->input->post("start");
        $length     = $this->input->post("length");
        $search     = $this->input->post("search")['value'];
        
        $result     = $this->Modelo_inventario->get_inventarioTabla($start,$length,$search);
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
            $array['costop']         = $row['costo_proveedor'];
            $array['codigo_sat']     = $row['codigo_sat'];
            $array['descripcion']    = $row['descripcion'];

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

    public function getIFacturas()
    {
        $start      = $this->input->post("start");
        $length     = $this->input->post("length");
        $search     = $this->input->post("search")['value'];
        
        $result     = $this->Modelo_inventario->get_ifacturas($start,$length,$search);
        $resultado  = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();
        foreach ($resultado->result_array() as $row) {
            $array = array();
            $array['id_dfacturacion']   = $row['id_dfacturacion'];
            $array['proveedor']         = $row['proveedor'];
            $array['factura']           = $row['factura'];
            $array['alta_dfacturacion'] = $row['alta_dfacturacion'];
            $array['pdf']               = $row['pdf'];

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

    public function cerrar_dinventario()
    {
        if ($this->input->post("activo") == "on") 
        {
            $articulos = $this->Modelo_articulos->get_articulosCompra();
            if (!empty($articulos)) {
                $data = array(
                    'proveedor'         => $this->input->post("mproveedor"),
                    'factura'           => $this->input->post("mfactura"),
                    'alta_dfacturacion' => date("Y-m-d H:i:s")
                );
                $id = $this->Modelo_articulos->insertarDatosFactura($data);
                foreach ($articulos ->result() as $articulo) 
                { 
                    $codigo   = $articulo->codigo;
                    $producto = $this->Modelo_articulos->buscarArticulo($codigo);
                    # SI EL ARTICULO YA EXISTE ACTUALIZA EL INVENTARIO
                    if (!empty($producto)) {
                       // $id_articulo = $producto->id_articulo;
                       $enviar = array(
                            'cantidad'         => $articulo->cantidad + $producto->cantidad, 
                            'descripcion'      => $articulo->descripcion,
                            'costo_proveedor'  => $articulo->costo_proveedor,
                            'desc_proveedor'   => 0,
                            'estatus_articulo' => "Activo",
                            'tipo'             => "default",
                        );
                        $peticion = $this->Modelo_articulos->update_articulo($producto->id_articulo,$enviar);
                    }
                }
                # FUNCION DONDE GENERA EL PDF
                $nombre = $this->ireporte->reporte_compra($id,$articulos);
                $subir = array(
                    'pdf' => $nombre, 
                );
                $peticion = $this->Modelo_articulos->updateDatosFactura($subir,$id);
                $this->Modelo_articulos->delate_compras();

                if ($peticion) {
                    $url  = "<a href='spdf/".$nombre."' target='_blank'><u>Descargar factura</u></a>";
                    $msg  = $id;
                    echo json_encode($this->funciones->resultado($peticion, $url, $msg, 1));
                }
            }else{
                $url  = "";
                $msg  = "Error, sin articulos";
                echo json_encode($this->funciones->resultado($peticion = false, $url, $msg, 0));
            }
        }else{
            $url  = "";
            $msg  = "Error, verificar datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url, $msg, 0));
        }
    }

    public function alta_xml()
    {
        $pmenu = $this->permisos->menu();
        $data = array(
            "rinventario" => "active",
            "axml"        => "active",
            "title"       => "Facturas",
            "subtitle"    => "Facturas Inventario",
            "contenido"   => "admin/inventario/alta_xml",
            "menu"        => $pmenu,
            "tcreditos"   => $this->facturapi->consultarCreditos(),
            "modal_i"     => $this->load->view('admin/inventario/modal/modal-inventario',null,true), # AGREGAR NUNEVA MARCA
            "modal_c"     => $this->load->view('admin/inventario/modal/modal_cerrar_inventario',null,true), # AGREGAR NUNEVA MARCA
            "tabla_xml"   => $this->load->view('admin/inventario/tabla_subidaXML',null,true), # AGREGAR NUNEVA MARCA
            "articulos"   => $this->Modelo_articulos->get_articulos(),
            "archivosJS"  => $this->load->view('admin/factura/archivos/archivosJS',null,true),  # ARCHIVOS JS UTILIZADOS
            // "tabla"       => $this->load->view('admin/inventario/tabla_inventario',null,true),
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function subir_xml()
    {
        if (!empty($_FILES["file"])) {
            if ($_FILES["file"]["error"] > 0 ){

            } else {
                $permitidos = array("text/xml");
                $limite_kb = 1000;
                if (in_array($_FILES['file']['type'], $permitidos) && $_FILES['file']['size'] <= $limite_kb * 1024){
                    $file = "assets/xml/".$_FILES['file']['name'];

                    if (!file_exists($file)){

                        $file = @move_uploaded_file($_FILES["file"]["tmp_name"], $file);

                        if ($file){
                            $nombre = $_FILES['file']['name'];
                            $xml    = base_url().'assets/xml/'.$nombre;
                            $tipo   = $this->input->post("tipo");
                            $this->xml_prueba($xml,$tipo);
                            unlink('assets/xml/'.$nombre);
                        }
                    }
                } 
            } 
        }
    }

    public function xml_prueba($xml,$tipo)
    {
        $xml = simplexml_load_file($xml);
        $ns  = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $xml->registerXPathNamespace('t', $ns['tfd']);
         
        //EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA  
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){ 
            // echo "<br />";
            // echo $cfdiComprobante['Serie']; 
            // echo "<br />"; 
            // echo $cfdiComprobante['Folio']; 
            // echo "<br />"; 
            $serie   = $cfdiComprobante['Serie'];
            $folio   = $cfdiComprobante['Folio'];
            $guion = "";
            if (!empty($serie)) {
                $guion = "-";
            }
            $factura = $serie.$guion.$folio;
        } 
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){ 
           // echo $Emisor['Rfc']; 
           // echo "<br />"; 
           $nombre = $Emisor['Nombre']; 
           // echo "<br />"; 
        }

        $datos = array(
            'proveedor'         => $nombre,
            'factura'           => $factura,
            'alta_dfacturacion' => date("Y-m-d H:i:s")
        );
        $id = $this->Modelo_articulos->insertarDatosFactura($datos);

        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto)
        { 
            $descuento  = 0;
            $Concepto['Descuento'];
            if (!empty($Concepto['Descuento'])) {
                $descuento = $Concepto['Descuento'];
            }
            $codigo   = $Concepto['NoIdentificacion'];
            $producto = $this->Modelo_articulos->buscarArticulo($codigo);
            # SI EL ARTICULO YA EXISTE ACTUALIZA EL INVENTARIO
            if (!empty($producto)) {
               $id_articulo = $producto->id_articulo;
               $enviar = array(
                    'cantidad'         => $Concepto['Cantidad'] + $producto->cantidad, 
                    'descripcion'      => $Concepto['Descripcion'],
                    'costo_proveedor'  => $Concepto['ValorUnitario'],
                    'desc_proveedor'   => $descuento,
                    'estatus_articulo' => "Activo",
                    'tipo'             => $tipo,
                );
                $peticion = $this->Modelo_articulos->update_articulo($id_articulo,$enviar);
            }else{
                $data = array(
                    'codigo_sat'       => $Concepto['ClaveProdServ'],
                    'articulo'         => $Concepto['Descripcion'], 
                    'tipo'             => $tipo,
                    'descripcion'      => $Concepto['Descripcion'],
                    'costo'            => 0,
                    'costo_proveedor'  => $Concepto['ValorUnitario'],
                    'desc_proveedor'   => $descuento,
                    'unidad'           => $Concepto['Unidad'],
                    'clave_sat'        => $Concepto['ClaveUnidad'],
                    'codigo_interno'   => $codigo,
                    'cantidad'         => $Concepto['Cantidad'],
                    'ref_dfacturacion' => $id,
                    'estatus_articulo' => "Activo"
                );
                $peticion = $this->Modelo_inventario->put_inventario($data);
            }
        } 
        if ($peticion) {

            $nombre = $this->ireporte->reporte($id,$xml);
            $subir = array(
                'pdf' => $nombre, 
            );
            $this->Modelo_articulos->updateDatosFactura($subir,$id);
            // echo "<a href='spdf/".$nombre."' target='_blank'><u>Descargar comprobante</u></a>";
            $json_data = array(
                'descarga' => "<a href='spdf/".$nombre."' target='_blank'><u>Descargar comprobante</u></a>", 
                'tabla'    => $this->load->view('admin/inventario/ajax/ajax_tablaInventario',null,true),
            );
            echo json_encode($json_data);
        }else{
            $json_data = array(
                'descarga' => '<div class="alert alert-danger" role="alert">Error de XML, datos no subidos</div>', 
                'tabla'    => $this->load->view('admin/inventario/ajax/ajax_tablaInventario',null,true),
            );
            echo json_encode($json_data);            
        }
    }

    public function agregar_compra()
    {
        $data = array(
            "articulo"        => $this->input->post("articulo"),
            "costo"           => $this->input->post("costo"),
            "costo_proveedor" => $this->input->post("costoProv"),
            "codigo"          => $this->input->post("codigoi"),
            "clave"           => $this->input->post("clave"),
            "cantidad"        => $this->input->post("cantidad"),
            "unidad"          => $this->input->post("unidad"),
            "tipo"            => $this->input->post("tipo"),
            "descripcion"     => $this->input->post("descripcion"),
        );
        $id               = $this->Modelo_articulos->insertar_compra($data);
        $data["acompras"] = $this->Modelo_articulos->get_articulosCompra();
        $this->load->view('admin/inventario/compras/ajax/ajax_tablaCompras',$data);
    }
}