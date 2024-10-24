@extends('layouts.app')

@section('title')
Ventas
@endsection

@section('modals')
<!-- Modal-->

@endsection

@section('content')
<div class="container p-5">
    <div class="card card-outline card-danger">
        <div class="card-title p-4 border-bottom">
            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fa fa-th"></i> Mis Ventas</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p id="datos-vendedor"></p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="tabla-detalle">
                    <thead class="text-center">
                        <th>Número</th>
                        <th>Cliente</th>
                        <th>Total Pagado ($)</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                    </thead>
                    <tbody id="tbody-detalle"></tbody>
                </table>
            </div>
            <p id="total_pagado"></p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var data = @json($data);
        const id_user = data[0].user_id;
        const user_nombre = data[0].user.name;

        verVentasUser(id_user, user_nombre);

        function verVentasUser(id_user, user_nombre) {
            fetch(
                'api/user/' + id_user, {
                method: 'GET'
            }
            ).then(res => res.json())
                .then(function (data) {
                    console.log(data);
                    
                    // console.log(data);
                    var template = "";
                    if (data.status) {
                        data.data.forEach(e => {
                            template += `
                            <tr>
                                <td class="text-center"> ${e.numero.toString().padStart(3, '0')}</td>
                                <td class="text-center"> ${e.cliente.nombre}</td>
                                <td class="text-center"> ${e.total_pagado}</td>
                                <td class="text-center"> ${moment(e.fecha).format('DD/MM/YYYY')}</td>
                                <td class="text-center"> ${e.estatus}</td>
                            </tr>
                        `;
                        });
                    }
                    $('#tabla-detalle').DataTable().destroy();

                    $('#tbody-detalle').html(template);

                    table = $("#tabla-detalle").DataTable({
                        language: translate,
                        responsive: true
                    });
                    total = 0;
                    var data = table.data();
                    data.each(function (row) {
                        total += parseFloat(row[2]);
                    });
                    $("#datos-vendedor").html("<strong>Números vendidos por " + user_nombre + ". </strong> Total Vendido: " + total + "($)")
                    // Escucha el evento de redibujo
                    table.on('draw', function () {

                        total = 0;
                        table.rows({ filter: 'applied' }).every(function () {

                            var data = this.data(); // Obtiene los datos de la fila                            
                            var totalPagado = parseFloat(data[2]) || 0; // Cambia el índice según la posición de tu columna
                            total += totalPagado; // Suma el valor

                        });
                        $("#datos-vendedor").html("<strong>Números vendidos por " + user_nombre + " </strong> Total Vendido: " + total + "($)")
                    });

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