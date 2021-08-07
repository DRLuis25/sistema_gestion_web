@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/seguimientos.singular') Company_id: {{$company_id}} - processMap_id: {{$process_map_id}} - process_id: {{$process_id}}</h1>
                </div>
                <div class="col-sm">
                    @include('seguimientos.activity.create') &nbsp;
                    <a class="btn btn-default float-right"
                       href="{{ route('seguimientos.index',[$company_id,$process_map_id]) }}">
                        @lang('crud.back')
                    </a>
                    <button type="button" class="btn btn-primary float-right"
                        data-toggle="modal" data-target="#activityModal"
                        data-whatever="Registrar">
                        @lang('crud.add_new')
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                @include('seguimientos.table')
            </div>

        </div>
    </div>
@endsection
