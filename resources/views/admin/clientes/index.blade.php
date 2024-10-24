@extends('layouts.app')

@section('title')
Clientes
@endsection

@section('modals')
<!-- Modal Create Cliente -->
<div class="modal fade" id="modal-cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form id="form-add">
                {{-- Formulario --}}
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <textarea class="form-control" name="direccion" id="direccion" required></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="vendedor" class="text-dark h5"><b>Vendedor</b></label>
                                <select class="form-control text-dark" name="vendedor" id="vendedor" required>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">
                        <i class="fas fa-check"></i> Agregar
                    </button>
                </div>

                <hr>
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
                    <h4><i class="fa fa-th"></i> Clientes Registrados</h4>
                </div>
                <div class="col-md-6 text-right" id="btnAdd">
                    <a href="#" class="btn btn-primary btn-sm shadow" id="btn-add" data-toggle="modal"
                        data-target="#modal-cliente"><i class="fa fa-plus"></i> Nuevo Registro</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabla-usuarios">
                    <thead class="text-center">
                        <th>N°</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="tbody-usuarios"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var id_cliente_bd = "";
        consultarClientes();
        consultarVendedores();
        // Enviar formulario de registro
        $(document).on('submit', '#form-add', function (e) {
            e.preventDefault();
            let form = new FormData(this);
            form.delete('_method');

            fetch('api/clientes', {
                method: 'POST',
                body: form,
                headers: {
                    // 'Authorization': 'Bearer ' + token, 
                }
            })
                .then(res => res.json())
                .then(function (data) {
                    if (data.status) {
                        Swal.fire(
                            '¡Perfecto!',
                            data.message,
                            'success'
                        )
                        $('#form-add').trigger('reset');
                        consultarClientes();
                    }
                    if (!data.status) {

                        template = `
                                <div>
                                    <ol>     
                            `;
                        if (data.mjs) {
                            template += "<li class='text-left text-danger'>" + data.mjs + "</li>";
                        } else {

                            $.each(data.errors, function (key, value) {
                                template += "<li class='text-left text-danger'>" + value + "</li>";
                            });

                        }
                        template += `
                                </ol>
                            </div>  
                            `;

                        Swal.fire({
                            icon: 'error',
                            title: '¡Ups!',
                            html: template
                        })

                    }
                })

        })

        $(document).on('submit', '#form-edit', function (e) {
            e.preventDefault();

            let form = new FormData(this);
            form.append('_method', 'PUT');

            fetch('api/clientes/' + id_cliente_bd, {
                method: 'POST',
                body: form,
                headers: {
                    // 'Authorization': 'Bearer ' + token, 
                }
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data.data);
                    if (data.status) {

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
                        consultarClientes();
                    }
                    if (!data.status) {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Ups!',
                            html: template
                        })

                    }
                })

        })

        $(document).on("click", "#btnAdd", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-edit').attr('id', 'form-add');
            $('#form-add *').prop('disabled', false);
            $("#password").attr('required', true);
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
            $("#password").attr('required', false);
            var id_cliente = $(this).attr('data-id');
            showDatosOrg(id_cliente);

        })

        $(document).on("click", ".detalle", function () {
            $('#form-edit').trigger('reset');
            $('#form-add').trigger('reset');
            $('#form-add *').prop('disabled', true);
            $('#form-edit *').prop('disabled', true);
            $("#btn-submit").hide();

            var id_cliente = $(this).attr('data-id');
            showDatosOrg(id_cliente);
        })


        $(document).on("click", ".del", function () {
            var id_cliente = $(this).attr('data-id');

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
                        'api/clientes/' + id_cliente, {
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
                                id_cliente = "";
                                //actualizamos la lista
                                consultarClientes();
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

        function consultarClientes() {

            fetch('api/clientes', {
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
                                 <td class="text-center"> ${e.cedula}</td>
                                <td class="text-center"> ${e.nombre}</td>
                                <td class="text-center"> ${e.email}</td>
                                <td class="text-center"> ${e.telefono}</td>
                                <td class="d-flex justify-content-center"> 
                                    <button type="button" class="detalle btn btn-success" data-id="${e.id}" data-toggle="modal" data-target="#modal-cliente">
                                      <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button type="button" class="edit btn btn-warning" data-id="${e.id}" data-toggle="modal" data-target="#modal-cliente">
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
                    $('#tabla-usuarios').DataTable().destroy();

                    $('#tbody-usuarios').html(template);

                    $("table").DataTable({
                        language: translate,
                        responsive: true
                    });

                })
                .catch(error => console.error('Error:', error));
        }

        function showDatosOrg(id_cliente) {
            id_cliente_bd = id_cliente
            fetch(
                'api/clientes/' + id_cliente, {
                method: 'GET'
            }
            ).then(res => res.json())
                .then(function (data) {
                    if (data.status) {
                        data.data.forEach(e => {

                            $("#cedula").val(e.cedula);
                            $("#nombre").val(e.nombre);
                            $("#email").val(e.email);
                            $("#telefono").val(e.telefono);
                            $("#direccion").text(e.direccion);
                            $("#vendedor").val(e.user_id);

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

        function consultarVendedores() {
            fetch('api/user', {
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
                    var template = "";
                    template = `<option value="" selected="selected"></option>`
                    data.data.forEach(e => {
                        template += `<option value="${e.id}">${e.name}</option>`;
                    });
                    $('#vendedor').html(template);

                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
@endsection