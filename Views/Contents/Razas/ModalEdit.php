<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" id="FormEdit" name="FormEdit"  class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="col">
            <div class="form-group">
              <label for="">Descripcion</label><label for="" id="ob">*</label>
              <input type="text" pattern="[A-Za-z ]{3,30}" name="Raza" id="Des_edit" class="form-control" placeholder="Descripcion" minlength="3" maxlength="30" style="text-transform: uppercase;" required>
            </div>
            <div class="form-group">
              <label for="">Codigo</label><label for="" id="ob">*</label>
              <input type="text" name="Cod" id="Cod_edit" class="form-control" placeholder="Codigo" minlength="1" maxlength="11" readonly>
            </div>
            <div class="form-group">
              <label for="">Especie</label><label for="" id="ob">*</label>
              <select name="Esp" id="Esp_edit" class="form-control select-option-special w-100" style="width:100%;" required>
              <?php $this->Control('RazasController')->Select_Especies(); ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnUp" data-formulario="FormEdit" value="Update" class="btn btn-info">
            <i class="fas fa-edit"></i> Modificar
          </button>
          <button type="button" class="btn btn-secondary" onclick="document.FormEdit.reset();" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Catalogo -->
<div class="modal fade" id="ModalCatalogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catalogo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive mx-auto">
          <table id="catalogo_table2" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm catalogo-table" cellspacing="0" style="width: 100%;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Especie</th>
                <th scope="col">Estado</th>
                <th scope="col">Optiones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
