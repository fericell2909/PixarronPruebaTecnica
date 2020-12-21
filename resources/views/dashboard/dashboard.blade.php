@extends('layouts.app', ['title' => "Mi DashBoard"])
@section('content')
    @include('dashboard.partials.nav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="header-body">
            <div class="container-fluid d-flex justify-content-between align-content-center">
                <h1 class="text-white">Mi Tablero</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <h1 class="text-center">Desafío</h1>
                    <img src="https://www.pixarron.com/wp-content/uploads/2020/07/Pixa-logo.png" alt="Logo de Pixarron">
                </div>
            </div>
        </div>
    </div>
@endsection
