@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/companies.singular')</h1>
                </div>
                <div class="col-sm-6">
                    @can('isSuperAdmin')
                    <a class="btn btn-default float-right"
                        href="{{ route('companies.index') }}">
                        @lang('crud.back')
                    </a>
                    @endcan
                    @can('administrar_empresa')
                        <a class="btn btn-default float-right" hidden
                        href="{{ route('companies.index') }}">
                            @lang('crud.edit')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('companies.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
