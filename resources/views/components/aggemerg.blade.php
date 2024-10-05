<div class="form-group">
  <label for="status" class="level2"><strong>Nivel de emergencia</strong></label>

  <br>

  <div class="form-check form-check-inline">
    <input class="form-check-input radio1" type="radio" name="status" id="status" value="1">
    <label class="form-check-label" for="status">Leve</label>
  </div>

  <div class="form-check form-check-inline">
    <input class="form-check-input radio2" type="radio" name="status" id="status" value="2">
    <label class="form-check-label" for="status">Grave</label>
  </div>

  <div class="form-check form-check-inline">
    <input class="form-check-input radio3" type="radio" name="status" id="status" value="3">

    <label class="form-check-label" for="status">Urgente</label>
  </div>

</div>

<div class="row gy-2 gx-3 align-items-center">
  <div class="col-md-4">
    <div class="form-group">
      <label for="coordenadas">Coordenadas</label>
      <input placeholder="lat-long. Ej: 9.117, -70.1" style="margin-right:2rem;" type="text" class="form-control"
        id="coordenadas" name="coordenadas" required>
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


<div class="col-md-3">
  <div class="form-group">
    <label for="familias_afectadas">Familias Afectadas</label>
    <input type="text" class="form-control" id="familias_afectadas" name="familias_afectadas" required>
  </div>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label for="personas_afectadas">Personas Afectadas</label>
    <input type="text" class="form-control" id="personas_afectadas" name="personas_afectadas" required>
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    <label for="heridos">Heridos</label>
    <input type="text" class="form-control" id="heridos" name="heridos" required>
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    <label for="fallecidos">Fallecidos</label>
    <input type="text" class="form-control" id="fallecidos" name="fallecidos" required>
  </div>
</div>

<div class="col-md-2">
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
    <label for="frentes">Frente</label>
    <select class="form-control" id="frente" name="frente">
    </select>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label for="sector">Sector</label>
    <textarea class="form-control" id="sector" name="sector" rows="3" required></textarea>

  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label for="descripcion">Descripcion</label>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>

  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label for="fecha">Fecha</label>
    <input type="date" class="form-control" id="fecha" name="fecha" required>
  </div>
</div>

<div class="col-md-6" id="div-img">
  <div class="form-group">
    <label for="img">Seleccionar imagen</label>
    <input type="file" multiple name="img[]">
  </div>
</div>
<button type="submit" class="btn-guardar" id="btn-guardar">Guardar</button>

<script>
  fetch('/api/organismos', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      const selectElement = document.getElementById('organismo');
      const selectElement2 = document.getElementById('responsables');

      data.data.forEach(element => {
        const option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.nombre;
        selectElement.appendChild(option);

      });

      data.data.forEach(element => {
        const option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.responsable;
        selectElement2.appendChild(option);

      });
    })
    .catch(error => console.error('Error:', error));

</script>
<script>
  fetch('/api/frentes', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      const selectElement = document.getElementById('frente');
      data.data.forEach(element => {
        const option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.descripcion
        selectElement.appendChild(option);
      });
    })
    .catch(error => console.error('Error:', error));

</script>

<script>
  fetch('/api/municipios', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      const selectElement = document.getElementById('municipio');
      const selectElement2 = document.getElementById('municipios');


      data.data.forEach(element => {
        const option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.descripcion;
        selectElement.appendChild(option);

      });

      data.data.forEach(element => {
        const option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.descripcion;
        selectElement2.appendChild(option);

      });
    })
    .catch(error => console.error('Error:', error));

</script>


</script>

<script>
  fetch('/api/estructuras', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      const selectElement = document.getElementById('estructura');


      data.data.forEach(element => {
        const option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.tipo_estructura;
        selectElement.appendChild(option);

      });

    })
    .catch(error => console.error('Error:', error));

</script>

<script>
  const municipio = document.getElementById('municipios');
  municipio.addEventListener('change', () => {

    const selectedMunicipioId = municipio.value;
    fetch(`/api/parroquias/${selectedMunicipioId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        const selectElement = document.getElementById('parroquia');
        selectElement.innerHTML = '';
        data.data.forEach(element => {
          const option = document.createElement('option');
          option.value = element.id;
          option.textContent = element.descripcion;
          selectElement.appendChild(option);
        });
      })
      .catch(error => console.error('Error:', error));
  });
</script>