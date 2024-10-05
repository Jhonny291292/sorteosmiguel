@extends('layouts.app')

@section('title')
Organismos
@endsection

@section('modals')
<!-- Modal Create Users -->
<div class="modal fade" id="modal-organismo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Agregar Organismo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form id="form-add">
                {{-- Formulario --}}
                <div class="modal-body">
                    @csrf
                    <div class="row gy-2 gx-3 align-items-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input placeholder="Nombre" type="text" class="form-control" id="nombre" name="nombre"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coordenadas">Responsable</label>
                                <input placeholder="Nombre y apellido" type="text" class="form-control" id="responsable"
                                    name="responsable" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input placeholder="Tlf de contacto" type="text" class="form-control" id="telefono"
                                    name="telefono" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">
                        <i class="fas fa-check"></i> Agregar
                    </button>
                </div>
                {{-- Fin Formulario
                <hr> --}}
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
                    <h4><i class="fa fa-th"></i> Organismos Registrados</h4>
                </div>
                <div class="col-md-6 text-right" id="btnAdd">
                    <a href="#" class="btn btn-primary btn-sm shadow" id="btn-add" data-toggle="modal"
                        data-target="#modal-organismo"><i class="fa fa-plus"></i> Nuevo Registro</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabla-organismos">
                    <thead class="text-center">
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Responsable</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="tbody-organismos"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var id_organismo_gl = "";
        consultarOrganismos();

        // Enviar formulario de registro
        $(document).on('submit', '#form-add', function (e) {
            e.preventDefault();
            let form = new FormData(this);
            form.delete('_method');

            fetch('api/organismos', {
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
                    consultarOrganismos();
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        })

        $(document).on('submit', '#form-edit', function (e) {
            e.preventDefault();

            let form = new FormData(this);
            form.append('_method', 'PUT');

            fetch('api/organismos/' + id_organismo_gl, {
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
                    consultarOrganismos();
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
            $("#btn-submit").html(`<i class="fas fa-check"></i> Agregar`);
            $("#btn-submit").show();
        })

        $(document).on("click", ".edit", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-add').attr('id', 'form-edit');
            $('#form-edit *').prop('disabled', false);
            $("#btn-submit").html(`<i class="fas fa-check"></i> Editar`);
            $("#btn-submit").show();

            var id_org = $(this).attr('data-id');
            showDatosOrg(id_org);

        })

        $(document).on("click", ".detalle", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-add *').prop('disabled', true);
            $('#form-edit *').prop('disabled', true);
            $("#btn-submit").hide();

            var id_org = $(this).attr('data-id');
            showDatosOrg(id_org);
        })


        $(document).on("click", ".del", function () {
            var id_org = $(this).attr('data-id');

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
                        'api/organismos/' + id_org, {
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
                                id_org = "";
                                //actualizamos la lista
                                consultarOrganismos();
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

        function consultarOrganismos() {

            fetch('api/organismos', {
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
                    data.data.forEach(e => {

                        template += `
                            <tr>
                                <td class="text-center"> ${num}</td>
                                <td> ${e.nombre}</td>
                                <td> ${e.responsable}</td>
                                <td> ${e.telefono}</td>
                                <td class="d-flex justify-content-center"> 
                                    <button type="button" class="detalle btn btn-success" data-id="${e.id}" data-toggle="modal" data-target="#modal-organismo">
                                      <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="button" class="edit btn btn-warning" data-id="${e.id}" data-toggle="modal" data-target="#modal-organismo">
                                      <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="del btn btn-danger" data-id="${e.id}">
                                      <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        num++;
                    });
                    //agregamos los datos a la tabla
                    $('#tabla-organismos').DataTable().destroy();

                    $('#tbody-organismos').html(template);

                    $("table").DataTable({
                        language: translate,
                        responsive: true
                    });

                })
                .catch(error => console.error('Error:', error));
        }

        function showDatosOrg(id_org) {
            id_organismo_gl = id_org
            fetch(
                'api/organismos/' + id_org, {
                method: 'GET'
            }
            ).then(res => res.json())
                .then(function (data) {
                    console.log(data);
                    
                    if (data.status) {

                        data.data.forEach(e => {

                            $("#nombre").val(e.nombre);
                            $("#responsable").val(e.responsable);
                            $("#telefono").val(e.telefono);

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
    });
</script>
@endsection