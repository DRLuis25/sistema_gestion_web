<!-- Process Map Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_map_id', __('models/processes.fields.process_map_id').':') !!}
    <p>{{ $process->process_map_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/processes.fields.name').':') !!}
    <p>{{ $process->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/processes.fields.description').':') !!}
    <p>{{ $process->description }}</p>
</div>

<!-- Parent Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_process_id', __('models/processes.fields.parent_process_id').':') !!}
    <p>{{ $process->parent_process_id }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', __('models/processes.fields.status').':') !!}
    <p>{{ $process->status }}</p>
</div>

