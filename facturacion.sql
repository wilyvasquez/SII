CREATE TABLE tabla_compras
(
    id_tcompras int not null AUTO_INCREMENT,
    articulo varchar (100),
    costo double,
    costo_proveedor double,
    codigo varchar(30),
    clave varchar(20),
    cantidad int,
    unidad varchar(30),
    tipo varchar(30),
    descripcion text,
    PRIMARY KEY (id_tcompras)
);

CREATE TABLE clave_sat
(
    id_clave int not null AUTO_INCREMENT,
    c_ClaveUnidad varchar (10),
    clave varchar (100),
    alta_clave datetime,
    PRIMARY KEY (id_clave)
);

CREATE TABLE relacion_uuid
(
    id_relacion int not null AUTO_INCREMENT,
    uuid varchar (100),
    t_relacion varchar (100),
    ref_preventa int,
    PRIMARY KEY (id_relacion)
);

CREATE TABLE relacion_docto
(
    id_rdocto int not null AUTO_INCREMENT,
    uuid varchar (100),
    parcialidad int,
    monto double,
    ref_preventa int,
    PRIMARY KEY (id_rdocto)
);

CREATE TABLE sucursal
(
    id_sucursal int not null AUTO_INCREMENT,
    razon_social varchar (100),
    sucursal varchar (20),
    rfc  varchar (50),
    direccion  text,
    telefono  varchar (60),
    correo  varchar(50),
    estatus_sucursal varchar(20)
    PRIMARY KEY (id_sucursal)
);

CREATE TABLE producto_facturado
(
    id_facturado serial not null AUTO_INCREMENT,
    condicion_pago varchar (50),
    metodo_pago varchar(50),
    forma_pago varchar(50),
    serie_folio varchar(20),
    regimen_fiscal varchar(80),
    uso_cfdi varchar(50),
    tipo_comprobante varchar(50),
    uuid varchar(50),
    ref_cliente  int,
    PRIMARY KEY (id_facturado)
);

CREATE TABLE articulo_facturado
(
    id_pfacturado serial not null AUTO_INCREMENT,
    cve_producto varchar (20),
    articulo varchar (50),
    cantidad  int,
    cve_unidad  varchar (10),
    descripcion text,
    valor_unitario double,
    importe double,
    descuento double,
    ref_pfacturado int,
    PRIMARY KEY (id_pfacturado)
);

CREATE TABLE cliente
(
    id_cliente int not null AUTO_INCREMENT,
    cliente varchar 100,
    rfc varchar 15,
    uso_cfdi  varchar 50,
    telefono  varchar 15,
    correo  varchar 60,
    direccion  text,
    PRIMARY KEY (id_cliente)
);

CREATE TABLE forma_pago
(
    id_forma int not null AUTO_INCREMENT,
    forma varchar 50,
    alta_forma datetime,
    PRIMARY KEY (id_forma)
);

CREATE TABLE metodo_pago
(
    id_metodo serial not null AUTO_INCREMENT,
    c_metodoPago varchar (10),
    metodo varchar (50),
    alta_metodo datetime,
    PRIMARY KEY (id_forma)
);

CREATE TABLE uso_cfdi
(
    id_usocfdi serial not null AUTO_INCREMENT,
    c_usoCFDI varchar (10),
    uso_cfdi varchar (50),
    alta_metodo datetime,
    PRIMARY KEY (id_usocfdi)
);

CREATE TABLE factura
(
    id_factura serial not null AUTO_INCREMENT,
    uuid varchar (100),
    pdf varchar (200),
    xml varchar (200),
    fecha_timbrado datetime,
    certificado varchar (200),
    serie_folio varchar (20),
    tipo_comprobante varchar (20),
    razon_social varchar (200),
    ref_cliente int,
    PRIMARY KEY (id_factura)
);

CREATE TABLE tipo_relacion
(
    id_trelacion serial not null AUTO_INCREMENT,
    c_tipoRelacion int,
    tipo_relacion varchar (100),
    PRIMARY KEY (id_trelacion)
);

CREATE TABLE pre_venta
(
    id_preventa serial not null AUTO_INCREMENT,
    codigo_preventa varchar(20),
    alta_preventa datetime,
    estatus_preventa varchar(10),
    ref_cliente int,
    ref_forma_pago int,
    ref_metodo_pago int,
    ref_uso_cfdi int,
    PRIMARY KEY (id_preventa)
);

CREATE TABLE articulo_preventa
(
    id_apreventa serial not null AUTO_INCREMENT,
    cantida int,
    alta_apreventa datetime,
    descuento varchar(10),
    ref_articulo int,
    ref_cliente int,
    ref_pre_venta int,
    PRIMARY KEY (id_apreventa)
);

CREATE TABLE articulo
(
    id_articulo serial not null AUTO_INCREMENT,
    articulo varchar(100),
    descripcion text,
    costo double,
    precio_lista double,
    clave_sat varchar(50),
    codigo_interno varchar(50),
    cantidad int,
    estatus_articulo varchar(50),
    ref_marca int,
    ref_fabricante int,
    ref_linea int,
    ref_sucursal int,
    PRIMARY KEY (id_articulo)
);

CREATE TABLE marca
(
    id_marca serial not null AUTO_INCREMENT,
    marca varchar(100),
    nombre varchar(100),
    descripcion text,
    PRIMARY KEY (id_marca)
);

CREATE TABLE linea
(
    id_linea serial not null AUTO_INCREMENT,
    linea varchar(100),
    nombre varchar(100),
    descripcion text,
    PRIMARY KEY (id_linea)
);

CREATE TABLE fabricante
(
    id_fabricante serial not null AUTO_INCREMENT,
    fabricante varchar(100),
    nombre varchar(100),
    descripcion text,
    PRIMARY KEY (id_fabricante)
);

CREATE TABLE documento
(
    id_docto serial not null AUTO_INCREMENT,
    uuid varchar (100),
    pdf varchar (200),
    xml varchar (200),
    fecha_timbrado datetime,
    certificado varchar (200),
    serie_folio varchar (20),
    tipo_comprobante varchar (20),
    metodo_pago varchar (20),
    forma_pago varchar (20),
    tipo_docto varchar (200),
    ref_cliente int,
    PRIMARY KEY (id_docto)
);


CREATE TABLE factura_docto
(
	id_factura_docto serial not null AUTO_INCREMENT,
	alta_referencia datetime,
	tipo_relacion varchar(20),
	ref_docto int,
	ref_factura int,
	PRIMARY KEY (id_factura_docto)
)

CREATE TABLE relacion_factura
(
	id_rfactura serial not null AUTO_INCREMENT,
	factura_pader int,
	factura_hijo int,
	c_tipoRelacion varchar(5),
	PRIMARY KEY (id_rfactura)
)

CREATE TABLE folios_series
(
	id_folios serial not null AUTO_INCREMENT,
	folio_inicio int,
	serie varchar(5),
	tipo_comprobante varchar(10),
	folio_siguiente int,
	PRIMARY KEY (id_folios)
)

CREATE TABLE usuarios
(
	id_usuario serial not null AUTO_INCREMENT,
	nombre     varchar(50),
    usuario    varchar(50),
    contrasena varchar(50),
    telefono   varchar(15),
    correo     varchar(50),
    direccion  text,
    sucursal   varchar(15),
    estatus    varchar(15),
	PRIMARY KEY (id_usuario)
)

CREATE TABLE cotizacion
(
	id_cotizacion serial not null AUTO_INCREMENT,
	articulo     varchar(50),
    codigo    varchar(50),
    cantidad varchar(50),
    costo   varchar(15),
    alta_cotizacion datetime,
    ref_dcotizacion int,
	PRIMARY KEY (id_cotizacion)
)

CREATE TABLE datos_cotizacion
(
    id_dcotizacion serial not null AUTO_INCREMENT,
    cliente     varchar(80),
    num_cotizacion    varchar(50),
    alta_dcotizacion datetime,
    PRIMARY KEY (id_dcotizacion)
)


CREATE TABLE datos_facturacion
(
    id_dfacturacion serial not null AUTO_INCREMENT,
    proveedor     varchar(80),
    factura    varchar(50),
    alta_dfacturacion datetime,
    PRIMARY KEY (id_dfacturacion)
)
