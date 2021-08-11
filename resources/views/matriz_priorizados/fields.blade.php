<!-- Process Map Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_map_id', __('models/matrizPriorizados.fields.process_map_id').':') !!}
    {!! Form::number('process_map_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Process Criterio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_criterio_id', __('models/matrizPriorizados.fields.process_criterio_id').':') !!}
    {!! Form::number('process_criterio_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/matrizPriorizados.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Process Id Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('process_id_data', __('models/matrizPriorizados.fields.process_id_data').':') !!}
    {!! Form::textarea('process_id_data', null, ['class' => 'form-control']) !!}
</div>

<!-- Process Values Data Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('process_values_data', __('models/matrizPriorizados.fields.process_values_data').':') !!}
    {!! Form::textarea('process_values_data', null, ['class' => 'form-control']) !!}
</div>
