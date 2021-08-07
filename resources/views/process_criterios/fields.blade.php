<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/processCriterios.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Criterio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('criterio_id', __('models/processCriterios.fields.criterio_id').':') !!}
    {!! Form::number('criterio_id', null, ['class' => 'form-control']) !!}
</div>
