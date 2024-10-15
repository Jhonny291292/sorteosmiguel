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
                                <input type="number" step="0.01" class="form-control text-right" id="monto" name="monto">
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

            <div id="contenido-imprimir">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modal-title"><b>Número de Rifa</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&minus;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center" id="number-comprado">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="text-dark ps-1 vendedor"></p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-dark ps-1 cliente"></p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-dark ps-1 direccion"></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-dark ps-1 telefono"></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-dark ps-1 correo"></p>
                        </div>
                    </div>
                    <div class="row">
                        <form id="form-abono" class="form-inline" autocomplete="off">
                            @csrf
                            <input type="hidden" id="user_id_abono" name="user_id" value="{{auth()->user()->id}}">
                            <input type="hidden" id="number_abono" name="number">
                            <input type="hidden" id="id_cliente" name="id_cliente">
                            <input type="hidden" id="cedula_abono" name="cedula">
                            <div class="form-group mx-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Monto $</b></span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control text-right" id="abono" name="monto">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mb-2">
                                Abonar
                            </button>
                        </form>
                    </div>
                    <hr>
                    <div class="text-center mb-2"><b>Pagos del Número</b></div>
                    <div class="table-responsive p-0" {{--style="height: 120px;"--}}>
                        <table class="table table-bordered table-head-fixed table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha de Pago</th>
                                    <th class="text-center">Monto Pagado</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-pagos">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-success " id="printBtn"> <i class="fas fa-file-pdf"></i> Reporte</button>
                <button type="button" class="btn btn-danger" id="btn-liberar">
                    ¿Quiere liberar este número?
                </button>
            </div>
        </div>
    </div>
</div>

<!--Modal de lista de numeros faltantes por vender-->
<div class="modal fade" id="modal-numerosFaltantes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><b>Números por vender</b></h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&minus;</span>
                </button> --}}
                <button type="button" class="btn btn-secondary " id="printBtn2"> <i class="fas fa-file-pdf"></i> Imprimir Reporte</button>
            </div>
            <div id="contenido-imprimir2">
                <div class="modal-body p-0">
                    <table class="table table-bordered table-head-fixed table-sm text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center text-dark faltan" colspan="10"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-faltantes">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal de Ventas-->
<div class="modal fade" id="modal-ventas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><b>Total de Ventas</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&minus;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div id="contenido-imprimir3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title text-dark">El total de recaudado, hasta este momento, con la venta de los números de la rifa es de: </h5>
                            <p class="card-text text-dark h4 totalV"></p>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " id="printBtn3"> <i class="fas fa-file-pdf"></i> Imprimir Reporte</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="clearfix">
                    <h5 class="card-title text-dark float-left"> <i class="fa fa-th"></i> <b>Rifa</b></h5>
                    <button type="button" class="btn btn-success float-right ml-sm-0 ml-md-2 mb-2" id="btn-venta">Total en Ventas</button>
                    <button type="button" class="btn btn-success float-right" id="btn-numerosFaltantes">Números Faltantes</button>
                </div>
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
        const PrecioRifa = 10;
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
        // hacer el reporte de los numeros que faltan por comprar: debo usar el bucle que estou usando para pintar los numeros para que me llene una variable con los que no estan pintados
        // hacer reporte del total de ventas de la rifa: debo hacer una funcion que consulte los montos de todos los numeros que tengan estado comprado y me sume el total
        function tablaNumeros() {
            let template = '',
                template_Faltantes='',
                numeros = [],
                secciones = [],
                numeros_comprados = [],
                montosPorNumero = {},
                datos_clientes = [],
                datos_vendedores = [],
                totalMontosVendidos = 0;
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
                        // Sumar el monto a la variable totalMontosVendidos
                        totalMontosVendidos = data.totalMontosVendidos;
                       
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

                    });

                    // Crear una lista de números no comprados
                    const numeros_no_comprados = numeros.filter(num => !numeros_comprados.includes(num));
                    let n = numeros_no_comprados.length;
                    $(".faltan").html('<h5>Números Faltantes: '+ n+'</h5>');
                    for (let f = 0; f < numeros_no_comprados.length; f += 10){
                        template_Faltantes +='<tr class="text-center">';
                            for (let a = f; a < f + 10 && a < numeros_no_comprados.length; a++){
                                const faltante = numeros_no_comprados[a]
                                template_Faltantes += `<td class="text-dark">${faltante}</td>`;
                            }    
                        template_Faltantes +='</tr>';  
                    }   

                    //Monto total de ventas
                    $(".totalV").html('<b>'+totalMontosVendidos+' $</b>')

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
                                const btnNumero = esComprado != -1 ? `<button type="button" class="btn btn-lg modalLibear border ${claseComprado}" data-montoT="${montoT}" data-vendedor="${datos_vendedores[esComprado].name}" data-clienteId ="${datos_clientes[esComprado].id}" data-ci ="${datos_clientes[esComprado].cedula}" data-nombre ="${datos_clientes[esComprado].nombre}" data-direccion ="${datos_clientes[esComprado].direccion}" data-tlf ="${datos_clientes[esComprado].telefono}" data-email ="${datos_clientes[esComprado].email}"  data-number="${numero}" data-numberF="${numeroFormateado}">${numeroFormateado}</button>` :
                                    `<button type="button" class="btn btn-lg btn-light border modalNumber" data-number="${numero}" data-numberF="${numeroFormateado}">${numeroFormateado}</button>`;

                                template += `<td>${btnNumero}</td>`;

                            }
                            template += '</tr>';
                        }
                    });

                    // Insertar el template generado en el cuerpo de la tabla
                    $('tbody').html(template);
                    $('#tbody-faltantes').html(template_Faltantes);
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
        $(document).on('submit', '#form-add, #form-abono', function(e) {
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
                        $('#form-abono').trigger('reset');
                        tablaNumeros();
                        $('#modal-rifa').modal('hide');
                        $('#modal-liberar').modal('hide');
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
            let vendedor = $(this).attr('data-vendedor');
            let cliente_id = $(this).attr('data-clienteId');
            let cliente_ci = $(this).attr('data-ci');
            let cliente_nombre = $(this).attr('data-nombre');
            let cliente_direccion = $(this).attr('data-direccion');
            let cliente_telefono = $(this).attr('data-tlf');
            let cliente_email = $(this).attr('data-email');
            let numero = $(this).attr('data-number');
            let numeroF = $(this).attr('data-numberF');
            let TotalPagado = $(this).attr('data-montoT');
            $("#number-comprado").html(`<h3 class="text-dark">${numeroF}</h3>`); // Numero que se muestra en la vista del modal
            $(".vendedor").html(`<b>Vendido por: </b>${vendedor}`);
            $(".cliente").html(`<b>Cliente: </b> ${cliente_nombre} <b class="ml-2">Cedula: </b> ${cliente_ci}`)
            $(".direccion").html(`<b>Dirección: </b> ${cliente_direccion}`);
            $(".telefono").html(`<b>Teléfono: </b> ${cliente_telefono}`);
            $(".correo").html(`<b>Correo: </b> ${cliente_email}`);
            $("#number_abono").val(numero);
            $("#id_cliente").val(cliente_id);
            $("#cedula_abono").val(cliente_ci);
            if (TotalPagado < PrecioRifa) {
                $('#form-abono').show();
                $("#printBtn").hide();
            } else {
                $('#form-abono').hide();
                $("#printBtn").show();
            }
            $('#modal-liberar').modal('show'); //Abre el modal 

            showPagos(cliente_id, numero);

        })

        function showPagos(cliente_id, numero) {
            //console.log(numero);
            $("#fila-monto").show();
            fetch(
                    `api/rifas/${cliente_id}/${numero}`, {
                        method: 'GET'
                    }
                ).then(res => res.json())
                .then(function(data) {
                    if (data.status) {
                        var num = 1;
                        var template2 = "";
                        data.data.forEach(e => {
                            // console.log(e);
                            var formattedDate = moment(e.fecha).format('DD/MM/YYYY'); // Cambia el formato según tus necesidades
                            // console.log(formattedDate);
                            template2 += `
                            <tr>
                                <td class="text-center"> ${formattedDate}</td>
                                <td class="text-center"> ${e.monto} $</td>
                            </tr>
                        `;
                        });
                        $('#tbody-pagos').html(template2);
                    }
                }).catch(function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: err
                    })
                })

        }

        $(document).on('click', '#btn-liberar', function(e) {
            e.preventDefault();
            let cliente_id = $("#id_cliente").val();
            let numero = $("#number_abono").val();
            // console.log('el ID del Cliente: ' + cliente_id + 'Numero: ' + numero);

            Swal.fire({
                title: '¿Estás seguro(a) de liberar este número?',
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
                            `api/rifas/${cliente_id}/${numero}`, {
                                method: 'DELETE'
                            }
                        ).then(res => res.json())
                        .then(function(data) {
                            console.log(data);
                            if (data.status) {
                                Swal.fire(
                                    '¡Perfecto!',
                                    data.message,
                                    'success'
                                )
                                $('#form-add').trigger('reset');
                                $('#form-abono').trigger('reset');
                                tablaNumeros();
                                $('#modal-rifa').modal('hide');
                                $('#modal-liberar').modal('hide');
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

        });

        document.getElementById('printBtn').onclick = function() {
            printModalContent();
        };

        function printModalContent() {

            const modalContent = document.querySelector('#contenido-imprimir').innerHTML;

            // Crear una nueva ventana
            const printWindow = window.open('', '', 'height=600,width=800');

            // Escribir el contenido en la nueva ventana
            printWindow.document.write('<html><head><title>Imprimir</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">'); // Incluye CSS si es necesario
            printWindow.document.write('</head><body>');
            printWindow.document.write(modalContent);
            printWindow.document.write('</body></html>');

            printWindow.document.close(); // Cierra el documento para que se renderice
            printWindow.focus(); // Enfoca la ventana

            // Imprimir
            printWindow.print();

            // Cerrar la ventana después de imprimir
            printWindow.onafterprint = function() {
                printWindow.close();
            };

            // const modalContent = document.querySelector('#contenido-imprimir').innerHTML;
            // const originalContent = document.body.innerHTML;

            // document.body.innerHTML = modalContent;

            // window.print();

            // // Restaurar el contenido original
            // document.body.innerHTML = originalContent;
            // Volver a abrir el modal después de imprimir
            // document.getElementById('modal-liberar').style.display = 'block';
        }
        //Funcion para abrir modal de numeros faltantes  
        $(document).on('click', '#btn-numerosFaltantes', function() {
            $("#modal-numerosFaltantes").modal('show');
        })
        // metodo para capturar el click del boton de reporte de numeros faltantes  
        document.getElementById('printBtn2').onclick = function() {
            printModalContent2();
        };
        // funcion print para modal de numeros faltantes
        function printModalContent2() {
            const modalContent2 = document.querySelector('#contenido-imprimir2').innerHTML;

            // Crear una nueva ventana
            const printWindow2 = window.open('', '', 'height=600,width=800');

            // Escribir el contenido en la nueva ventana
            printWindow2.document.write('<html><head><title>Imprimir</title>');
            printWindow2.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">'); // Incluye CSS si es necesario
            printWindow2.document.write('</head><body>');
            printWindow2.document.write(modalContent2);
            printWindow2.document.write('</body></html>');

            printWindow2.document.close(); // Cierra el documento para que se renderice
            printWindow2.focus(); // Enfoca la ventana

            // Imprimir
            printWindow2.print();

            // Cerrar la ventana después de imprimir
            printWindow2.onafterprint = function() {
                printWindow2.close();
            };
        }

        //Funcion para abrir modal de total de ventas
        $(document).on('click', '#btn-venta', function(e) {
            $("#modal-ventas").modal("show");
        })
        // metodo para capturar el click del boton de reporte de total de ventas
        document.getElementById('printBtn3').onclick = function() {
            printModalContent3();
        };
        // funcion print para modal de ventas
        function printModalContent3() {
            const modalContent3 = document.querySelector('#contenido-imprimir3').innerHTML;

            // Crear una nueva ventana
            const printWindow3 = window.open('', '', 'height=600,width=800');

            // Escribir el contenido en la nueva ventana
            printWindow3.document.write('<html><head><title>Imprimir</title>');
            printWindow3.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">'); // Incluye CSS si es necesario
            printWindow3.document.write('</head><body>');
            printWindow3.document.write(modalContent3);
            printWindow3.document.write('</body></html>');

            printWindow3.document.close(); // Cierra el documento para que se renderice
            printWindow3.focus(); // Enfoca la ventana

            // Imprimir
            printWindow3.print();

            // Cerrar la ventana después de imprimir
            printWindow3.onafterprint = function() {
                printWindow3.close();
            };
        }


    });
</script>
@endsection