<!-- Process Id Field -->
<div class="col-sm-6">
    {!! Form::label('process_id', __('models/hojaCaracterizacionProcesos.fields.process_id').':') !!}
    <p>{{ $hojaCaracterizacionProcesos->process->name }}</p>
</div>
<!-- Propietario Id Field -->
<div class="form-group col-sm-6">
    <label for="">Propietario</label>
    <p>{{ $hojaCaracterizacionProcesos->propietario }}</p>
</div>


<!-- Registros Data Field -->
<div class="col-sm-12">
    {!! Form::label('registros_data', __('models/hojaCaracterizacionProcesos.fields.registros_data').':') !!}
    <p>{{ $hojaCaracterizacionProcesos->registros_data }}</p>
</div>

<!-- Variables Control Data Field -->
<div class="col-sm-12">
    {!! Form::label('variables_control_data', __('models/hojaCaracterizacionProcesos.fields.variables_control_data').':') !!}
    <p>{{ $hojaCaracterizacionProcesos->variables_control_data }}</p>
</div>

<!-- Indicadores Data Field -->
<div class="col-sm-12">
    {!! Form::label('indicadores_data', __('models/hojaCaracterizacionProcesos.fields.indicadores_data').':') !!}
    <p>{{ $hojaCaracterizacionProcesos->indicadores_data }}</p>
</div>

<table class="table">
    <tr>
        <td>Misión:</td>
        <td colspan="3">
            <p>{{ $hojaCaracterizacionProcesos->mision }}</p>
        </td>
    </tr>
    <tr>
        <td rowspan="3" class="text-center" >Alcance:</td>
        <td >Empieza:</td>
        <td><p>{{ $hojaCaracterizacionProcesos->empieza }}</p></td>
    </tr>
    <tr>
        <td>Incluye:</td>
        <td><p>{{ $hojaCaracterizacionProcesos->incluye }}</p></td>
    </tr>
    <tr>
        <td>Termina</td>
        <td><p>{{ $hojaCaracterizacionProcesos->termina }}</p></td>
    </tr>
    <tr>
        <td>Entradas:</td>
        <td colspan="3">
            <p>{{ $hojaCaracterizacionProcesos->entradas_data }}</p>
        </td>
    </tr>
    <tr>
        <td>Proveedores:</td>
        <td colspan="3">
            <p>{{ $hojaCaracterizacionProcesos->proveedores_data }}</p>
        </td>
    </tr>
    <tr>
        <td>Salidas:</td>
        <td colspan="3">
            <p>{{ $hojaCaracterizacionProcesos->salidas_data }}</p>
        </td>
    </tr>
    <tr>
        <td>Clientes:</td>
        <td colspan="3">
            <p>{{ $hojaCaracterizacionProcesos->clientes_data }}</p>
        </td>
    </tr>
    <tr>
        <td colspan="2" >
            <p>Inspecciones:</p>
            <p>{{ $hojaCaracterizacionProcesos->inspecciones_data }}</p>
            {{-- <div style="height: 250px !important; overflow: scroll;">
                <ul>
                    @foreach (json_decode($hojaCaracterizacionProcesos->inspecciones_data) as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div> --}}
        </td>
        <td colspan="2">Registros: <br>
            <p>{{ $hojaCaracterizacionProcesos->registros_data }}</p>
        </td>
    </tr>
    <tr>
        <td colspan="2">Variables de control: <br>
            <p>{{ $hojaCaracterizacionProcesos->variables_control_data }}</p>
        </td>
        <td colspan="2">Indicadores: <br>
            <p>{{ $hojaCaracterizacionProcesos->indicadores_data }}</p>
        </td>
    </tr>

</table>
