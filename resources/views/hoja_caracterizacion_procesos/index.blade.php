@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/hojaCaracterizacionProcesos.plural')</h1>
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
                        {!! Form::open(['route' => ['hojaCaracterizacionProcesos.create',$company_id, $process_map_id],'enctype'=>'multipart/form-data']) !!}
                        <select name="proceso_id" id="select_proceso_id" class="form-control" required>
                            <option value="">Seleccione un proceso</option>
                            @foreach ($procesosSinHojaCaracterizacion as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group col-2 col-md-4 col-sm-6">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="file" required aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Buscar archivo</label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Subir"> &nbsp;

                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['hojaCaracterizacionProcesos.create2',$company_id, $process_map_id]]) !!}
                         <input type="hidden" name="process_id" id="hid_process_id" required>
                        <input type="submit" class="btn btn-secondary" id="btn-añadir" value="Añadir Nuevo" disabled>
                    {!! Form::close() !!}
                </div><br>
                @include('hoja_caracterizacion_procesos.table')
                @include('hoja_caracterizacion_procesos.upload')

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
    $(document).ready(function() {
        $("#uploadButton").click(function(){
            alert("button");
        });
    });
    $('#select_proceso_id').on('change', function () {
        $('#btn-añadir').prop('disabled', !$(this).val());
        $('#hid_process_id').val($(this).val());
    }).trigger('change');
</script>
@endpush
