<!-- Company Id Field -->
<input type="hidden" name="company_id" value="{{$company_id}}">

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', __('models/objectiveCompanies.fields.descripcion').':') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>
