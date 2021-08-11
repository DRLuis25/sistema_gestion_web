@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>@lang('models/processCriterios.plural')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2 ">
                        {!! Form::open(['route' => ['storePriorizar',$company_id, $process_map_id],'enctype'=>'multipart/form-data']) !!}
                        <label for="">Número de procesos a priorizar</label>
                    </div>
                    <div class="input-group col-2">
                        <input type="number" class="form-control" name="nro_priorizar" required min="0" max="{{count($procesosPriorizados)}}">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Priorizar"> &nbsp;

                </div><br>
                <div class="row">
                    <div class="col-2">
                        <label for="">Descripción: </label>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="description" required >
                    </div>
                    {!! Form::close() !!}
                </div><br>
                    @include('process_criterios.priorizar_table')


                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
