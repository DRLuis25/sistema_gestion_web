@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/processFlowDiagrams.plural')</h1>
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
                        {!! Form::open(['route' => ['processFlowDiagrams.create',$company_id, $process_map_id],'enctype'=>'multipart/form-data']) !!}
                        <select name="proceso_id" id="select_proceso_id" class="form-control" required>
                            <option value="">Seleccione un proceso</option>
                            @foreach ($procesosSinFlowDiagram as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group col-2">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="file" required aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Buscar archivo</label>
                        </div>
                      </div>
                    <input type="submit" class="btn btn-primary" value="Subir"> &nbsp;

                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['processFlowDiagrams.create2',$company_id, $process_map_id]]) !!}
                         <input type="hidden" name="process_id" id="hid_process_id" required>
                        <input type="submit" class="btn btn-secondary" id="btn-añadir" value="Añadir Nuevo" disabled>
                    {!! Form::close() !!}
                </div><br>
                @include('process_flow_diagrams.table')
                @include('process_flow_diagrams.redesign.upload')
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
    $('#select_proceso_id').on('change', function () {
    $('#btn-añadir').prop('disabled', !$(this).val());
    $('#hid_process_id').val($(this).val());
    //console.log($('#hid_process_id').val());
}).trigger('change');
</script>
@endpush
