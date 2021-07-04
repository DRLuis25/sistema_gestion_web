<!-- Supply Chain Id Field -->
<div class="col-sm-12">
    {!! Form::label('supply_chain_id', __('models/supplyChainCustomers.fields.supply_chain_id').':') !!}
    <p>{{ $supplyChainCustomer->supply_chain_id }}</p>
</div>

<!-- Customer Id Field -->
<div class="col-sm-12">
    {!! Form::label('customer_id', __('models/supplyChainCustomers.fields.customer_id').':') !!}
    <p>{{ $supplyChainCustomer->customer_id }}</p>
</div>

<!-- Parent Customer Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_customer_id', __('models/supplyChainCustomers.fields.parent_customer_id').':') !!}
    <p>{{ $supplyChainCustomer->parent_customer_id }}</p>
</div>

<!-- Level Id Field -->
<div class="col-sm-12">
    {!! Form::label('level_id', __('models/supplyChainCustomers.fields.level_id').':') !!}
    <p>{{ $supplyChainCustomer->level_id }}</p>
</div>

