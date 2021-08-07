<!-- Process Map Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_map_id', __('models/subProcesses.fields.process_map_id').':') !!}
    {!! Form::number('process_map_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/subProcesses.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/subProcesses.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_process_id', __('models/subProcesses.fields.parent_process_id').':') !!}
    {!! Form::number('parent_process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-check col-sm-6">
        {!! Form::hidden('status', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('status', '1', null, ['class' => 'form-check-input']) !!} 1
        {!! Form::label('status', __('models/subProcesses.fields.status').':', ['class' => 'form-check-label']) !!}
</div>

