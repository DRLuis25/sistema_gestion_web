<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/objectives.fields.process_id').':') !!}
    <p>{{ $objective->process_id }}</p>
</div>

<!-- Perspective Id Field -->
<div class="col-sm-12">
    {!! Form::label('perspective_id', __('models/objectives.fields.perspective_id').':') !!}
    <p>{{ $objective->perspective_id }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', __('models/objectives.fields.descripcion').':') !!}
    <p>{{ $objective->descripcion }}</p>
</div>

<!-- Level Field -->
<div class="col-sm-12">
    {!! Form::label('level', __('models/objectives.fields.level').':') !!}
    <p>{{ $objective->level }}</p>
</div>

