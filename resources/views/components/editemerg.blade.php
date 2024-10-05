
  <div class="modal" id="editModal" tabindex="-1">
    
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Emergencia </h5>
        <button type="button" class="btn-close6" data-bs-dismiss="modal" aria-label="Close"></button>
        
      </div>
      <div class="modal-body">
         <form action="{{ url('/api/emergencias') }}" method="POST" class="row gy-2 gx-3 align-items-center">
                        @csrf
                        <div class="level">
                        
                            <div class="form-group">
                                <label for="inlineRadioOptions" class="level2"><strong>Nivel de emergencia</strong></label>
                                
                                <br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radio1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Leve</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radio2" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Normal</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input radio3" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
                                        <label class="form-check-label" for="inlineRadio3">Grave</label>
                                    </div>
                                                                
                                </div>
                                <img src='{{asset("images/escudo.png")}}' alt="">
                            </div>
                         
                            <div class="row gy-2 gx-3 align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group" >
                                            <label for="coordenadas">Coordenadas</label>
                                            <input placeholder="lat-long. Ej: 9.117, -70.1" style="margin-right:2rem;"type="text" class="form-control" id="coordenadas" name="coordenadas" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="municipio">Municipios</label>
                                            <select class="form-control" id="municipios" name="municipio">
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parroquia">Parroquia</label>
                                        <select class="form-control" id="parroquia" name="parroquia">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="situacion">Situacion</label>
                                    <input type="text" class="form-control" id="situacion" name="situacion" required>
                                </div>      
                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="causas">Causas</label>
                                <input type="text" class="form-control" id="causas" name="causas" required>
                            </div>
                        </div>


                        <div class="col-md-3" >
                            <div class="form-group">
                                <label for="familias_afectadas">Familias Afectadas</label>
                                <input type="text" class="form-control" id="familias_afectadas" name="familias_afectadas"
                                    required>
                            </div>
                        </div>  
                        <div class="col-md-3"  >
                            <div class="form-group">
                                <label for="personas_afectadas">Personas Afectadas</label>
                                <input type="text" class="form-control" id="personas_afectadas" name="personas_afectadas"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-2" >
                            <div class="form-group">
                                <label for="heridos">Heridos</label>
                                <input type="text" class="form-control" id="heridos" name="heridos" required>
                            </div>
                        </div>

                        <div class="col-md-2" >
                            <div class="form-group">
                                <label for="fallecidos">Fallecidos</label>
                                <input type="text" class="form-control" id="fallecidos" name="fallecidos" required>
                            </div>
                        </div>

                        <div class="col-md-2" >
                            <div class="form-group">
                                <label for="desaparecidos">Desaparecidos</label>
                                <input type="text" class="form-control" id="desaparecidos" name="desaparecidos" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estructura">Estructura</label>
                                <select class="form-control" id="estructura" name="estructura">
                                </select>
                            </div>
                        </div>                      

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsables">Responsable</label>
                                <select class="form-control" id="responsables" name="responsables">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sector">Sector</label>
                                <textarea class="form-control" id="sector" name="sector" rows="3"required></textarea>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"required></textarea>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="img">Seleccionar imagen</label>
                                <input type="file" class="form-control" id="img" name="img">
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

