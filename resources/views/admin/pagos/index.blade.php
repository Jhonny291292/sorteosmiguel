@extends('layouts.app')

@section('title')
Pagos
@endsection

@section('modals')
<!-- Modal Create Cliente -->
<div class="modal fade" id="modal-cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Detalle de la Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form id="form-add">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <h5>Tabla Resumen</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="">
                            <thead class="text-center">
                                <th>N°</th>
                                <th>Cliente</th>
                                <th>Número</th>
                                <th>Monto ($)</th>
                                <th>Vendedor</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody id="tbody-detalle"></tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-success" id="btn-submit">
                        <i class="fas fa-check"></i> Agregar
                    </button> -->
                </div>

                <hr>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pagos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Registrar un Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form id="form-pagar">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <h5>Datos del Pago</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <input type="text" class="form-control" id="user_id" name="user_id" value="{{auth()->user()->id}}"
                        hidden>
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero">Número a pagar (0 ~ 999)</label>
                                <input type="text" oninput="numberOnly(this.id);" class="form-control" maxlength="3" id="number" name="number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto">Monto ($)</label>
                                <input type="text" oninput="numberOnly(this.id);" class="form-control" maxlength="2" id="monto" name="monto">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">
                        <i class="fas fa-check"></i> Pagar
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
                    <h4><i class="fa fa-th"></i> Pagos</h4>
                </div>
                <div class="col-md-6 text-right" id="btnAdd">
                    <a href="#" class="btn btn-primary btn-sm shadow" id="btn-add" data-toggle="modal"
                        data-target="#modal-pagos"><i class="fa fa-plus"></i> Realizar Pago</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabla-pagos">
                    <thead class="text-center">
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Números Comprados</th>
                        <th>Total Pagado ($)</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="tbody-pagos"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        consultarPagos();

        function consultarPagos() {

            fetch('api/pagos', {
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
                    <td class="text-center"> ${e.cliente.nombre}</td>
                    <td class="text-center"> ${e.numeros_comprados}</td>
                    <td class="text-center"> ${e.total_pagado}</td>
                    <td class="d-flex justify-content-center"> 
                        <button type="button" class="detalle btn btn-success" title="Detalle" data-id="${e.cliente_id}" data-toggle="modal" data-target="#modal-cliente">
                          <i class="fas fa-info-circle"></i>
                        </button>
                    </td>
                </tr>
            `;
                        num++;
                    });
                    //agregamos los datos a la tabla
                    $('#tabla-pagos').DataTable().destroy();

                    $('#tbody-pagos').html(template);

                    $("#tabla-pagos").DataTable({
                        language: translate,
                        responsive: true
                    });

                })
                .catch(error => console.error('Error:', error));
        }
    });

    $(document).on("click", ".detalle", function() {

        var id_cliente = $(this).attr('data-id');

        showDatosCompras(id_cliente);
    })

    function showDatosCompras(id_cliente) {
        fetch(
                'api/pagos/' + id_cliente, {
                    method: 'GET'
                }
            ).then(res => res.json())
            .then(function(data) {
                if (data.status) {
                    var num = 1;
                    var template = "";
                    data.data.forEach(e => {
                        template += `
                            <tr>
                                <td class="text-center"> ${num}</td>
                                <td class="text-center"> ${e.cliente.nombre}</td>
                                <td class="text-center"> ${e.numero}</td>
                                <td class="text-center"> ${e.monto}</td>
                                <td class="text-center"> ${e.user.name}</td>
                                <td class="d-flex justify-content-center"> 
                                    <button type="button" class="del btn btn-danger" data-id="${e.id}" cliente-id="${e.cliente.id}">
                                      <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        num++;
                    });
                    $('#tbody-detalle').html(template);
                }
            }).catch(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: err
                })
            })
    }

    $(document).on("click", ".del", function() {
        var id_pago = $(this).attr('data-id');
        var cliente_id = $(this).attr('cliente-id');

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
                        'api/pagos/' + id_pago, {
                            method: 'DELETE'
                        }
                    ).then(res => res.json())
                    .then(function(data) {
                        if (data.status) {
                            Swal.fire(
                                '¡Perfecto!',
                                data.message,
                                'success'
                            )
                            //actualizamos la lista
                            showDatosCompras(cliente_id);
                        }
                    }).catch(function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: err
                        })
                    })
            }
        });
    })

    function numberOnly(id) {
        var element = document.getElementById(id);
        element.value = element.value.replace(/[^0-9]/gi, "");
    }

    $("#cedula").on("keyup", function() {
        var cedula = $(this).val();
        if (cedula != "") {
            fetch('api/clientes/' + cedula, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        $("#nombre").val("");
                        console.log('Error en la consulta...');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#nombre").val("");
                    data.data.forEach(e => {
                        $("#nombre").val(e.nombre);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });

    $(document).on('submit', '#form-pagar', function (e) {
            e.preventDefault();
            let form = new FormData(this);
            // form.append("id_u", auth()->user()->name);
            form.delete('_method');

            fetch('api/pagos', {
                method: 'POST',
                body: form,
                headers: {
                    // 'Authorization': 'Bearer ' + token, 
                }
            })
                .then(res => res.json())
                .then(function (data) {
                    console.log(data);
                    if (data.status) {
                        Swal.fire(
                            '¡Perfecto!',
                            data.message,
                            'success'
                        )
                        $('#form-pagar').trigger('reset');
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
</script>
@endsection