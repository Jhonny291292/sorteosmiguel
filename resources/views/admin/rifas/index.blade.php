@extends('layouts.app')

@section('title')
Rifas
@endsection

@section('modals')
<!-- Modal Create Cliente -->
<div class="modal fade" id="modal-rifa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Rifa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&minus;</span>
                </button>
            </div>
            <form id="form-add">
                @csrf
                <div class="modal-body">


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
                    <h4><i class="fa fa-th"></i> Rifa</h4>
                </div>
                <!-- <div class="col-md-6 text-right" id="btnAdd">
                    <a href="#" class="btn btn-primary btn-sm shadow" id="btn-add" data-toggle="modal"
                        data-target="#modal-rifa"><i class="fa fa-plus"></i> Nuevo Registro</a>
                </div> -->
            </div>
        </div>
        <div class="card-body">
           


        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        // Generar números del 0 al 999
        let numeros = [];
        for (let i = 0; i < 1000; i++) {
            numeros.push(i);
        }

        // Agrupar en secciones de 100
        let secciones = [];
        for (let i = 0; i < numeros.length; i += 100) {
            secciones.push(numeros.slice(i, i + 100));
        }
        console.log(secciones); // Muestra las secciones en la consola

        var numeros_comprados = [5, 15, 100, 250, 999];

        // Comparar y mostrar en consola
        secciones.forEach((seccion, index) => {
            seccion.forEach(numero => {
                if (numeros_comprados.includes(numero)) {
                    console.log(`El número ${numero} está en la sección ${index + 1}`);
                }
            });
        });

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