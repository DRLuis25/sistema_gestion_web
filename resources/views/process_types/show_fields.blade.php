<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/processTypes.fields.process_id').':') !!}
    <p>{{ $processType->process_id }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', __('models/processTypes.fields.type').':') !!}
    <p>{{ $processType->type }}</p>
</div>

