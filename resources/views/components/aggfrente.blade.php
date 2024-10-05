<div class="modal" id="modalFr" tabindex="-1">

  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Frente</h5>
        <button type="button" class="btn-close1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body"> 
                <form action="{{ url('/api/frentes') }}" method="POST">
                    @csrf
                    <div class="level-i">
                      <div class="row gy-2 gx-3 align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group" >
                                            <label for="coordenadas">Coordenadas</label>
                                            <input placeholder="lat-long. Ej: 9.117, -70.1" type="text" class="form-control" id="coordenadas" name="coordenadas" required>
                                        </div>
                                    </div>
                      </div>

                          <img src='{{asset("images/escudo.png")}}' alt="">

                    </div>
                    <div class="row gy-2 gx-3 align-items-center">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="municipio">Municipio</label>
                              <select class="form-control" id="municipio" name="municipio">
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="organismo">Organismo</label>
                              <select class="form-control" id="organismo" name="organismo">
                              </select>
                          </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                       
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"required></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label for="coordenadas">Coordenadas</label>
                        <input type="text" class="form-control" id="coordenadas" name="coordenadas" required>
                    </div> -->
                    

                    
                    
                </form>
                </div>
      <div class="modal-footer">
        <button type="submit" class="btn-guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>