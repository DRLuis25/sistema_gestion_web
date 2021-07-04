<!-- Ruc Field -->
<div class="col-sm-12">
    {!! Form::label('ruc', __('models/suppliers.fields.ruc').':') !!}
    <p>{{ $supplier->ruc }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/suppliers.fields.name').':') !!}
    <p>{{ $supplier->name }}</p>
</div>

<!-- Contact Name Field -->
<div class="col-sm-12">
    {!! Form::label('contact_name', __('models/suppliers.fields.contact_name').':') !!}
    <p>{{ $supplier->contact_name }}</p>
</div>

<!-- Contact Field -->
<div class="col-sm-12">
    {!! Form::label('contact', __('models/suppliers.fields.contact').':') !!}
    <p>{{ $supplier->contact }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/suppliers.fields.email').':') !!}
    <p>{{ $supplier->email }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', __('models/suppliers.fields.address').':') !!}
    <p>{{ $supplier->address }}</p>
</div>

<!-- Company Id Field -->
<div class="col-sm-12">
    {!! Form::label('company_id', __('models/suppliers.fields.company_id').':') !!}
    <p>{{ $supplier->company_id }}</p>
</div>

