<div class="modal fade eliminarACotizacion" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form id="deleteArticuloCotizacion">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;color: #393737">Eliminar Articulo</h4>
            </div>
            <div class="col-md-12" style="margin-top: 20px">
              <div class="alert  alert-dismissible fade in" role="alert" style="background-color: #F7BFB0">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong style="font-weight: bold;color: #DC1D0D"><center><i class="fa fa-warning" style="width: 30px"></i> Esta accion eliminara el articulo de esta relacion.</center></strong> 
                <input type="hidden" name="midc" id="midc">
              </div>
            </div>
          </div>
          <div id="ntf-dcotizacion"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btn-eliminar" style="background-color:#DC1D0D;border: 0">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>