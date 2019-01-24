<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Datos del Cliente</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" id="agregar_articulo">
    <div class="box-body">
      <div class="form-group">
        <label for="cliente" style="font-weight: normal;">Cliente</label>        
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" class="form-control" id="cliente" name="cliente" value="<?= $icliente->cliente ?>">
            </div>
          </div>          
        </div>
      </div>
      <div class="form-group">
       <label for="rfc" style="font-weight: normal;">RFC</label>
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-file-text-o"></i>
              </div>
              <input type="text" class="form-control" id="rfc" name="rfc" value="<?= $icliente->rfc ?>">
              <input type="hidden" id="ids" name="ids" value="<?= $id ?>" required>
              <!-- <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $icliente->id_cliente ?>" required> -->
            </div>
          </div>          
        </div>
      </div>
      <div class="form-group">
        <label for="telefono" style="font-weight: normal;">Telefono</label>        
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $icliente->telefono ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
            </div>
          </div>          
        </div>
      </div>     
      <div class="form-group">
        <label for="correo" style="font-weight: normal;">Correo</label>
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="email" class="form-control" id="correo" name="correo" value="<?= $icliente->correo ?>">
            </div>
          </div>          
        </div>
      </div>
      <div class="form-group">
        <label for="direccion" style="font-weight: normal;">Direccion</label>
        <textarea class="form-control" rows="3" placeholder="Direccion ..." id="direccion" name="direccion"><?= $icliente->direccion ?></textarea>
      </div> 
      <!-- <div id="ntf-cliente">
        
      </div> -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-articulo">Actualizar</button>
    </div>
  </form>
</div>