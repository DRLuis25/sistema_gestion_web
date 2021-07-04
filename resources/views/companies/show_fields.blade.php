<!-- Ruc Field -->
<div class="col-sm-12">
    {!! Form::label('ruc', __('models/companies.fields.ruc').':') !!}
    <p>{{ $company->ruc }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/companies.fields.name').':') !!}
    <p>{{ $company->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/companies.fields.description').':') !!}
    <p>{{ $company->description }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', __('models/companies.fields.phone').':') !!}
    <p>{{ $company->phone }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', __('models/companies.fields.address').':') !!}
    <p>{{ $company->address }}</p>
</div>

