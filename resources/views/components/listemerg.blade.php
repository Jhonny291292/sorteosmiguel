<div class="modal" id="modalListEm" tabindex="-1">

  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Listado de Emergencias</h5>
        <button type="button" class="btn-close5" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">

          <div class="table-responsive mx-4 mt-2">
            <table id="datatableFr" class="table table-sm  table-hover mt-4 mb-6">
              <thead class="table-secondary">
                <tr class="shadow-sm">
                  <!-- <th style="width:14px">
                                <input class="form-check-input" type="checkbox">
                            </th> -->
                  <th>Fecha</th>
                  <th>Nivel de emergencia</th>
                  <!-- <th>Coordenadas</th> -->
                  <th>Municipio</th>
                  <!-- <th>Parroquia</th> -->
                  <th>Situacion</th>
                  <!-- <th>Causas</th> -->
                  <!-- <th>Familias Afectadas</th>
                            <th>Personas Afectadas</th>
                            <th>Heridos</th>
                            <th>Fallecidos</th>
                            <th>Desaparecidos</th>
                            <th>Estructura</th> -->
                  <th>Responsable</th>
                  <!-- <th>Sector</th>
                            <th>Descripcion</th> -->
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="body-emergencia">
                <!-- CARGA DE DATOS -->

                <!-- 1 -->




              </tbody>
            </table>


            <script>
              // $("table").DataTable({
              //   "language": {
              //     "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
              //   }
              // });
              // Ventana modal// Emerg
              // Modal Lista Frentes
              var modalEditEm = document.getElementById("editModal");
              var botonEditEm = document.getElementById(".btn-edit");
              var cerrarlistFr = document.querySelector(".btn-close6");

              if (modalEditEm) {
                if (botonEditEm) {
                  botonEditEm.addEventListener("click", function () {
                    modalEditEm.style.display = "block";
                  });

                  console.log("El modal de ListFrente se mostrará al hacer clic en el botón.");
                } else {
                  console.error("El elemento con el ID 'btnlistfr' no existe en el HTML.");
                }
              } else {
                console.error("El elemento con el ID 'modalEditEm' no existe en el HTML.");
              }

              cerrarlistFr.addEventListener("click", function () {
                modalEditEm.style.display = "none";
              });

              window.addEventListener("click", function (event) {
                if (event.target == modalEditEm) {
                  modalEditEm.style.display = "none";
                }
              });

              $(document).on("click", ".btn-ver", function () {
                var btnver = $(this).attr("data-fecha")
                console.log(btnver);
              });

              


            </script>


          </div>
        </div>

      </div>
    </div>
  </div>
</div>