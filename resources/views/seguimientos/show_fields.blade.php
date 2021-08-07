<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/seguimientos.fields.process_id').':') !!}
    <p>{{ $seguimiento->process_id }}</p>
</div>

<!-- Activity Field -->
<div class="col-sm-12">
    {!! Form::label('activity', __('models/seguimientos.fields.activity').':') !!}
    <p>{{ $seguimiento->activity }}</p>
</div>

<!-- Rol Id Field -->
<div class="col-sm-12">
    {!! Form::label('rol_id', __('models/seguimientos.fields.rol_id').':') !!}
    <p>{{ $seguimiento->rol_id }}</p>
</div>

<!-- Flow Id Field -->
<div class="col-sm-12">
    {!! Form::label('flow_id', __('models/seguimientos.fields.flow_id').':') !!}
    <p>{{ $seguimiento->flow_id }}</p>
</div>

<!-- Time Field -->
<div class="col-sm-12">
    {!! Form::label('time', __('models/seguimientos.fields.time').':') !!}
    <p>{{ $seguimiento->time }}</p>
</div>

