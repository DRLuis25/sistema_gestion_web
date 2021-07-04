<!-- Company Id Field -->
{!! Form::hidden('company_id', $company_id) !!}

<!-- Dni Field -->
<div class="form-group col-sm-2">
    {!! Form::label('dni', __('models/customers.fields.dni').':') !!}
    {!! Form::text('dni', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', __('models/customers.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('last_name', __('models/customers.fields.last_name').':') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Field -->
<div class="form-group col-sm-2">
    {!! Form::label('contact', __('models/customers.fields.contact').':') !!}
    {!! Form::text('contact', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', __('models/customers.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/customers.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
