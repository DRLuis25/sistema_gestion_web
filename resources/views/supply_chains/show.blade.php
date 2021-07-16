@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/supplyChains.singular')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ url()->previous() }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content">

        @include('flash::message')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('supply_chains.show_fields')
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @canany('registrar_proveedor_cadena_suministro','eliminar_proveedor_cadena_suministro')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#suppliers" role="tab" aria-controls="suppliers" aria-selected="false">Proveedores</a>
                        </li>
                    @endcan
                    @canany('registrar_cliente_cadena_suministro','eliminar_cliente_cadena_suministro')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="home-tab" data-toggle="tab" href="#customers" role="tab" aria-controls="home" aria-selected="true">Clientes</a>
                        </li>
                    @endcan
                    @canany('ver_grafico_cadena_suministro','exportar_grafico_cadena_suministro','crear_historial_cadena_suministro')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#graphic" role="tab" aria-controls="graphic" aria-selected="false">Gráfico</a>
                        </li>
                    @endcan
                    @canany('leer_historial_cadena_suministro','eliminar_historial_cadena_suministro')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                        </li>
                    @endcan
                </ul>
                @include('supply_chains.content')
            </div>
        </div>
    </div>
@endsection
