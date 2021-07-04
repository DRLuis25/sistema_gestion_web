<!-- Supply Chain Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supply_chain_id', __('models/supplyChainCustomers.fields.supply_chain_id').':') !!}
    {!! Form::number('supply_chain_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', __('models/supplyChainCustomers.fields.customer_id').':') !!}
    {!! Form::number('customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_customer_id', __('models/supplyChainCustomers.fields.parent_customer_id').':') !!}
    {!! Form::number('parent_customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', __('models/supplyChainCustomers.fields.level_id').':') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div>
