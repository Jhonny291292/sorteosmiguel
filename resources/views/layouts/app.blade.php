<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Emergencias</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('plugins/vendor/fontawesome-free/css/all.min.css')}} " rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://kit.fontawesome.com/b99e675b6e.js"></script> -->
    <style>
        .img-emerg {
            height: 200px;
            /* Altura fija de 200px */
            object-fit: cover;
            /* Mantiene la proporción de la imagen y la recorta si es necesario */
        }

        #status1 {
            accent-color: rgb(241, 165, 0);
            color: gray;
        }

        #status2 {
            accent-color: rgb(255, 68, 0);
            color: gray;
        }

        #status3 {
            accent-color: rgb(255, 0, 0);
            color: gray;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background: none;
            /* Elimina el fondo */
            border: none;
            /* Elimina los bordes */
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background: rgba(0, 0, 0, 0.5);
            /* Color de fondo para el icono */
            border-radius: 50%;
            /* Hace que el fondo del icono sea redondeado */
            width: 30px;
            /* Ajusta el tamaño del icono */
            height: 30px;
            /* Ajusta el tamaño del icono */
        }

        .carousel-control-prev-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"%3E%3Cpath fill="white" d="M11.742 1.5L10.5 0l-7 7 7 7 1.242-1.5L5.5 8z"/%3E%3C/svg%3E');
            /* Icono de flecha izquierda */
        }

        .carousel-control-next-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"%3E%3Cpath fill="white" d="M4.258 1.5L5.5 0l7 7-7 7-1.242-1.5L10.5 8z"/%3E%3C/svg%3E');
            /* Icono de flecha derecha */
        }
    </style>


</head>

<body id="page-top">
    @yield('modals')

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3">{{ auth()->user()->name }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('rifa.list')}}">
                    <i class="fas fa-fw fa-suitcase"></i>
                    Control de Rifa
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('clientes.list')}}">
                    <i class="fas fa-fw fa-mountain"></i>
                    Clientes</a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('pagos.list')}}">
                    <i class="fas fa-fw fa-suitcase"></i>
                    Pagos
                </a>
            </li>

            @if(auth()->user()->rol == "S.Administrador")
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('usuarios.list')}}">
                        <i class="fas fa-fw fa-user"></i>
                        Usuarios
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="mx-3">
                    <strong>Copyright &copy; 2024-2025 <a href=""> 
                        <!-- Nombre de la empresa -->
                    </a>.</strong>
                    Todos los derechos reservados.
                    <div class="float-right d-none d-sm-inline-block">
                        <b> 

                        <!-- aqui van los desarrolladores -->
                        </b>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('plugins/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/vendor/fontawesome-free/js/all.min.js')}}"> </script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('plugins/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('plugins/js/sb-admin-2.min.js')}}"></script>
    <!-- JS para maps -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
 
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/js/datatables-spanish.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
    <script>

        document.getElementById('map').style.display = 'block';
        const map = L.map('map').setView([49.2125578, 16.62662018], 14); //starting position
        const key = '05eiIkjJNQBT4XO0eznw';
        map.createPane('labels');
        map.getPane('labels').style.zIndex = 650;
        map.getPane('labels').style.pointerEvents = 'none';
        const basemaps = {
            mapa_1: L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`, { //style URL
                tileSize: 512,
                zoomOffset: -1,
                minZoom: 1,
                attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
                crossOrigin: true
            }), 'Relieve 1': L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),

            'Relieve 2': L.tileLayer(
                "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                {
                    attribution:
                        "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
                    minZoom: 1,
                    maxZoom: 20,
                }
            ),
            'Relieve 3': L.tileLayer('https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '<a href="https://github.com/cyclosm/cyclosm-cartocss-style/releases" title="CyclOSM - Open Bicycle render">CyclOSM</a> | Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
        };
        const layerControl = L.control.layers(basemaps, {}, { collapsed: false }).addTo(map);
        basemaps.mapa_1.addTo(map);
        const geojson = L.geoJson(pais).addTo(map);
        geojson.eachLayer((layer) => {
            layer.bindPopup(`Municipio ${layer.feature.properties.NAME_2}`);
        });
        map.setView({ lat: 9.417, lng: -70.5 }, 9);
        var icono = L.icon({
            iconUrl: '',
            iconSize: [25, 41],
            shadowSize: [50, 64],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });
        fetch('api/emergencias', {
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
                //limpiamos el slider
                var valor = 0;

                data.data.forEach(element => {
                    var carrusel = "";
                    var contador = 0;
                    element.imagenes_emergencias.forEach(element => {
                        // console.log(element.ruta)
                        carrusel += `
                    
                    <div class="carousel-item ${contador == 0 ? 'active' : ''}">
                        <img style="width:200px;height:150px;" src="{{asset('imagenes_emergencias/${element.ruta}')}}" class="d-block w-100" alt="...">
                      </div>

                    `
                        contador++;
                    });

                    //llenamosel slider 

                    // console.log(element)
                    valor++;
                    // console.log(valor);
                    const [lat, lng] = element.coordenadas.split(',').map(c => parseFloat(c));
                    var contenido = `
                     <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" id="carrusel">
                             ${carrusel}
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                  
 
                    <h2> ${element.frente_trabajo.descripcion} </h2>
                    <b>Situación:</b><p style="width:290px; margin:2px;">
                     ${element.situacion} </br> </p></br></br><b>Dirección:</b><a></br>
                     ${element.municipio.descripcion} <br>
                     ${element.parroquia.descripcion}   <br>
                     ${element.sector} <br><b>Coordenadas: 
                     ${element.coordenadas} </b><br> </a></br><br><b>Información de Responsable : </b></br><a>
                     ${element.frente_trabajo.organismo.responsable} </a></br><b>Número de Tlf: </b><a> <br>
                    ${element.frente_trabajo.organismo.telefono}
                     `;
                    //  console.log(element.status);


                    switch (element.status) {
                        case "1":
                            icono.options.iconUrl = '{{asset("images/marcador-amarillo.png")}}';
                            L.marker([lat, lng], { icon: icono }).addTo(map)
                                .bindPopup(contenido)
                                .bindTooltip(`
                                        <h4>Frente: ${element.frente_trabajo.descripcion} </h4>`,
                                    {
                                        direction: 'left',
                                        sticky: true
                                    }
                                );
                            break;

                        case "2":
                            icono.options.iconUrl = '{{asset("images/n.png")}}';
                            L.marker([lat, lng], { icon: icono }).addTo(map)
                                .bindPopup(contenido)
                                .bindTooltip(`
                                        <h4>Frente: ${element.frente_trabajo.descripcion} </h4>`,
                                    {
                                        direction: 'left',
                                        sticky: true
                                    }
                                );
                            break;

                        case "3":
                            icono.options.iconUrl = '{{asset("images/marcador-rojo.png")}}';
                            L.marker([lat, lng], { icon: icono }).addTo(map)
                                .bindPopup(contenido)
                                .bindTooltip(`
                                        <h4>Frente: ${element.frente_trabajo.descripcion} </h4>`,
                                    {
                                        direction: 'left',
                                        sticky: true
                                    }
                                );
                            break;

                        default:
                            break;
                    }

                });
            })
            .catch(error => console.error('Error:', error));



    </script>

</body>

</html>