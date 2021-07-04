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

            {!! Form::model($supplyChain, ['route' => ['supplyChains.update', $company_id, $supplyChain->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    <!-- Business Unit Id Field -->
                    {!! Form::hidden('business_unit_id', $supplyChain->business_unit_id) !!}
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
