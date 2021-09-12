<!-- Company Id Field -->
<div class="col-sm-12">
    {!! Form::label('company_id', __('models/objectiveCompanies.fields.company_id').':') !!}
    <p>{{ $objectiveCompany->company_id }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', __('models/objectiveCompanies.fields.descripcion').':') !!}
    <p>{{ $objectiveCompany->descripcion }}</p>
</div>

