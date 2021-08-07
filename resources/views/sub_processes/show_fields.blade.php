<!-- Process Map Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_map_id', __('models/subProcesses.fields.process_map_id').':') !!}
    <p>{{ $subProcess->process_map_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/subProcesses.fields.name').':') !!}
    <p>{{ $subProcess->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/subProcesses.fields.description').':') !!}
    <p>{{ $subProcess->description }}</p>
</div>

<!-- Parent Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_process_id', __('models/subProcesses.fields.parent_process_id').':') !!}
    <p>{{ $subProcess->parent_process_id }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/subProcesses.fields.status').':') !!}
    <p>{{ $subProcess->status }}</p>
</div>

