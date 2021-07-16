@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/suppliers.plural')</h1>
                </div>
                <div class="col-sm-6">
                    @can('crear_proveedores')
                    <a class="btn btn-primary float-right"
                       href="{{ route('suppliers.create',[$company_id]) }}">
                       @lang('crud.add_new')
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('suppliers.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

