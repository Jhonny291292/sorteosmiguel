<div class="sidebar sidebar-collapse">

    <ul>
      <li id="Emergencia">
        <a>
          <span class="icon"><i class="fas fa-globe"></i></span>
          <span class="title" id="aggemerg">Seguimiento de Emergencias</span>
        </a>
        <ul id="opcionesEmergencia" style="display: none">
          <li id="aggModal">
            <a href="#">
              <span class="icon"><i class="fas fa-plus"></i></span>
              <span class="title">Agregar Emergencia</span>
            </a>
          </li>

          <li id="listEmg">
            <a href="#">
              <span class="icon"><i class="fas fa-clipboard"></i></span>
              <span class="title">Listado de Emergencias</span>
            </a>
          </li>
      </li>
    </ul>

    <li id="frentes">
      <a href="{{route('frentes.list')}}" class="nav-link">
        <span class="icon"><i class="fas fa-mountain"></i></span>
        <span class="title">Frentes</span>
      </a>
    </li>
    

    <!-- <li>
            <a href="#">
              <span class="icon"><i class="fas fa-flag"></i></span>
              <span id="abrirModal" class="title"
                >Seguimiento <br />
                por Municipios</span
              >
            </a>
          </li>
          <li>
            <a href="#">
              <span class="icon"><i class="fas fa-shield-alt"></i></span>
              <span id="abrirModal" class="title">Fin de Guardia</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="icon"><i class="fas fa-hands-helping"></i></span>
              <span class="title">Donaciones</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="icon"><i class="fas fa-exclamation"></i></span>
              <span id="abrirModal" class="title">Requerimientos extras</span>
            </a>
          </li> -->

    <!-- <li>
            <a href="#">
              <span class="icon"><i class="fas fa-sitemap"></i></span>
              <span id="abrirModal" class="title">Maquinaria <br />de organismos</span>
            </a>
          </li> -->

    <li id="Organismo">
      <a href="{{route('organismos.list')}}" class="nav-link">
        <span class="icon"><i class="fas fa-building"></i></span>
        <span class="title">Organismos</span>
      </a>
    </li>


    <li id="configuracion">
      <a href="{{route('usuarios.list')}}" class="nav-link">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span id="abrirModal" class="title">USUARIOS</span>
      </a>
      <ul id="opcionesConfiguracion" style="display: none">
        
        <!-- <li>
                <a href="#">
                  <span class="icon">
                    <i class="fas fa-briefcase-medical"></i
                  ></span>
                  <span id="abrirModal" class="title">Tipo de afección</span>
                </a>
              </li>

              <li>
                <a href="#">
                  <span class="icon">
                    <i class="fas fa-compass"></i>
                  </span>
                  <span id="abrirModal" class="title">Areas</span>
                </a>
              </li>

              <li>
                <a href="#">
                  <span class="icon"><i class="fas fa-truck"></i></span>
                  <span id="abrirModal" class="title">Insumos de maquinarias</span>
                </a>
              </li>

              <li>
                <a href="#">
                  <span class="icon"><i class="fas fa-warehouse"></i></span>
                  <span id="abrirModal" class="title">Empresas y particulares</span>
                </a>
              </li> -->
      </ul>
    </li>
    </ul>
  </div>
  </div>
  <script>

    $(".sidebar ul li a").removeClass("active");
    $(this).addClass("active");

    $(".sidebar ul li a").removeClass("active");
    $(this).addClass("active");
    // Buscar el elemento span dentro del enlace clickeado y eliminar el prefijo "_"
    $(this).find("span.title").text(function (_, text) {
      return text.replace(/^_/, "");
    });


    $(".hamburger").click(function () {
      $(".sidebar").toggleClass("collapse");
    });
    // configuracion opciones
    const configuracion = document.getElementById("configuracion");
    const opcionesConfiguracion = document.getElementById(
      "opcionesConfiguracion"
    );

    configuracion.addEventListener("click", function () {
      opcionesConfiguracion.style.display =
        opcionesConfiguracion.style.display === "none" ? "block" : "none";
    });
    // frente opciones
    const frente = document.getElementById("frentes");
    const opcionesfrente = document.getElementById(
      "opcionesfrente"
    );

    frente.addEventListener("click", function () {
      opcionesfrente.style.display =
        opcionesfrente.style.display === "none" ? "block" : "none";
    });
    // emergencia opciones
    const Emergencia = document.getElementById("Emergencia");
    const opcionesEmergencia = document.getElementById(
      "opcionesEmergencia"
    );

    Emergencia.addEventListener("click", function () {
      opcionesEmergencia.style.display =
        opcionesEmergencia.style.display === "none" ? "block" : "none";
    });
    // organismos opciones
    const Organismo = document.getElementById("Organismo");
    const opcionesOrganismo = document.getElementById(
      "opcionesOrganismo"
    );

    Organismo.addEventListener("click", function () {
      opcionesOrganismo.style.display =
        opcionesOrganismo.style.display === "none" ? "block" : "none";
    });

    //metodos 
    $(document).on("click", "#listEmg", function () {
      verEmergencias();

    })
    //consultas 

    function verEmergencias() {

      $('#tbody-jefes').html("");
      fetch(
        '/api/emergencias', {
        method: 'GET'
      }
      ).then(res => res.json()).then(function (data) {
        // console.log(data);

        template = "";
        data.data.forEach(e => {
          console.log(e);
          var nivel_emergencia = "";
          // var color_renglon = "";
          if (e.status == 1) {
            nivel_emergencia = "Leve";
            // color_renglon = "red";
          } else if (e.status == 2) {
            nivel_emergencia = "Normal";
          } else if (e.status == 3) {
            nivel_emergencia = "Grave";
          }
          //LEVE NORMAL GRAVE amarrillo naranja rojo
          template += `
          <tr>
              <td> ${e.fecha_evento}</td>
              <td> ${nivel_emergencia}</td>
              <td> ${e.municipio.descripcion}</td>
              <td> ${e.situacion} </td>
              <td> ${e.frente_trabajo.organismo.nombre} </td>
              <td> 
              <button type="button" class="btn btn-primary" data-toggle="modal"
                  data-target="#detalleEmergencia">
                  DETALLE
              </button>
              </td>
          </tr>
          `;
        });

        // $('#datatableFr').DataTable().destroy();

        $('#body-emergencia').html(template);

        // $('#datatableFr').DataTable({
        //   language: translate
        // });
      })
        .catch(function (err) {
          console.log(err);
        })
    }

  </script>
