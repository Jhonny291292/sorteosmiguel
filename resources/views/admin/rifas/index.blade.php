@extends('layouts.app')

@section('title')
Rifas
@endsection

@section('css')
<style>

</style>
@endsection

@section('modals')
<!-- Modal Create Cliente -->
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
    // let numeros = [];
    // let secciones = [];
    // let numeros_comprados = [];
    // // funcion para armar tabla de numeros
    // function tablaNumeros(){
    //     let template = '';
    //     // Generar números del 0 al 999
    //     for (let i = 0; i < 1000; i++) {
    //         numeros.push(i);
    //     }
    //     // Agrupar en secciones de 100
    //     for (let i = 0; i < numeros.length; i += 100) {
    //         secciones.push(numeros.slice(i, i + 100));
    //     }

    //     fetch('api/rifas', {
    //                 method: 'GET',
    //                 headers: {
    //                     'Content-Type': 'application/json'
    //                 }
    //             })
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error('Error en la consulta...');
    //         }
    //             return response.json();
    //     })
    //     .then(data => {
    //         //console.log(data);
    //         data.data.forEach(e => {
    //           //console.log(e);
    //           numeros_comprados.push(e.numero);
    //         });
           
    //         console.log(numeros_comprados);

    //         // Iterar sobre cada sección
    //         secciones.forEach(section => {
    //             // Agrupar en filas de 10
    //             for (let i = 0; i < section.length; i += 10) {
    //                 template += '<tr class="text-center">';
    //                     for (let j = i; j < i + 10 && j < section.length; j++) {
    //                         const numeroFormateado = section[j].toString().padStart(3, '0');
    //                         template += `<td>
    //                                 <button type="button" class="btn btn-lg btn-light border modalNumber" data-number="${section[j]}" data-numberF="${numeroFormateado}">${numeroFormateado}</button>
    //                             </td>`;
    //                     }
    //                 template += '</tr>';
    //             }
    //         });
    //         $('tbody').html(template);


    //     })
    //     .catch(error => console.error('Error:', error));
    // }
    function tablaNumeros() {
    let template = '';
    let numeros = [];
    let secciones = [];
    let numeros_comprados = [];

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
            numeros_comprados.push(e.numero);
        });

        // Iterar sobre cada sección
        secciones.forEach(section => {
            // Agrupar en filas de 10
            for (let i = 0; i < section.length; i += 10) {
                template += '<tr class="text-center">';
                for (let j = i; j < i + 10 && j < section.length; j++) {
                    const numero = section[j];
                    const numeroFormateado = numero.toString().padStart(3, '0');

                    // Comprobar si el número está en la lista de comprados
                    const esComprado = numeros_comprados.includes(numero);

                    // Si está comprado, agregar la clase que cambia el color
                    const claseComprado = esComprado ? 'btn-danger' : 'btn-light';

                    template += `<td>
                        <button type="button" class="btn btn-lg ${claseComprado} border modalNumber" data-number="${numero}" data-numberF="${numeroFormateado}">
                            ${numeroFormateado}
                        </button>
                    </td>`;
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

    // var numeros_comprados = [5, 15, 100, 250, 999];

    // // Comparar y mostrar en consola
    // secciones.forEach((seccion, index) => {
    //     seccion.forEach(numero => {
    //         if (numeros_comprados.includes(numero)) {
    //            // console.log(`El número ${numero} está en la sección ${index + 1}`);
    //         }
    //     });
    // });

// funcion para abrir el modal al hacer click en el numero de la lista
    $(document).on('click', '.modalNumber', function(e){
        e.preventDefault();
        let numero = $(this).attr('data-number'); //numero que utilizare en la consulta
        let numeroF = $(this).attr('data-numberF'); //numero fromateado que uso en la vista del modal
        $("#number-rifa").html(`<h3 class="text-dark">${numeroF}</h3>`);// Numero que se muestra en la vista del modal
        $("#number").val(numero)
        getClientes();//afuncion que llena el selecte2 con los datos del cliente
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
            template =`<option value="" selected="selected"></option>`
            data.data.forEach(e => {
                template+= `<option value="${e.cedula}">${e.cedula} - ${e.nombre}</option>`;
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



        // ConsultarNummeros();

        // function ConsultarNummeros() {
        //     fetch('api/rifas', {
        //             method: 'GET',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             }
        //         })
        //         .then(response => {
        //             if (!response.ok) {
        //                 throw new Error('Error en la consulta...');
        //             }
        //             return response.json();
        //         })
        //         .then(data => {
        //             console.log(data);
        //             data.data.forEach(e => {

        //             });


        //         })
        //         .catch(error => console.error('Error:', error));
        // }
});
</script>
@endsection