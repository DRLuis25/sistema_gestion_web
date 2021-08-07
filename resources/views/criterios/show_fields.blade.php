<!-- Process Map Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_map_id', __('models/criterios.fields.process_map_id').':') !!}
    <p>{{ $criterio->process_map_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/criterios.fields.name').':') !!}
    <p>{{ $criterio->name }}</p>
</div>

<!-- Peso Field -->
<div class="col-sm-12">
    {!! Form::label('peso', __('models/criterios.fields.peso').':') !!}
    <p>{{ $criterio->peso }}</p>
</div>

