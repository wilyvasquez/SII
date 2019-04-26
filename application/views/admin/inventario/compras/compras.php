<script language="javascript">
function PulsarTecla(event)
{
    tecla = event.keyCode;
    if(tecla==118)
    {
      console.log("modal");
      $("#cerrarInventario").modal();
    }
}
window.onkeydown=PulsarTecla;
</script>
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Articulo <strong>(F7 Cerrar)</strong></h3>
      </div>
      <form role="form" id="addCompras">
        <div class="box-body">
          <div class="form-group">
            <label for="articulo">Articulo</label>
            <!-- <input type="text" class="form-control" name="articulo" placeholder="Nombre del articulo" required> -->
            <select class="form-control  select2" style="width: 100%" name="articulo" id="articulo" onchange="datosArticulo()" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
        	<?php if (!empty($articulos)) {
               foreach ($articulos ->result() as $articulo) { ?>
               <option value="<?= $articulo->id_articulo ?>"><?= $articulo->codigo_interno ?> - <?= $articulo->articulo ?></option>
            <?php } } ?>
            </select>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="costo">Costo</label>
              <input type="number" class="form-control" name="costo" id="costo" step="any" placeholder="Costo Cliente" required>
            </div>
            <div class="form-group col-md-6">
              <label for="costoProv">Costo Prov.</label>
              <input type="number" class="form-control" name="costoProv" id="costoProv" step="any" placeholder="Costo Proveedor" required>
            </div>
          </div>
          <div class="form-group">
            <label for="codigoi">Codigo</label>
            <input type="text" class="form-control" name="codigoi" id="codigoi" placeholder="Codigo Interno" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>Clave (SAT)</label>
              <input type="text" class="form-control" name="clave" id="clave" placeholder="Clave del SAT" minlength="8" maxlength="8" required>
            </div>
            <div class="form-group col-md-6">
              <label for="cantidad">Cantidad</label>
              <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" min="0" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>Unidad</label>
              <input type="text" class="form-control" name="unidad" id="unidad" placeholder="Clave del SAT">
            </div>
            <div class="form-group col-md-6">
              <label>Tipo</label>
              <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Clave del SAT" required>
            </div>             
          </div>
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" rows="3" placeholder="Descripcion ..." name="descripcion" id="descripcion" required></textarea>
          </div>
          <!-- <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" class="form-control">
            <p class="help-block">Formato jpg, png, maximo 514 kb.</p>
          </div> -->
          <div id="ntf-cliente"></div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary" id="btn-guardarInventario">Agregar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8" id="ntf-inventario">
    <?= $tabla ?>
  </div>
</div>
<div>
  <div class="modal fade" id="cerrarInventario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #4C9DBD; color: white">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Cerrar Compra</h4>
        </div>
        <form role="form" id="cerrarInventarioDatos">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="mproveedor" style="font-weight: normal;">Proveedor</label>
                <input type="text" class="form-control" id="mproveedor" name="mproveedor" required>
              </div>
              <div class="form-group">
                <label for="mfactura" style="font-weight: normal;">Factura</label>
                <input type="text" class="form-control" id="mfactura" name="mfactura" required>
              </div>
              <div id="ntf-cIventario"></div>
            </div>
          </div>
          <div class="modal-footer">
              <label class="switch">
            <input type="checkbox" class="success" id="activo" name="activo">
            <span class="slider round"></span>
          </label>
              <button type="submit" class="btn btn-primary" id="btn-gcotizacion">Generar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>