@extends('layouts.app', ['title' => "Mi Perfil"])
@section('content')
    @include('dashboard.partials.nav')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="header-body">
            <div class="container-fluid d-flex justify-content-between align-content-center">
                <h1 class="text-white">Mi Perfil</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <h6 class="heading-small text-muted ml-4 mt-4 mb-4">{{ __('Mi Informacion Personal') }}</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">{{ __('Nombre') }}</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control form-control-alternative" placeholder="{{ __('Nombre') }}"
                                        value="{{ $user->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                    <input type="text" name="email" id="email"
                                        class="form-control form-control-alternative" placeholder="{{ __('Owner Email') }}"
                                        value="{{ $user->email }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
