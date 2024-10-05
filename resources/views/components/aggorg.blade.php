
  <div class="modal" id="modalOrg" tabindex="-1">

  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Organismo</h5>
        <button type="button" class="btn-close2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
                <form action="{{ url('/api/organismos') }}" method="POST">
                        @csrf
                        <div class="level-o">
                          <img src='{{asset("images/escudo.png")}}' alt="">
                        </div>
                      <div class="row gy-2 gx-3 align-items-center">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="nombre">Nombre del Organismo</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" required>
                          </div>
                        </div>
                      </div>
                      <div class="row gy-2 gx-3 mt-2 align-items-center">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="responsable">Responsable</label>
                              <input type="text" class="form-control" id="responsable" name="responsable" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="telefono">Telefono</label>
                              <input type="text" class="form-control" id="telefono" name="telefono" required>
                          </div>
                        </div>
                      </div>                        
                </form>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn-guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>