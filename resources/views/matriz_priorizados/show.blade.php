@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/processes.plural') priorizados</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('matrizPriorizados.index',[$company_id,$process_map_id]) }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('matriz_priorizados.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
