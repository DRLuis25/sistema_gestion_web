<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/objectives.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Perspective Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('perspective_id', __('models/objectives.fields.perspective_id').':') !!}
    {!! Form::number('perspective_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', __('models/objectives.fields.descripcion').':') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', __('models/objectives.fields.level').':') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div>
