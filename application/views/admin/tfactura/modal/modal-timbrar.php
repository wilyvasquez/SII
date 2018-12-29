<div class="modal fade timbrar" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="timbrarArticulos">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;color: #393737">Timbrar Factura</h4>
            </div>
            <div class="col-md-12" style="margin-top: 20px">
              <div class="alert  alert-dismissible fade in" role="alert" style="background-color: #118F20">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <input type="hidden" name="venta" id="venta">
                <strong style="font-weight: bold;color: #FFF"><center><i class="fa fa-warning" style="width: 20px"></i> Esta accion timbrara todos los articulos y cliente agregado anteriormente.</center></strong> 
              </div>
            </div>
            <div id="ntf-timbrado">
              
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Timbrar</button>
        </div>
      </form>
    </div>
  </div>
</div>