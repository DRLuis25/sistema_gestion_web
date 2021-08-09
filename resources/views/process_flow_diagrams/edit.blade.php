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

        <div class="card">

            <form action="{{route('processFlowDiagrams.update',[$company_id, $process_map_id, $processFlowDiagram->id])}}" id="updateFlowDiagram-form" method="POST">
                @csrf
                {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="row">
                    @include('process_flow_diagrams.edit_fields')
                </div>
                <div id="canvas" class="canvas" style="height: 35rem;"></div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('processFlowDiagrams.index',[$company_id, $process_map_id]) }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

            </form>
        </div>
    </div>
@endsection
