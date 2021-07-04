<!-- Company Id Field -->
{!! Form::hidden('company_id', $company_id) !!}

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/businessUnits.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/businessUnits.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
