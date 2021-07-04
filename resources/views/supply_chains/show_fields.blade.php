<!-- Business Unit Id Field -->
<div class="col-sm-2">
    {!! Form::label('business_unit_id', __('models/supplyChains.fields.business_unit_id').':') !!}
    <p>{{ $supplyChain->businessUnit->name }}</p>
</div>

<!-- Period Field -->
<div class="col-sm-2">
    {!! Form::label('period', __('models/supplyChains.fields.period').':') !!}
    <p>{{ $supplyChain->period }}</p>
</div>

<!-- Launch Field -->
<div class="col-sm-2">
    {!! Form::label('launch', __('models/supplyChains.fields.launch').':') !!}
    <p>{{ $supplyChain->launch }}</p>
</div>

