@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('models/supplyChains.singular')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => ['supplyChains.store', $company_id]]) !!}

            <div class="card-body">

                <div class="row">
                    <!-- Business Unit Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('business_unit_id', __('models/supplyChains.fields.business_unit_id').':') !!}
                        <select name="business_unit_id" id="business_unit_id" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            @foreach ($business_units as $business_unit)
                                <option value="{{$business_unit->id}}">{{$business_unit->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @include('supply_chains.fields')
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
