<!-- Company Id Field -->
{!! Form::hidden('company_id', $company_id) !!}
<!-- Period Field -->
<div class="form-group col-sm-6">
    {!! Form::label('period', __('models/processMaps.fields.period').':') !!}
    {!! Form::text('period', null, ['class' => 'form-control']) !!}
</div>

<!-- Launch Field -->
<div class="form-group col-sm-6">
    {!! Form::label('launch', __('models/processMaps.fields.launch').':') !!}
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
