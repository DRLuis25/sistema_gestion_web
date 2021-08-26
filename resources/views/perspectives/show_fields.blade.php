<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/perspectives.fields.process_id').':') !!}
    <p>{{ $perspective->process_id }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', __('models/perspectives.fields.descripcion').':') !!}
    <p>{{ $perspective->descripcion }}</p>
</div>

