<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">CFDIs Relacionados</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="form-horizontal">
    <div class="box-body">
      <div class="form-group">
        <label for="relacionar" class="col-sm-4 control-label" style="font-weight: normal;"><font color="red">*</font> Relacionar UUID</label>

        <div class="col-sm-8">
          <select class="form-control select2 input-sm" style="width: 100%;" name="relacionar" id="relacionar" onchange="uuid_relacion()" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
            <option value="NO">NO</option>
            <option value="SI">SI</option>
          </select>
        </div>
      </div>
      <hr>
      <div id="uuid_relacion"></div>

      <div class="form-group">
        <div class="col-md-4"></div>
      </div>
      <div class="row">
        <div class="col-sm-offset-4 col-sm-8" id="ntf-error"></div>
      </div>      
    </div>
    <div class="box-footer">
      <button type="button" class="btn btn-primary btn-sm pull-right" onclick="agregar_relacion()" id="btn-relacion" disabled>Agregar UUID</button>
    </div>
  </div>
</div>  