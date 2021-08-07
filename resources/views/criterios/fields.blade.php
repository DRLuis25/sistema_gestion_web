<!-- Process Map Id Field -->
{!! Form::hidden('process_map_id', $process_map_id) !!}

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/criterios.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/criterios.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Peso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('peso', __('models/criterios.fields.peso').':') !!}
    {!! Form::number('peso', null, ['class' => 'form-control','min'=>'1']) !!}
</div>
