<!-- Process Map Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_map_id', __('models/processFlowDiagrams.fields.process_map_id').':') !!}
    {!! Form::number('process_map_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/processFlowDiagrams.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', __('models/processFlowDiagrams.fields.data').':') !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
</div>
