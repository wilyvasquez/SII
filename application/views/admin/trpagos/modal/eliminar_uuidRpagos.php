<div class="modal fade deleteuuid" id="modaldelete" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="deleteuuidrpagos">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;color: #393737">Eliminar UUID</h4>
            </div>
            <div class="col-md-12" style="margin-top: 20px">
              <div class="alert  alert-dismissible fade in" role="alert" style="background-color: #F7BFB0">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  <input type="hidden" name="uuid" id="uuid">
                  <input type="hidden" name="ids" id="ids" value="<?= $id ?>">
                  <strong style="font-weight: bold;color: #DC1D0D"><center><i class="fa fa-warning" style="width: 20px"></i> Esta accion eliminara permanentamente este uuid de esta relacion (incluidos datos anidados).</center></strong> 
               </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" style="background-color:#DC1D0D;border: 0">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>