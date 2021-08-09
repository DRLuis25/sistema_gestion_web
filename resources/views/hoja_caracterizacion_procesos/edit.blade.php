@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('models/hojaCaracterizacionProcesos.singular')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($hojaCaracterizacionProcesos, ['route' => ['hojaCaracterizacionProcesos.update',$company_id,$process_map_id, $hojaCaracterizacionProcesos->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('hoja_caracterizacion_procesos.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('hojaCaracterizacionProcesos.index',[$company_id,$process_map_id]) }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
