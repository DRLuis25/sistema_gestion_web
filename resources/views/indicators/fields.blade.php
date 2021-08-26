<!-- Process Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/indicators.fields.process_id').':') !!}
    {!! Form::number('process_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Frecuency Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('frecuency_id', __('models/indicators.fields.frecuency_id').':') !!}
    {!! Form::number('frecuency_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', __('models/indicators.fields.descripcion').':') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Objetivo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('objetivo', __('models/indicators.fields.objetivo').':') !!}
    {!! Form::text('objetivo', null, ['class' => 'form-control']) !!}
</div>

<!-- Responsable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsable', __('models/indicators.fields.responsable').':') !!}
    {!! Form::text('responsable', null, ['class' => 'form-control']) !!}
</div>

<!-- Iniciativas Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('iniciativas', __('models/indicators.fields.iniciativas').':') !!}
    {!! Form::textarea('iniciativas', null, ['class' => 'form-control']) !!}
</div>

<!-- Linea Base Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('linea_base', __('models/indicators.fields.linea_base').':') !!}
    {!! Form::textarea('linea_base', null, ['class' => 'form-control']) !!}
</div>

<!-- Meta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta', __('models/indicators.fields.meta').':') !!}
    {!! Form::text('meta', null, ['class' => 'form-control']) !!}
</div>

<!-- Formula Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('formula', __('models/indicators.fields.formula').':') !!}
    {!! Form::textarea('formula', null, ['class' => 'form-control']) !!}
</div>

<!-- Verde Field -->
<div class="form-group col-sm-6">
    {!! Form::label('verde', __('models/indicators.fields.verde').':') !!}
    {!! Form::number('verde', null, ['class' => 'form-control']) !!}
</div>

<!-- Rojo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rojo', __('models/indicators.fields.rojo').':') !!}
    {!! Form::number('rojo', null, ['class' => 'form-control']) !!}
</div>
