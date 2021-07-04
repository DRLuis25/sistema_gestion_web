<!-- Company Id Field -->
<div class="col-sm-12">
    {!! Form::label('company_id', __('models/businessUnits.fields.company_id').':') !!}
    <p>{{ $businessUnit->company_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/businessUnits.fields.name').':') !!}
    <p>{{ $businessUnit->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/businessUnits.fields.description').':') !!}
    <p>{{ $businessUnit->description }}</p>
</div>

