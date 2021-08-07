<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/processTypes.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/processTypes.fields.type').':') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>
