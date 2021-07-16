<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/roles.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Guard Name Field -->
<div class="form-group col-sm-6">
    <label for="permission">{{  __('models/roles.fields.permissions').':' }}</label> <br>

    <select id="permission" name="permission[]" multiple class="form-control chosen">

        <option value="">Selecciona una opción</option>
        @foreach($permissions as $key => $entry)
            <option value="{{ $entry->name }}"
            {{ (collect(old('permission'))->contains($entry->name)) ? 'selected':'' }}
            @isset($role) {{ (in_array($entry->name,$role->getPermissionNames()->toArray())) ? 'selected' : ''}} @endisset
            />
            {{ $entry->name }}</option>
        @endforeach
    </select>
</div>
