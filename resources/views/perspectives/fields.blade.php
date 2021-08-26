<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/perspectives.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', __('models/perspectives.fields.descripcion').':') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>
