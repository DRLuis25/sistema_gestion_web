<!-- Dni Field -->
<div class="col-sm-12">
    {!! Form::label('dni', __('models/customers.fields.dni').':') !!}
    <p>{{ $customer->dni }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/customers.fields.name').':') !!}
    <p>{{ $customer->name }}</p>
</div>

<!-- Last Name Field -->
<div class="col-sm-12">
    {!! Form::label('last_name', __('models/customers.fields.last_name').':') !!}
    <p>{{ $customer->last_name }}</p>
</div>

<!-- Contact Field -->
<div class="col-sm-12">
    {!! Form::label('contact', __('models/customers.fields.contact').':') !!}
    <p>{{ $customer->contact }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/customers.fields.email').':') !!}
    <p>{{ $customer->email }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', __('models/customers.fields.address').':') !!}
    <p>{{ $customer->address }}</p>
</div>

<!-- Company Id Field -->
<div class="col-sm-12">
    {!! Form::label('company_id', __('models/customers.fields.company_id').':') !!}
    <p>{{ $customer->company_id }}</p>
</div>

