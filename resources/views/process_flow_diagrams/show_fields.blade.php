<!-- Process Map Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_map_id', __('models/processFlowDiagrams.fields.process_map_id').':') !!}
    <p>{{ $processFlowDiagram->process_map_id }}</p>
</div>

<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/processFlowDiagrams.fields.process_id').':') !!}
    <p>{{ $processFlowDiagram->process_id }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('data', __('models/processFlowDiagrams.fields.data').':') !!}
    <p>{{ $processFlowDiagram->data }}</p>
</div>

