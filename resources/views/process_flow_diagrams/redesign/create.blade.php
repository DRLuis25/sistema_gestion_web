@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('models/processFlowDiagrams.singular')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card" >

            <form action="{{route('storeProcessFlowDiagramRedesignApplication',[$company_id, $process_map_id,$process_flow_diagram_id])}}" id="createFlowDiagram-form" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        @include('process_flow_diagrams.fields')
                    </div>
                    <div id="canvas" class="canvas" style="height: 35rem;"></div>

                </div>

                <div class="card-footer">
                    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('processFlowDiagrams.index',[$company_id, $process_map_id]) }}" class="btn btn-default">@lang('crud.cancel')</a>
                </div>
            </form>
            <button id="save-button" hidden>Exportar</button>

        </div>
    </div>
@endsection
