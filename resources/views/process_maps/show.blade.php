@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/processMaps.singular')</h1>
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

    <div class="content px-3">
        @include('flash::message')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('process_maps.show_fields')
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @canany('crear_proceso','registrar_proceso','actualizar_proceso','eliminar_proceso')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="proceso-tab" data-toggle="tab" href="#proceso" role="tab" aria-controls="proceso" aria-selected="false">Procesos</a>
                        </li>
                    @endcan
                    @canany('crear_mapa_proceso','registrar_mapa_proceso','actualizar_mapa_proceso','eliminar_mapa_proceso')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="mapaProceso-tab" data-toggle="tab" href="#mapaProceso" role="tab" aria-controls="mapaProceso" aria-selected="true">Mapa Proceso</a>
                        </li>
                    @endcan
                    @canany('leer_historial_mapa_proceso','eliminar_historial_mapa_proceso')
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                        </li>
                    @endcan
                </ul>
                <div class="tab-content" id="myTabContent">
                    @include('process_maps.process.content')
                    @include('process_maps.process_map.content')
                    @include('process_maps.historial.content')
                </div>
            </div>

        </div>
    </div>
@endsection
