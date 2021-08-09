<!-- Process Map Id Field -->
<input type="hidden" name="process_map_id" value="{{$process_map_id}}">
<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/hojaCaracterizacionProcesos.fields.process_id').':') !!}
    <input type="hidden" name="process_id" value="{{$process->id}}">
    <p>{{$process->name}}</p>
</div>
<!-- Propietario Id Field -->
<div class="form-group col-sm-6">
    <label for="">Propietario</label>
    <input type="hidden" name="process_id" value="{{$process->id}}">
    {!! Form::text('propietario', null, ['class' => 'form-control','required']) !!}
</div>
<table class="table">
    <tr>
        <td>Misión:</td>
        <td colspan="3">
            {!! Form::text('mision', null, ['class' => 'form-control','required']) !!}
        </td>
    </tr>
    <tr>
        <td rowspan="3" class="text-center" >Alcance:</td>
        <td >Empieza:</td>
        <td>{!! Form::text('empieza', null, ['class' => 'form-control','colspan'=>'2','required']) !!}</td>
    </tr>
    <tr>
        <td>Incluye:</td>
        <td>{!! Form::text('incluye', null, ['class' => 'form-control','required']) !!}</td>
    </tr>
    <tr>
        <td>Termina</td>
        <td>{!! Form::text('termina', null, ['class' => 'form-control','required']) !!}</td>
    </tr>
    <tr>
        <td>Entradas:</td>
        <td colspan="3">{!! Form::text('entradas_data', null, ['class' => 'form-control','required']) !!}</td>
    </tr>
    <tr>
        <td>Proveedores:</td>
        <td colspan="3">{!! Form::text('proveedores_data', null, ['class' => 'form-control','required']) !!}</td>
    </tr>
    <tr>
        <td>Salidas:</td>
        <td colspan="3">{!! Form::text('salidas_data', null, ['class' => 'form-control','required']) !!}</td>
    </tr>
    <tr>
        <td>Clientes:</td>
        <td colspan="3">{!! Form::text('clientes_data', null, ['class' => 'form-control','required']) !!}</td>
    </tr>
    <tr>
        {{-- <td colspan="2" >
            <p>Inspecciones:</p>
            <div class="row">
                <div class="col-1"></div>
                <input required type="text" onkeypress="return /[a-z]/i.test(event.key)" id="txtTextInspeccion" class="form-control col-8">
                &nbsp;
                <button id="btnAddInspeccion" class="btn btn-primary col-2">Añadir</button> <br>
            </div> <br>
            <div style="height: 250px !important; overflow: scroll;">
                <div class="row" style="width: 100% !important; ">
                    <div class="col-1"></div>
                    <table id="tablaInspeccion" class="table col-10">
                        <th>Nombre</th>
                    </table>
                </div>
            </div>
        </td> --}}
        <td colspan="2">Inspecciones: <br>
            {!! Form::textarea('inspecciones_data', null, ['class' => 'form-control','required','style'=>'height: 120px;']) !!}
        </td>
        <td colspan="2">Registros: <br>
            {!! Form::textarea('registros_data', null, ['class' => 'form-control','required','style'=>'height: 120px;']) !!}
        </td>
    </tr>
    <tr>
        <td colspan="2">Variables de control: <br>
            {!! Form::textarea('variables_control_data', null, ['class' => 'form-control','required','style'=>'height: 120px;']) !!}
        </td>
        <td colspan="2">Indicadores: <br>
            {!! Form::textarea('indicadores_data', null, ['class' => 'form-control','required','style'=>'height: 120px;']) !!}
        </td>
    </tr>

</table>
@push('scripts')
<script>
    function SomeDeleteRowFunction(o) {
     //no clue what to put here?
     var p=o.parentNode.parentNode;
         p.parentNode.removeChild(p);
         return false;
    }
    $("#btnAddInspeccion").click( function(e)
        {
            e.preventDefault();
            if ($("#txtTextInspeccion").val()!=="") {
                let markup =
                `<tr class="text-center">
                    <td class="row">
                        <div class="col-1"> </div>
                        <div class="col-8">`+ $("#txtTextInspeccion").val()+`</div>
                        <input name="inspecciones_data[]" type="text" value="`+$("#txtTextInspeccion").val()+`" hidden>
                        <button onclick="SomeDeleteRowFunction(this)" class="btn btn-danger col-1">X</button>
                    </td>
                </tr>`;
                $("#txtTextInspeccion").val("");
                $("#tablaInspeccion > tbody").append(markup);
                var rowCount = $('#tablaInspeccion tr').length;
                if (rowCount>0) {
                    $('#txtTextInspeccion').prop('required',false);
                }
                else{
                    $('#txtTextInspeccion').prop('required',true);
                }
            }
        }
    );
</script>
@endpush
