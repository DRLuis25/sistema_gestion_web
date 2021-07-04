<!-- Supply Chain Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supply_chain_id', __('models/supplyChainSuppliers.fields.supply_chain_id').':') !!}
    {!! Form::number('supply_chain_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Supplier Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supplier_id', __('models/supplyChainSuppliers.fields.supplier_id').':') !!}
    {!! Form::number('supplier_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Supplier Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_supplier_id', __('models/supplyChainSuppliers.fields.parent_supplier_id').':') !!}
    {!! Form::number('parent_supplier_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', __('models/supplyChainSuppliers.fields.level_id').':') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div>
