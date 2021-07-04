<!-- Supply Chain Id Field -->
<div class="col-sm-12">
    {!! Form::label('supply_chain_id', __('models/supplyChainSuppliers.fields.supply_chain_id').':') !!}
    <p>{{ $supplyChainSupplier->supply_chain_id }}</p>
</div>

<!-- Supplier Id Field -->
<div class="col-sm-12">
    {!! Form::label('supplier_id', __('models/supplyChainSuppliers.fields.supplier_id').':') !!}
    <p>{{ $supplyChainSupplier->supplier_id }}</p>
</div>

<!-- Parent Supplier Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_supplier_id', __('models/supplyChainSuppliers.fields.parent_supplier_id').':') !!}
    <p>{{ $supplyChainSupplier->parent_supplier_id }}</p>
</div>

<!-- Level Id Field -->
<div class="col-sm-12">
    {!! Form::label('level_id', __('models/supplyChainSuppliers.fields.level_id').':') !!}
    <p>{{ $supplyChainSupplier->level_id }}</p>
</div>

