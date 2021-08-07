@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/seguimientos.plural')</h1>
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
                            {!! Form::open(['route' => ['seguimientos.create',$company_id,$process_map_id]]) !!}
                            <select name="proceso_id" id="select_proceso_id" class="form-control" required>
                                <option value="">Seleccione un proceso</option>
                                @foreach ($procesosSinSeguimiento as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Añadir">
                    {!! Form::close() !!}
                </div><br>
                @include('seguimientos.table_index')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $("#btnNuevo").on('click',function(){
                if($("#select_proceso_id").find('option:selected').val()=="No")
                    {alert('a');
                    //$("#btnNuevo").attr('disabled',true)}
                else
                    $("#btnNuevo").attr('disabled',false)
            });
        })
    </script>
@endpush
