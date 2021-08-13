@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['processCriterios.store',$company_id,$process_map_id]]) !!}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>@lang('models/processCriterios.plural')</h1>
                </div>
                <div class="col-sm-4">
                    <a hidden href="{{route('selectPriorizar',[$company_id, $process_map_id])}}" id="asdasd" class="btn btn-secondary float-right">Priorizar</a>

                    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary float-right']) !!}
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">

                    @include('process_criterios.table')


                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@endsection

