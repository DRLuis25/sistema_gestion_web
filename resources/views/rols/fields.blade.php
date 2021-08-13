<input type="hidden" value="{{$process_map_id}}" name="process_map_id">
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/rols.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
