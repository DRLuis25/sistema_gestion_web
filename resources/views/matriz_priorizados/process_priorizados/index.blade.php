@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/matrizPriorizados.plural')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('matrizPriorizados.show',[$company_id,$process_map_id,$matriz_priorizado_id]) }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Proceso:</label>
                    <p>{{$proceso->name}}</p>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="perspectivas-tab" data-toggle="tab" href="#perspectivas" role="tab" aria-controls="perspectivas" aria-selected="true">Perspectivas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="objetivos-tab" data-toggle="tab" href="#objetivos" role="tab" aria-controls="objetivos" aria-selected="false">Objetivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="grafico-tab" data-toggle="tab" href="#grafico" role="tab" aria-controls="grafico" aria-selected="false">Gráfico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="historial-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="indicadores-tab" data-toggle="tab" href="#indicadores" role="tab" aria-controls="indicadores" aria-selected="false">Indicadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tablero_comando-tab" data-toggle="tab" href="#tablero_comando" role="tab" aria-controls="tablero_comando" aria-selected="false">Tablero de comando</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="perspectivas" role="tabpanel" aria-labelledby="perspectivas-tab">
                        @include('matriz_priorizados.process_priorizados.perspectivas.content')
                    </div>
                    <div class="tab-pane fade" id="objetivos" role="tabpanel" aria-labelledby="objetivos-tab">
                        @include('matriz_priorizados.process_priorizados.objetivos.content')
                    </div>
                    <div class="tab-pane fade" id="grafico" role="tabpanel" aria-labelledby="grafico-tab">
                        @include('matriz_priorizados.process_priorizados.grafico.content')
                    </div>
                    <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="historial-tab">
                        @include('matriz_priorizados.process_priorizados.historial.content')
                    </div>
                    <div class="tab-pane fade" id="indicadores" role="tabpanel" aria-labelledby="indicadores-tab">
                        @include('matriz_priorizados.process_priorizados.indicadores.content')
                    </div>
                    <div class="tab-pane active show" id="tablero_comando" role="tabpanel" aria-labelledby="tablero_comando-tab">
                        @include('matriz_priorizados.process_priorizados.tablero_comando.content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

