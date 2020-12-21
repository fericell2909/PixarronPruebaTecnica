@extends('layouts.app', ['title' => "Categorías"])
@section('content')
    @include('dashboard.partials.nav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="header-body">
            <div class="container-fluid d-flex justify-content-between align-content-center">
                <h1 class="text-white">Mis Direcciones</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">

                    @if(count($addresses))
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Direccion') }}</th>
                                    <th scope="col">{{ __('Referencia') }}</th>
                                <th scope="col">{{__('Estado')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td>{{$address->address}}</td>
                                        <td>{{$address->reference}}</td>
                                        <td><span class="badge badge-success badge-pill">Activo</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <div class="card-footer py-4">
                        @if(count($addresses))
                            <nav class="d-flex justify-content-end" aria-label="...">
                            </nav>
                        @else
                            <h4>{{ __('No Tiene Direcciones Asociadas') }} ...</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
