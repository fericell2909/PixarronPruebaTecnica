@extends('layouts.app')
@section('content')
@include('dashboard.partials.nav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="header-body">
            <div class="container-fluid d-flex justify-content-between align-content-center">
                <h1 class="text-white">Listado de Productos</h1>
            </div>
        </div>
    </div>
<div class="container-fluid mt--7">
    <div class="row">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
          </div>
            <table id="tbl__products" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="text-align: center;">Precio</th>
                        <th style="text-align: center;">Disponible</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $items as $item)
                            <tr>
                                <td><img class="rounded" src={{ $item->image }} alt="{{$item->name}}" width="50px" height="50px"></img></td>
                                <td>{{ substr($item->name,0,20)  . ((strlen($item->name) > 19) ? ' . . .' : '')  }}</td>
                                <td>{{ substr($item->description,0,20) . ((strlen($item->description) > 19) ? ' . . .' : '')  }}</td>
                                <td style="text-align: center;">
                                    <span class="badge badge-primary badge-pill"> {{ env('CASHIER_CURRENCY','S/. ')}} {{ $item->price  }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if($item->active == 1)
                                        <span class="text-success mr-2">SI</span>
                                    @else
                                        <span class="text-danger mr-2">NO</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at  }}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"></script>
    <script>

    </script>
    <script>

        $(document).ready(function() {
            var table = $('#tbl__products').DataTable( {
                "scrollX": true ,
                "language" : {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ productos",
                        "sZeroRecords":    "No se encontraron productos",
                        "sEmptyTable":     "Ningún dato disponible en este Menú",
                        "sInfo":           "Del _START_ al _END_ de un total de _TOTAL_ productos",
                        "sInfoEmpty":      "Del  0 al 0 de un total de 0 productos",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ productos)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        }
                    }
                 });

        } );

    </script>
@endsection
