<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/seguimientoPropuestos.fields.process_id').':') !!}
    <p>{{ $seguimientoPropuesto->process_id }}</p>
</div>

<!-- Rol Id Field -->
<div class="col-sm-12">
    {!! Form::label('rol_id', __('models/seguimientoPropuestos.fields.rol_id').':') !!}
    <p>{{ $seguimientoPropuesto->rol_id }}</p>
</div>

<!-- Activity Field -->
<div class="col-sm-12">
    {!! Form::label('activity', __('models/seguimientoPropuestos.fields.activity').':') !!}
    <p>{{ $seguimientoPropuesto->activity }}</p>
</div>

<!-- Flow Id Field -->
<div class="col-sm-12">
    {!! Form::label('flow_id', __('models/seguimientoPropuestos.fields.flow_id').':') !!}
    <p>{{ $seguimientoPropuesto->flow_id }}</p>
</div>

<!-- Time Field -->
<div class="col-sm-12">
    {!! Form::label('time', __('models/seguimientoPropuestos.fields.time').':') !!}
    <p>{{ $seguimientoPropuesto->time }}</p>
</div>

