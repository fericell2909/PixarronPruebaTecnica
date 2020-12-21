@extends('layouts.app')
@section('content')
@include('dashboard.partials.nav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="header-body">
            <div class="container-fluid d-flex justify-content-between align-content-center">
                <h1 class="text-white">Listado de Ordenes - Usuario</h1>
            </div>
        </div>
    </div>
<div class="container-fluid mt--7">
    <div class="row">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
          </div>
          <div class="tab-content orders-filters">
            <div class="row">
                <form method="GET" action="{{ route('dashboard.admin.orders.user',['token' => $uuid]) }}" style="width: 100%;">
                    <div class="row">
                        <div class="col-md-4 ml-4">
                            <div class="form-group ">
                                <label class="form-control-label" for="client">{{ __('Filtro por Cliente') }}</label>

                                <select class="form-control select2" id="client_id" name="client_id">
                                    <option disabled selected value> -- {{ __('Elija un Cliente') }} --</option>
                                    @foreach ($users as $client)
                                    <option <?php if (isset($_GET['client_id']) && $_GET['client_id'] . "" == $client->uuid . "") {
                                        echo "selected";
                                    } ?>  value="{{ $client->uuid }}">{{$client->name}} - {{$client->email}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                              @if ($parameters)
                                <div class="col-md-4 mt-4">
                                  <a href="{{ route('dashboard.admin.orders.user',['token' => $uuid]) }}" class="btn btn-md btn-block">{{ __('Borrar Filtros') }}</a>
                                </div>
                              @endif

                              <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary btn-md btn-block">{{ __('Buscar') }}</button>
                              </div>
                            </div>
                        </div>
                    </div>

            </div>
          </div>

          @if(count($orders))
            <div class="table-responsive">
              <table class="table align-items-center">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">{{ __('ID') }}</th>

                    <th class="table-web" scope="col">{{ __('Fecha de Creacion') }}</th>
                    <th class="table-web" scope="col">{{ __('Metodo de Pago') }}</th>
                    <th scope="col">{{ __('Estado') }}</th>
                    <th class="table-web" scope="col">{{ __('Cliente') }}</th>
                    <th class="table-web" scope="col">{{ __('Dirección') }}</th>
                    <th class="table-web" scope="col">{{ __('Productos') }}</th>
                    <th class="table-web" scope="col">{{ __('Precio') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>
                        <span class="btn badge badge-success badge-pill" >#{{ $order->id }}</span>
                      </td>
                      <td class="table-web">
                        {{ $order->created_at->format(env('DATETIME_DISPLAY_FORMAT','d M Y H:i')) }}
                      </td>
                      <td class="table-web">
                          <span class="badge badge-primary badge-pill">{{ $order->payment_method }}</span>
                      </td>
                      <td>
                        @if($order->active == 1)
                          <span class="badge badge-primary badge-pill">{{ __('Activo') }}</span>
                        @else
                            <span class="badge badge-danger badge-pill">{{ __('Inactivo') }}</span>
                        @endif
                      </td>
                      <td class="table-web">
                        {{ $order->client->name }}
                      </td>
                      <td class="table-web">
                        {{ $order->address->address }}
                      </td>
                      <td class="table-web">
                        {{ $order->items->pluck('name')->join(',') }}
                      </td>

                      <td class="table-web">
                        {{ env('CASHIER_CURRENCY','S/. ')}} {{ $order->order_price  }}
                      </td>

                    </tr>

                    @endforeach
                </tbody>

              </table>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $orders->appends(Request::all())->links() }}
                </nav>
            </div>
            @else
                <h4 class="ml-4">{{ __('No Tiene Ordenes Asociadas para el usuario Seleccionado') }} ...</h4>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
