<!-- Business Unit Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('business_unit_id', __('models/historials.fields.business_unit_id').':') !!}
    {!! Form::number('business_unit_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/historials.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data', __('models/historials.fields.data').':') !!}
    {!! Form::text('data', null, ['class' => 'form-control']) !!}
</div>
