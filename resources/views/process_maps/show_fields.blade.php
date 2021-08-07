<!-- Business Unit Id Field -->
<div class="col-sm-2">
    {!! Form::label('business_unit_id', __('models/processMaps.fields.business_unit_id').':') !!}
    <p>{{ $processMap->businessUnit->name }}</p>
</div>

<!-- Period Field -->
<div class="col-sm-2">
    {!! Form::label('period', __('models/processMaps.fields.period').':') !!}
    <p>{{ $processMap->period }}</p>
</div>

<!-- Launch Field -->
<div class="col-sm-2">
    {!! Form::label('launch', __('models/processMaps.fields.launch').':') !!}
    <p>{{ $processMap->launch }}</p>
</div>

<p>{{ $process_map_id }}</p>
<p>{{ $company_id }}</p>
