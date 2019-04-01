<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'welcome';
$route['404_override']         = 'CtrUniversal/not_found';
$route['translate_uri_dashes'] = FALSE;

$route['inventario']           = 'CtrInventario/inventario';
$route['altaXml']              = 'CtrInventario/alta_xml';
$route['ifacturas']            = 'CtrInventario/ifacturas';
$route['hinventario']          = 'CtrInventario/hinventario';
$route['sucursal']             = 'CtrSucursal/sucursal';
$route['cliente']              = 'CtrClientes/cliente';
$route['usuario']              = 'CtrUsuarios/usuarios';
$route['folios']               = 'CtrFactura/folios';

$route['pcliente/(:num)']      = 'CtrClientes/perfil_cliente/$1';

$route['prefactura']           = 'CtrFactura/pre_factura';
$route['factura/(:num)']       = 'CtrFactura/factura/$1';
$route['descarga/(:any)']      = 'CtrFactura/descarga/$1';
$route['xml/(:any)']           = 'CtrFactura/descargas_xml/$1';
$route['proceso']              = 'CtrFactura/facturas_proceso';
$route['infoFactura/(:num)']   = 'CtrFactura/info_procesoFacturas/$1';

$route['prencredito']          = 'CtrNotaCredito/pre_factura';
$route['ncredito/(:num)']      = 'CtrNotaCredito/nota_credito/$1';
$route['gcredito/(:num)']      = 'CtrNotaCredito/generar_notasCredito/$1';

# recibos de pago
$route['prepagos']             = 'CtrRecibosPago/pre_pagos';
$route['rpagos/(:num)']        = 'CtrRecibosPago/recibo_pagos/$1';

$route['home']                 = 'CtrUniversal/principal';
$route['login']                = 'CtrLogin/login';
$route['timbrado']             = 'CtrUniversal/get_allTimbrado';
$route['gtimbrado']            = 'CtrUniversal/global_rfactura';
$route['dfactura/(:num)']      = 'CtrUniversal/datos_factura/$1';

$route['cotizacion']      	   = 'CtrCotizacion';
$route['dcotizacion']      	   = 'CtrReportes/reporte';
$route['chistorial']      	   = 'CtrCotizacion/historial_cotizacion';
$route['rdfacturas/(:num)']	   = 'CtrReportes/reporte_inventario/$1';

$route['cortes']			   = 'CtrCortes/cortes';
$route['corteCaja/(:any)']     = 'CtrReportes/corte_caja/$1';

$route['session']              = 'CtrLogin/verificar';
$route['cerrar']               = 'CtrLogin/logout_ci';
