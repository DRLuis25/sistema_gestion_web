<!-- Company Id Field -->
@isset($user->company_id)
<div class="col-sm-12">
    {!! Form::label('company_id', __('models/users.fields.company_id').':') !!}
    <p>{{ $user->company_id }}</p>
</div>
@endisset

<!-- Dni Field -->
<div class="col-sm-12">
    {!! Form::label('dni', __('models/users.fields.dni').':') !!}
    <p>{{ $user->dni }}</p>
</div>

<!-- Names Field -->
<div class="col-sm-12">
    {!! Form::label('names', __('models/users.fields.names').':') !!}
    <p>{{ $user->names }}</p>
</div>

<!-- Lastnamepat Field -->
<div class="col-sm-12">
    {!! Form::label('lastNamePat', __('models/users.fields.lastNamePat').':') !!}
    <p>{{ $user->lastNamePat }}</p>
</div>

<!-- Lastnamemat Field -->
<div class="col-sm-12">
    {!! Form::label('lastNameMat', __('models/users.fields.lastNameMat').':') !!}
    <p>{{ $user->lastNameMat }}</p>
</div>
@isset($user->phone)
<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', __('models/users.fields.phone').':') !!}
    <p>{{ $user->phone }}</p>
</div>
@endisset

@isset($user->address)
<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', __('models/users.fields.address').':') !!}
    <p>{{ $user->address }}</p>
</div>
@endisset

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>
