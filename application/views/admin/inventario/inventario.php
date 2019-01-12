<!-- VISTA DE INVENTARIO -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Articulo</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="addinventario">
        <div class="box-body">
          <div class="form-group">
            <label for="articulo">Nombre Articulo</label>
            <input type="text" class="form-control" name="articulo" placeholder="Nombre Articulo" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="costo">Costo</label>
              <input type="number" class="form-control" name="costo" placeholder="Costo" required>
            </div>
            <div class="form-group col-md-6">
              <label for="codigoi">Codigo interno</label>
              <input type="text" class="form-control" name="codigoi" placeholder="Codigo Interno" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>Clave</label>
              <input type="text" class="form-control" name="clave" placeholder="Nombre Articulo" minlength="8" maxlength="8" required>
              <!-- <select class="form-control select2" style="width: 100%;" name="cve_pro" data-placeholder="Selecciona" required>
                <?php if (!empty($clave)) {
                foreach ($clave ->result() as $claves) { ?>
                  <option value="<?= $claves->clave ?>"><?= $claves->c_ClaveUnidad ?> - <?= $claves->clave ?></option>
                <?php } } ?>
              </select> -->
            </div>
            <div class="form-group col-md-6">
              <label for="cantidad">Cantidad</label>
              <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required>
            </div>
          </div>
          <div class="form-group">
            <label>Unidad</label>
            <select class="form-control select2" style="width: 100%;" name="unidad" data-placeholder="Selecciona" required>
              <?php if (!empty($clave)) {
              foreach ($clave ->result() as $claves) { ?>
                <option value="<?= $claves->id_clave ?>"><?= $claves->c_ClaveUnidad ?> - <?= $claves->clave ?></option>
              <?php } } ?>
            </select>
          </div>
          <!-- <div class="form-group">
            <label>Clave SAT</label>
            <select class="form-control select2" style="width: 100%;" name="clave" data-placeholder="Selecciona" required>
                <?php if (!empty($clave)) {
                foreach ($clave ->result() as $claves) { ?>
                  <option value="<?= $claves->c_ClaveUnidad ?>"><?= $claves->c_ClaveUnidad ?> - <?= $claves->clave ?></option>
                <?php } } ?>
              </select>
          </div>     -->      
          <div class="form-group">
            <label>Marca</label>
            <div id="ajax-marca">
              <select class="form-control select2" style="width: 100%;" name="marca" data-placeholder="Selecciona" required>
                <option value="">Selecciona</option>
                  <?php if (!empty($marcas)) {
                    foreach ($marcas ->result() as $marca) { ?>
                    <option value="<?= $marca->id_marca ?>"><?= $marca->marca ?> - <?= $marca->nombre ?></option>
                  <?php } } ?>
              </select>
            </div>
            <!-- <a href="#" class="selecciona test" data-toggle="modal" data-target=".addmarca">
              <i class="fa fa-plus"></i> Registrar nueva Marca
            </a> -->
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".addmarca"><i class="fa fa-plus"></i> Registrar nueva Marca</button>
          </div>
          <div class="form-group">
            <label>Linea</label>
            <div id="ajax-linea">
              <select class="form-control select2" style="width: 100%;" name="linea" data-placeholder="Selecciona" required>
                <option value="">Selecciona</option>
                  <?php if (!empty($lineas)) {
                    foreach ($lineas ->result() as $linea) { ?>
                    <option value="<?= $linea->id_linea ?>"><?= $linea->linea ?> - <?= $linea->nombre ?></option>
                  <?php } } ?>
              </select>
            </div>
             <button style="margin-top: 2px" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".addlinea"><i class="fa fa-plus"></i> Registrar nueva linea</button>
          </div>
          <div class="form-group">
            <label>Fabricante</label>
            <div id="ajax-fabricante">
              <select class="form-control select2" style="width: 100%;" name="linea" data-placeholder="Selecciona" required>
                <option value="">Selecciona</option>
                  <?php if (!empty($fabricantes)) {
                    foreach ($fabricantes ->result() as $fabricante) { ?>
                    <option value="<?= $fabricante->id_fabricante ?>"><?= $fabricante->fabricante ?> - <?= $fabricante->rfc ?></option>
                  <?php } } ?>
              </select>
            </div>
            <button style="margin-top: 2px" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".addfabricante"><i class="fa fa-plus"></i> Registrar nuevo Fabricante</button>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" rows="3" placeholder="Descripcion ..." name="descripcion" required></textarea>
          </div>
          <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" class="form-control">
            <p class="help-block">Formato jpg, png, maximo 514 kb.</p>
          </div>
          <div id="ntf-cliente">
            
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-header">

      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Articulo</th>
            <th>Codigo Interno</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Clave SAT</th>
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($articulos)) {
          foreach ($articulos ->result() as $articulo) { ?>
          <tr>
            <td><?= $articulo->articulo ?></td>
            <td><?= $articulo->codigo_interno ?></td>
            <td><?= $articulo->cantidad ?></td>
            <td><?= $articulo->costo ?></td>
            <td><?= $articulo->clave_sat ?></td>
          </tr>
          <?php } } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<div>
  <?= $modal_f ?>
  <?= $modal_l ?>
  <?= $modal_m ?>
</div> 