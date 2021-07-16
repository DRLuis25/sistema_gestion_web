<!-- Company Id Field -->
{!! Form::hidden('company_id', $company_id) !!}

<!-- Period Field -->
<div class="form-group col-sm-6">
    {!! Form::label('period', __('models/supplyChains.fields.period').':') !!}
    {!! Form::text('period', null, ['class' => 'form-control']) !!}
</div>

<!-- Launch Field -->
<div class="form-group col-sm-6">
    {!! Form::label('launch', __('models/supplyChains.fields.launch').':') !!}
    {!! Form::date('launch', null, ['class' => 'form-control','id'=>'launch']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#launch').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Status Field -->
{!! Form::hidden('status', 1, ['class' => 'form-check-input']) !!}
{{-- <div class="form-check col-sm-6">

        {!! Form::checkbox('status', '1', null, ['class' => 'form-check-input']) !!} 1
        {!! Form::label('status', __('models/supplyChains.fields.status').':', ['class' => 'form-check-label']) !!}
</div>
 --}}
