@extends('layouts.app')

@section('title')
Emergencias
@endsection

@section('modals')
<!-- Modal Create Users -->
<div class="modal fade" id="modal-emergencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Agregar Emergencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form class="py-4" id="form-add">
                <div class="px-3">
                    <div class="row justify-content-between">
                        <div class=" px-3 ">
                            <label for="status" class="level2"><strong>Nivel de emergencia</strong></label>

                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="1"
                                    required>
                                <label class="form-check-label" for="status1">Leve</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status2" value="2">
                                <label class="form-check-label" for="status2">Grave</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status3" value="3">

                                <label class="form-check-label" for="status3">Urgente</label>
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha_evento" name="fecha_evento" required>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-2 gx-3 align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="coordenadas">Coordenadas</label>
                                <input placeholder="lat-long. Ej: 9.117, -70.1" style="margin-right:2rem;" type="text"
                                    class="form-control" id="coordenadas" name="coordenadas" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="municipio">Municipios</label>
                                <select class="form-control" id="municipio" name="municipio_id" required>
                                    <option value="" class="text-center"> --- Seleccione un Municipio --- </option>
                                    @foreach($municipios as $mun)
                                        <option value="{{$mun->id}}">{{$mun->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="parroquia">Parroquia</label>
                                <div id="input-parroquia">
                                    <select class="form-control" id="parroquia" name="parroquia_id" required>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="familias_afectadas">Familias Afectadas</label>
                                        <input type="text" class="form-control" id="familias_afectadas"
                                            name="familias_afectadas" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="personas_afectadas">Personas Afectadas</label>
                                        <input type="text" class="form-control" id="personas_afectadas"
                                            name="personas_afectadas" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heridos">Heridos</label>
                                        <input type="text" class="form-control" id="heridos" name="heridos" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fallecidos">Fallecidos</label>
                                        <input type="text" class="form-control" id="fallecidos" name="fallecidos"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="desaparecidos">Desaparecidos</label>
                                        <input type="text" class="form-control" id="desaparecidos" name="desaparecidos"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="frentes">Frente</label>
                                <select class="form-control" id="frentes" name="frente_id" required>
                                    <option value="" class="text-center"> --- Seleccione un Frente --- </option>
                                    @foreach($frentes as $frente)
                                        <option value="{{$frente->id}}">{{$frente->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estructura">Estructura</label>
                                <select class="form-control" id="estructura" name="estructura_id" required>
                                    <option value="" class="text-center"> --- Seleccione una Estructura --- </option>
                                    @foreach($estructuras as $estructura)
                                        <option value="{{$estructura->id}}">{{$estructura->tipo_estructura}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estructura_afectcantidad">Estructuras Afectadas</label>
                                <input type="text" class="form-control" id="estructura_afectcantidad"
                                    name="estructura_afectcantidad" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                    required></textarea>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sector">Sector</label>
                                <textarea class="form-control" id="sector" name="sector" rows="3" required></textarea>

                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-center" id="input-img">
                        <div class="col-md-6" id="div-img">
                            <div class="form-group">
                                <label for="img">Seleccionar imagen</label>
                                <input type="file" multiple name="img[]">
                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-center" id="cont-imagenes">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">
                        <i class="fas fa-check"></i> Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="container p-5">
    <div class="card card-outline card-danger">
        <div class="card-title p-4 border-bottom">
            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fa fa-th"></i> Emergencias Registradas</h4>
                </div>
                <div class="col-md-6 text-right" id="btnAdd">
                    <a href="#" class="btn btn-primary btn-sm shadow" id="btn-add" data-toggle="modal"
                        data-target="#modal-emergencia"><i class="fa fa-plus"></i> Nuevo Registro</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-emergencias" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nivel de Emergencia</th>
                            <th>Municipio</th>
                            <th>Situación</th>
                            <th>Ente Responsable</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-emergencias">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var id_emergencia_gl = "";
        consultarEmergencias();

        var municipio_id = 0;
        $("#municipio").change(function () {
            municipio_id = this.value;
            consultarParroquias(municipio_id);
        });

        $(document).on('submit', '#form-add', function (e) {
            e.preventDefault();
            let form = new FormData(this);
            form.delete('_method');


            fetch('api/emergencias', {
                method: 'POST',
                body: form,
                headers: {
                    // 'Authorization': 'Bearer ' + token, 
                }
            })
                .then(response => {
                    if (response.ok) {
                        return response.json(); // O response.text() si no esperas un JSON
                    } else {
                        throw new Error('Error en la solicitud: ' + response.statusText);
                    }
                })
                .then(data => {
                    Swal.fire({
                        title: 'Registro correcto',
                        icon: 'success',
                        timer: 3000, // 3 segundos
                        timerProgressBar: true,
                        willClose: () => {
                            // Puedes agregar acciones aquí si lo deseas
                            document.getElementById('form-add').reset();
                        }
                    });
                    //actualizamos la lista
                    consultarEmergencias();
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        })

        $(document).on('submit', '#form-edit', function (e) {
            e.preventDefault();

            let form = new FormData(this);
            form.append('_method', 'PUT');

            fetch('api/emergencias/' + id_emergencia_gl, {
                method: 'POST',
                body: form,
                headers: {
                    // 'Authorization': 'Bearer ' + token, 
                }
            })
                .then(response => {
                    if (response.ok) {
                        return response.json(); // O response.text() si no esperas un JSON
                    } else {
                        throw new Error('Error en la solicitud: ' + response.statusText);
                    }
                })
                .then(data => {

                    Swal.fire({
                        title: 'Actualización correcta',
                        icon: 'success',
                        timer: 3000, // 3 segundos
                        timerProgressBar: true,
                        willClose: () => {
                            // agregar acciones
                        }
                    });
                    //actualizamos la lista
                    consultarEmergencias();
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        })

        $(document).on("click", "#btnAdd", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-edit').attr('id', 'form-add');
            $('#form-add *').prop('disabled', false);
            $("#status1").attr("checked", false)
            $("#status2").attr("checked", false)
            $("#status3").attr("checked", false)
            $("#btn-submit").html(`<i class="fas fa-check"></i> Agregar`);
            $("#btn-submit").show();
            $("#input-img").show();
            $("#cont-imagenes").hide();
        })

        $(document).on("click", ".edit", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-add').attr('id', 'form-edit');
            $('#form-edit *').prop('disabled', false);
            $("#btn-submit").html(`<i class="fas fa-check"></i> Editar`);
            $("#btn-submit").show();
            $("#input-img").show();
            $("#cont-imagenes").hide();

            var id_emergencia = $(this).attr('data-id');
            showDatosEmergencia(id_emergencia);

        })

        $(document).on("click", ".detalle", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-add *').prop('disabled', true);
            $('#form-edit *').prop('disabled', true);
            $("#btn-submit").hide();
            $("#input-img").hide(); //input file
            $("#cont-imagenes").show(); //contenedor donde se muestran las imagenes

            var id_emergencia = $(this).attr('data-id');
            showDatosEmergencia(id_emergencia);
        })
        //metodo para ver los datos de emergencia y editar
        function showDatosEmergencia(id_emergencia) {
            id_emergencia_gl = id_emergencia
            fetch(
                'api/emergencias/' + id_emergencia, {
                method: 'GET'
            }
            ).then(res => res.json())
                .then(function (data) {
                    if (data.status) {

                        data.data.forEach(e => {
                            // console.log(e);
                            // console.log(moment(new Date(e.fecha_evento).toLocaleDateString('es-es'), 'DD/MM/YYYY').format('DD-MM-YYYY'));
                            // consultarParroquias(e.municipio.id);
                            if (e.status == 1) {
                                $("#status1").attr("checked", true)
                                $("#status2").attr("checked", false)
                                $("#status3").attr("checked", false)
                            } else if (e.status == 2) {
                                $("#status1").attr("checked", false)
                                $("#status2").attr("checked", true)
                                $("#status3").attr("checked", false)
                            } else if (e.status == 3) {
                                $("#status1").attr("checked", false)
                                $("#status2").attr("checked", false)
                                $("#status3").attr("checked", true)
                            }
                            $("#fecha_evento").val(e.fecha_evento);
                            $("#coordenadas").val(e.coordenadas);
                            $("#municipio").val(e.municipio.id);
                            $("#parroquia").val(e.parroquia.id);
                            $("#situacion").val(e.situacion);
                            $("#causas").val(e.causas);
                            $("#familias_afectadas").val(e.familias_afectadas);
                            $("#personas_afectadas").val(e.personas_afectadas);
                            $("#heridos").val(e.heridos);
                            $("#fallecidos").val(e.fallecidos);
                            $("#desaparecidos").val(e.desaparecidos);
                            $("#frentes").val(e.frente_trabajo.id);
                            $("#estructura").val(e.estructura.id);
                            $("#estructura_afectcantidad").val(e.estructura_afectcantidad);
                            $("#descripcion").val(e.descripcion);
                            $("#sector").val(e.sector);

                            var imagenes = ''

                            if (e.imagenes_emergencias.length > 0) {
                                e.imagenes_emergencias.forEach(imagen => {
                                    // console.log(imagen.ruta);

                                    imagenes += `
                                        <div class="col-md-4 py-4">
                                            <img src="{{asset('imagenes_emergencias/${imagen.ruta}')}}" class="img-fluid rounded img-emerg"
                                                alt="...">
                                        </div>
                                    `;

                                });
                            } else {
                                imagenes = '<h5>Sin Imágenes</h5>';
                            }

                            $("#cont-imagenes").html(imagenes);

                        });
                    }
                }).catch(function (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: err
                    })
                })
        }

        function consultarParroquias(municipio_id) {
            fetch(
                'api/parroquias/' + municipio_id, {
                method: 'GET'
            }
            ).then(res => res.json())
                .then(function (data) {

                    var parroquias = `<option value="0">SELECCIONE PARROQUIA</option>`;
                    $("#parroquia").html("");
                    if (data.status) {
                        data.data.forEach(parroquia => {
                            parroquias += `<option value="${parroquia.id}">${parroquia.descripcion}</option>`;
                        });

                        $("#parroquia").html(parroquias);
                    } else {
                        console.log("Error");
                    }

                })
                .catch(function (err) {
                    console.log(err);
                })

        }
        function consultarEmergencias() {

            fetch('api/emergencias', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la consulta...');
                    }
                    return response.json();
                })
                .then(data => {
                    var num = 1;
                    var template = "";
                    data.data.forEach(emergencia => {
                        var textStatus = "";
                        if (emergencia.status == 1) {
                            textStatus = "Leve"
                        } else if (emergencia.status == 2) {
                            textStatus = "Grave"
                        } else if (emergencia.status == 3) {
                            textStatus = "Urgente"
                        }
                        template += `
                        <tr data-id="${num}">
                            <td>${emergencia.fecha_evento}</td>
                            <td>${textStatus}</td>
                            <td>${emergencia.municipio.descripcion}</td>
                            <td>${emergencia.situacion}</td>
                            <td>${emergencia.frente_trabajo.organismo.nombre}</td>
                            <td class="d-flex justify-content-between">
                                <button type="button" title="Detalle" class="detalle btn btn-success" data-id="${emergencia.id}" data-toggle="modal" data-target="#modal-emergencia">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                <button type="button" title="Editar" class="edit btn btn-warning" data-id="${emergencia.id}" data-toggle="modal" data-target="#modal-emergencia">
                                        <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" title="Eliminar" class="del btn btn-danger" data-id="${emergencia.id}">
                                        <i class="fas fa-trash-alt"></i>
                                        </button>
                            </td>
                        </tr>`;
                        num++

                    })
                    //agregamos los datos a la tabla
                    $('#table-emergencias').DataTable().destroy();

                    $('#tbody-emergencias').html(template);

                    $("table").DataTable({
                        language: translate,
                        responsive: true
                    });

                })
                .catch(error => console.error('Error:', error));
        }

        $(document).on("click", ".del", function () {
            var id_emergencia = $(this).attr('data-id');

            Swal.fire({
                title: '¿Estás seguro(a) de eliminar este registro?',
                text: "Ten en cuenta que la información que será eliminada es irrecuperable.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval;
                    Swal.fire({
                        title: 'Procesando...',
                        html: 'La ventana se cerrará en <b></b> milisegundos.',
                        timer: 30000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            // console.log('I was closed by the timer')
                        }
                    })

                    fetch(
                        'api/emergencias/' + id_emergencia, {
                        method: 'DELETE'
                    }
                    ).then(res => res.json())
                        .then(function (data) {
                            if (data.status) {
                                Swal.fire(
                                    '¡Perfecto!',
                                    data.message,
                                    'success'
                                )
                                id_emergencia = "";
                                //actualizamos la lista
                                consultarEmergencias();
                            }
                        }).catch(function (err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: err
                            })
                        })
                }
            });
        })

    });
</script>
@endsection