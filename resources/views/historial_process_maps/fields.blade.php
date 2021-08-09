<!-- Process Map Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_map_id', __('models/historialProcessMaps.fields.process_map_id').':') !!}
    {!! Form::number('process_map_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/historialProcessMaps.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', __('models/historialProcessMaps.fields.data').':') !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
</div>
