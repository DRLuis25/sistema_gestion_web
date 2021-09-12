<!-- Company Id Field -->
<input type="hidden" value="{{ $company_id }}" name="company_id">

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', __('models/perspectiveCompanies.fields.descripcion').':') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>
