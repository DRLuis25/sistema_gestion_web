<!-- Company Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_id', __('models/users.fields.company_id').':') !!}

    <select class="form-control" name="company_id" id="company_id" required>
        <option value="">Seleccione empresa</option>
        @foreach($companies as $id => $entry)
            <option value="{{ $id }}"
            @isset($user) {{ $id == $user->company_id ? 'selected' : ''}} @endisset
            {{ old('company_id') == $id ? 'selected' : '' }}/>
            {{ $entry }}
            </option>
        @endforeach
    </select>
</div>

<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', __('models/users.fields.dni').':') !!}
    {!! Form::number('dni', null, ['class' => 'form-control']) !!}
</div>

<!-- Names Field -->
<div class="form-group col-sm-6">
    {!! Form::label('names', __('models/users.fields.names').':') !!}
    {!! Form::text('names', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastnamepat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastNamePat', __('models/users.fields.lastNamePat').':') !!}
    {!! Form::text('lastNamePat', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastnamemat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastNameMat', __('models/users.fields.lastNameMat').':') !!}
    {!! Form::text('lastNameMat', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/users.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/users.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    <label for="role">{{  __('models/users.fields.role').':' }}</label> <br>
    <select id="role" name="role[]" multiple class="form-control chosen">
        <option value="">Selecciona una opción</option>
        @foreach($roles as $key => $entry)
            <option value="{{ $entry }}"
            {{ (collect(old('role'))->contains($key)) ? 'selected':'' }}
            @isset($user) {{ (in_array($key,$user->roles->pluck('name')->toArray())) ? 'selected' : ''}} @endisset
            />
            {{ $entry }}</option>
        @endforeach
    </select>
</div>

<!-- is_admin Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('is_admin', 0, ['class' => 'form-check-input']) !!}
    {!! Form::checkbox('is_admin', '1', null, ['class' => '']) !!}
    {!! Form::label('is_admin', __('models/users.fields.is_admin').':', ['class' => 'form-check-label']) !!}
</div>
