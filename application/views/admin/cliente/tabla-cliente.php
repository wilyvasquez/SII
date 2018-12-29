<table id="example2" class="table table-bordered table-striped">
  <thead>
  <tr style="background: #4C9DBD;color: white">
    <th>Cliente</th>
    <th>RFC</th>
    <th>Telefono</th>
    <th>Correo</th>
    <th>Acciones</th>
  </tr>
  </thead>
  <tbody>
  <?php if (!empty($clientes)) {
    foreach ($clientes ->result() as $cliente) { ?>
      <tr>
        <td><?= $cliente->cliente ?></td>
        <td><?= $cliente->rfc ?></td>
        <td><?= $cliente->telefono ?></td>
        <td><?= $cliente->correo ?></td>
        <td>
          <a href="<?= base_url() ?>pcliente/<?= $cliente->id_cliente ?>" class="btn btn-primary btn-xs">Datos</a>
        </td>
      </tr>              
  <?php } } ?>
  </tbody>
</table>