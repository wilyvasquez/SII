<div class="row">
  <div class="col-md-6">
    <!-- Box Comment -->
    <div class="box box-widget">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="User Image">
          <span class="username"><a href="<?= base_url() ?>pcliente/<?= $clientes->id_cliente ?>"><?= $clientes->cliente ?>.</a></span>
          <span class="description">RFC - <?= $clientes->rfc ?> - <?= $clientes->alta_cliente ?> </span>          
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- <img class="img-responsive pad" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="Photo"> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3814.716022221122!2d-96.71798493515014!3d17.037593946192544!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa521aaa112a6a138!2sSuzuki+Atrum+Motors+de+Mexico!5e0!3m2!1ses!2smx!4v1552504486201" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>

      </div>
      <!-- /.box-body -->
      <div class="box-footer box-comments">
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="User Image">

          <div class="comment-text">
                <span class="username">
                  DOMICILIO
                </span><!-- /.username -->
            <?= $clientes->direccion ?>
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="User Image">

          <div class="comment-text">
            <span class="username">
              CORREO
            </span><!-- /.username -->
            <?= $clientes->correo ?>
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="User Image">

          <div class="comment-text">
            <span class="username">
              TELEFONO
            </span><!-- /.username -->
            <?= $clientes->telefono ?>
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-6">
    <!-- Box Comment -->
    <div class="box box-widget">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="User Image">
          <span class="username"><a href="#"><?= $dato->uuid ?>.</a></span>
          <span class="description">Fecha Timbrado - <?= $dato->fecha_timbrado ?></span>
        </div>
      </div>
      <!-- /.box-header -->
      <div style="padding: 10px">
        <!-- <a href="<?= base_url() ?>descarga/<?= $dato->uuid ?>" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a> -->
        <a href="<?= $dato->pdf ?>" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a>
        <!-- <a href="<?= base_url() ?>xml/<?= $dato->uuid ?>" target="blank" class="link-black text-sm" style="margin-left: 10px"><i class="fa fa-file-code-o margin-r-5"></i> XML</a> -->
        <a href="<?= $dato->xml ?>" target="blank" class="link-black text-sm" style="margin-left: 10px"><i class="fa fa-file-code-o margin-r-5"></i> XML</a>
        <ul>
          <li>Uso CFDI: <?= $dato->uso_cfdi ?></li>
          <li>Folio y Serie: <?= $dato->serie."-".$dato->folio ?></li>
        </ul>
      </div>
      <div class="box-body">
        <!-- post text -->
        <!-- <p>Far far away, behind the word mountains, far from the
          countries Vokalia and Consonantia, there live the blind
          texts. Separated they live in Bookmarksgrove right at</p>

        <p>the coast of the Semantics, a large language ocean.
          A small river named Duden flows by their place and supplies
          it with the necessary regelialia. It is a paradisematic
          country, in which roasted parts of sentences fly into
          your mouth.</p> -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer box-comments">
        <?php if (!empty($articulos)) {
          foreach ($articulos ->result() as $articulo) { ?>
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="<?= base_url()?>assets/img/user2-160x160.jpg" alt="User Image">

          <div class="comment-text">
            <span class="username">
              <?= $articulo->articulo ?>
              <span class="text-muted pull-right"><?= $dato->fecha_timbrado ?></span>
            </span><!-- /.username -->
            <ul>
              <li><strong>Descripcion: </strong><?= $articulo->descripcion ?></li>
              <li><strong>Cve Producto: </strong><?= $articulo->cve_producto ?></li>
              <li><strong>Cve Unidad: </strong><?= $articulo->cve_unidad ?></li>
              <li><strong>Valor: </strong>$ <?= number_format($articulo->valor_unitario,2) ?></li>
              <li><strong>Importe: </strong>$ <?= number_format($articulo->importe,2) ?></li> 
              <li><strong>Descuento: </strong>$ <?= number_format($articulo->descuento,2) ?></li>
            </ul>
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
        <?php } } ?>
      </div>
      <div class="box-footer">
        <?php 
          $series = $dato->serie.$dato->folio;
          if ($cancelacion == 1) { ?>
            <div class="alert alert-danger" role="alert">Documento CFDI Cancelado</div>
          <?php }else{ ?>
          <button class="btn btn-warning pull-right" onclick="selCancelarCFDI('<?= $dato->uuid ?>','<?= $series ?>','<?= $id ?>')" data-toggle="modal" data-target=".mCancelarCFDI" id="btn_cancelarCFDI">Cancelar</button>
        <?php } ?>
      </div>
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<div>
  <?= $modal ?>
</div>