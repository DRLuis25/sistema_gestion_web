<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/seguimientoPropuestos.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rol Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rol_id', __('models/seguimientoPropuestos.fields.rol_id').':') !!}
    {!! Form::number('rol_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Activity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity', __('models/seguimientoPropuestos.fields.activity').':') !!}
    {!! Form::text('activity', null, ['class' => 'form-control']) !!}
</div>

<!-- Flow Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flow_id', __('models/seguimientoPropuestos.fields.flow_id').':') !!}
    {!! Form::number('flow_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', __('models/seguimientoPropuestos.fields.time').':') !!}
    {!! Form::number('time', null, ['class' => 'form-control']) !!}
</div>
