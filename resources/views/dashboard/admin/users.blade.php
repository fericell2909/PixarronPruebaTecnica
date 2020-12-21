@extends('layouts.app', ['title' => "Categorías"])
@section('content')
    @include('dashboard.partials.nav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="header-body">
            <div class="container-fluid d-flex justify-content-between align-content-center">
                <h1 class="text-white">Mis Usuarios</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">

                    @if(count($users))
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Nombre') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{__('Estado')}}</th>
                                    <th scope="col">{{__('Fecha de Creación')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->active == 1)
                                                <span class="badge badge-primary badge-pill">{{ __('Activo') }}</span>
                                            @else
                                                <span class="badge badge-danger badge-pill">{{ __('Inactivo') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format(env('DATETIME_DISPLAY_FORMAT','d M Y H:i')) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $users->appends(Request::all())->links() }}
                            </nav>
                        </div>
                    </div>
                    @endif
                    <div class="card-footer py-4">
                        @if(count($users))
                            <nav class="d-flex justify-content-end" aria-label="...">
                            </nav>
                        @else
                            <h4>{{ __('No Existen Usuarios') }} ...</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
