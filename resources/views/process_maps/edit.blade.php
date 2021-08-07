@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('models/processMaps.singular')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($processMap, ['route' => ['processMaps.update', $company_id, $processMap->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    <!-- Business Unit Id Field -->
                    {!! Form::hidden('business_unit_id', $processMap->business_unit_id) !!}
                    @include('process_maps.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ url()->previous() }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
