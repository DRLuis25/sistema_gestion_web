<!-- Company Id Field -->
<div class="col-sm-12">
    {!! Form::label('company_id', __('models/perspectiveCompanies.fields.company_id').':') !!}
    <p>{{ $perspectiveCompany->company->name }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', __('models/perspectiveCompanies.fields.descripcion').':') !!}
    <p>{{ $perspectiveCompany->descripcion }}</p>
</div>

