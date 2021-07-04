<!-- Ruc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ruc', __('models/companies.fields.ruc').':') !!}
    {!! Form::text('ruc', null, ['class' => 'form-control','minlength'=>'11','onkeypress'=>'if ( isNaN( String.fromCharCode(event.keyCode) )) return false;']) !!}

</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/companies.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/companies.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/companies.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/companies.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
