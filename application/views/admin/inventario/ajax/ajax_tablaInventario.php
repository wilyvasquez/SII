<div class="box box-primary">
  <div class="box-body table-responsive">
    <table id="tblInventario" class="table table-bordered table-striped">
      <thead>
        <tr style="background: #4C9DBD; color: white">
          <!-- <th>#</th> -->
          <th>ARTICULO</th>
          <th>CODIGO</th>
          <th>CANTIDAD</th>
          <th>COSTO</th>
          <th>COSTO PROV.</th>
          <th>CLAVE SAT</th>
          <th>ACCION</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>     
  </div>
</div>
<script type="text/javascript">
	$(function () {
	  $('#tblInventario').DataTable({
	    'paging'      : true,
	    'info'        : true,
	    'filter'      : true,
	    'stateSave'   : true,
	    'ordering'    : false,
	    "language": {
	        "sProcessing":     "Procesando...",
	        "sLengthMenu":     "Mostrar _MENU_ registros",
	        "sInfo":           "Registros del _START_ al _END_  (_TOTAL_ registros)",
	        "sInfoFiltered":   "",
	        "zeroRecords": "No se encontraron datos",
	        "infoEmpty": "No se encontraron datos",
	        "search": "Buscar",
	      "paginate": {
	        "first":      "Primero",
	        "last":       "Ultimo",
	        "next":       "Siguiente",
	        "previous":   "Anterior"
	      }
	    },
	    'processing': true,
	    'serverSide':true,
	    'ajax': {
	        "url":baseurl+"CtrInventario/getInventario",
	        "type":"POST",            
	      },
	      'columns': [
	        // {data: 'id_articulo','sClass':'dt-body-center'},
	        {data: 'articulo'},
	        {data: 'codigo_interno'},
	        {data: 'cantidad'},
	        {data: 'costo'},
	        {data: 'costop'},
	        {data: 'codigo_sat'},
	        {"orderable": true,
	          render:function(data, type, row){
	            return '<button type="button" class="btn btn-block btn-primary btn-xs" onclick="selInventario(\''+row.id_articulo+'\',\''+row.articulo+'\',\''+row.codigo_interno+'\',\''+row.cantidad+'\',\''+row.costo+'\',\''+row.codigo_sat+'\',\''+row.descripcion+'\',\''+row.costop+'\')" data-toggle="modal" data-target=".editarInventario">Editar</button>'
	          }
	        }
	      ],
	      "order" : [[0, "asc"]],
	  });
	});
</script>