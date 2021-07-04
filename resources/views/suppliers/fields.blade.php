<!-- Company Id Field -->
{!! Form::hidden('company_id', $company_id) !!}
<!-- Ruc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ruc', __('models/suppliers.fields.ruc').':') !!}
    {!! Form::text('ruc', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/suppliers.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_name', __('models/suppliers.fields.contact_name').':') !!}
    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact', __('models/suppliers.fields.contact').':') !!}
    {!! Form::text('contact', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/suppliers.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/suppliers.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
