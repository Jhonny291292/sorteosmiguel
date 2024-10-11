@extends('layouts.app')

@section('title')
Rifas
@endsection

@section('css')
<style>

</style>
@endsection

@section('modals')
<!-- Modal para comprar numero de rifa -->
<div class="modal fade" id="modal-rifa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modal-title"><b>Número de Rifa</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form id="form-add" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="text-center" id="number-rifa">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                            <input type="hidden" id="number" name="number">
                            <div class="form-group">
                                <label for="cedula" class="text-dark h5"><b>Cliente</b></label>
                                <select class="form-control text-dark select2" id="cedula" name="cedula" style="width: 100%;" required></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Monto $</b></span>
                                </div>
                                <input type="text" class="form-control text-right" id="monto" name="monto">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-submit">
                        <i class="fas fa-check"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para ver datos del numero de rifa o liberar en caso de no pagar -->
<div class="modal fade" id="modal-liberar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modal-title"><b>Número de Rifa</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="text-center" id="number-comprado">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-dark ps-1 pt-2 cliente"><b>Proveedor: </b> {supplier_name} <b>RIF: </b> {supplier_rif}</p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-dark ps-1 pt-2 direccion"><b>Dirección: </b> {supplier_address}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-dark ps-1 pt-2 telefono"><b>Teléfono: </b> {supplier_tlf}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-dark ps-1 pt-2 correo"><b>Correo: </b> {supplier_authorized}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="btn-submit">
                        ¿Quiere liberar este número?
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-dark"> <i class="fa fa-th"></i> <b>Rifa</b></h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed table-sm text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="10">Números a Rifar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const PrecioRifa = 5;
        //Initialize Select2 Elements
        $('.select2').select2({
            dropdownParent: $('#modal-rifa .modal-body'),
            language: {
                noResults: function() {

                    return "No hay resultado";
                },
                searching: function() {

                    return "Buscando..";
                }
            }
        })
        let personas = [
            cliente_id = '',
            cliente_ci = '',
            cliente_nombre = '',
            cliente_direccion = '',
            cliente_telefono = '',
            cliente_email = '',
        ];
        //Funcion para mostrar la tabla de numeros
        function tablaNumeros() {
            let template = '',
                numeros = [],
                secciones = [],
                numeros_comprados = [],
                montosPorNumero = {},
                datos_clientes = [],
                datos_vendedores = [];
            // Generar números del 0 al 999
            for (let i = 0; i < 1000; i++) {
                numeros.push(i);
            }

            // Agrupar en secciones de 100
            for (let i = 0; i < numeros.length; i += 100) {
                secciones.push(numeros.slice(i, i + 100));
            }

            fetch('api/rifas', {
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
                    // Almacenar los números comprados en la variable
                    data.data.forEach(e => {
                        const numero = e.numero;
                        const monto = parseFloat(e.monto);

                        // Si el número ya existe en el objeto, sumamos el monto
                        if (montosPorNumero[numero]) {
                            montosPorNumero[numero] += monto;
                        } else {
                            // Si no existe, lo inicializamos con el monto actual
                            montosPorNumero[numero] = monto;
                        }
                        numeros_comprados.push(e.numero);

                        datos_clientes.push(e.cliente);
                        datos_vendedores.push(e.user);
                        // console.log(e);
                        // personas = [
                        //     cliente_nombre=e.cliente.nombre,
                        // ]


                    });

                    // console.log(datos_clientes);
                    // Convertimos los montos a dos decimales
                    // for (let numero in montosPorNumero) {
                    //     montosPorNumero[numero] = montosPorNumero[numero].toFixed(2);
                    // }

                    // console.log(datos_vendedores);

                    // Iterar sobre cada sección
                    secciones.forEach(section => {
                        // Agrupar en filas de 10
                        for (let i = 0; i < section.length; i += 10) {
                            template += '<tr class="text-center">';
                            for (let j = i; j < i + 10 && j < section.length; j++) {
                                const numero = section[j];
                                const numeroFormateado = numero.toString().padStart(3, '0');
                                // Comprobar si el número está en la lista de comprados
                                // const esComprado = numeros_comprados.includes(numero);
                                //se cambia el metodo includes a indexOf para obtener la posicion del numero encontrado y usar ese dato en el array datos_clientes
                                //el resto del codigo queda igual, no se afecta mas nada
                                const esComprado = numeros_comprados.indexOf(numero)
                                // console.log(datos_clientes[esComprado] ? datos_clientes[esComprado].id : '');
                                // Obtener el monto correspondiente al número, o 0 si no existe
                                const montoT = montosPorNumero[numero] ? parseFloat(montosPorNumero[numero]) : 0;
                                const claseComprado = montoT < PrecioRifa ? 'btn-warning' : 'btn-info';
                                // Si está comprado, agregar la clase que cambia el color
                                const btnNumero = esComprado != -1 ? `<button type="button" class="btn btn-lg modalLibear border ${claseComprado}" data-clienteId ="${datos_clientes[esComprado].id}" data-ci ="${datos_clientes[esComprado].cedula}" data-nombre ="${datos_clientes[esComprado].nombre}" data-direccion ="${datos_clientes[esComprado].direccion}" data-tlf ="${datos_clientes[esComprado].telefono}" data-email ="${datos_clientes[esComprado].email}"  data-number="${numero}" data-numberF="${numeroFormateado}">${numeroFormateado}</button>` :
                                    `<button type="button" class="btn btn-lg btn-light border modalNumber" data-number="${numero}" data-numberF="${numeroFormateado}">${numeroFormateado}</button>`;

                                template += `<td>${btnNumero}</td>`;

                            }
                            template += '</tr>';
                        }
                    });

                    // Insertar el template generado en el cuerpo de la tabla
                    $('tbody').html(template);
                })
                .catch(error => console.error('Error:', error));
        }
        tablaNumeros();

        // funcion para abrir el modal al hacer click en el numero de la lista
        $(document).on('click', '.modalNumber', function(e) {
            e.preventDefault();
            let numero = $(this).attr('data-number'); //numero que utilizare en la consulta
            let numeroF = $(this).attr('data-numberF'); //numero fromateado que uso en la vista del modal
            $("#number-rifa").html(`<h3 class="text-dark">${numeroF}</h3>`); // Numero que se muestra en la vista del modal
            $("#number").val(numero)
            getClientes(); //afuncion que llena el selecte2 con los datos del cliente
            $('#modal-rifa').modal('show'); //Abre el modal 
        })
        //Funcion que consulta los clientes registrados en el sistema
        function getClientes() {
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
                    template = `<option value="" selected="selected"></option>`
                    data.data.forEach(e => {
                        template += `<option value="${e.cedula}">${e.cedula} - ${e.nombre}</option>`;
                    });
                    $('#cedula').html(template);

                })
                .catch(error => console.error('Error:', error));
        }
        // Funcion para agregar Numero a la lista de pagos
        $(document).on('submit', '#form-add', function(e) {
            e.preventDefault();
            let form = new FormData(this);
            form.delete('_method');
            fetch('api/pagos', {
                    method: 'POST',
                    body: form,
                    headers: {
                        // 'Authorization': 'Bearer ' + token, 
                    }
                })
                .then(res => res.json())
                .then(function(data) {
                    if (data.status) {
                        Swal.fire(
                            '¡Perfecto!',
                            data.message,
                            'success'
                        )
                        //console.log(data);
                        $('#form-add').trigger('reset');
                        tablaNumeros();
                        $('#modal-rifa').modal('hide');
                    }
                    if (!data.status) {

                        template = `
                            <div>
                                <ol>     
                        `;
                        if (data.mjs) {
                            template += "<li class='text-left text-danger'>" + data.mjs + "</li>";
                        } else {

                            $.each(data.errors, function(key, value) {
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

        $(document).on('click', '.modalLibear', function(e) {
            e.preventDefault();
            let cliente_id = $(this).attr('data-clienteId');
            let cliente_ci = $(this).attr('data-ci');
            let cliente_nombre = $(this).attr('data-nombre');
            let cliente_direccion = $(this).attr('data-direccion');
            let cliente_telefono = $(this).attr('data-tlf');
            let cliente_email = $(this).attr('data-email');
            let numero = $(this).attr('data-number');
            let numeroF = $(this).attr('data-numberF');
            $("#number-comprado").html(`<h3 class="text-dark">${numeroF}</h3>`); // Numero que se muestra en la vista del modal
            $(".cliente").html(`<b>Cliente: </b> ${cliente_nombre} <b>Cedula: </b> ${cliente_ci}`)
            // $("#number").val(numero)
            // $("#cedula").val(cliente_ci);
            // $("#nombre").val(cliente_nombre);
            $(".direccion").html(`<b>Dirección: </b> ${cliente_direccion}</p>`);
            // $("#telefono").val(cliente_telefono);
            // $("#email").val(cliente_email);
            $('#modal-liberar').modal('show'); //Abre el modal 
        })



    });
</script>
@endsection