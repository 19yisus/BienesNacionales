<div class="card">
  <div class="card-header">
    <h3 class="card-title">Clasificacion</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre de la Clasificacion</th>
          <th>Nº bienes con esta clasificacion</th>
          <th>Categoria</th>
          
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $con['cla_cod']; ?></td>
          <td><?php echo $con['cla_des']; ?></td>
          <td><?php echo $con2["total"]; ?></td>
          <td><?php echo $con['cat_des']; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>