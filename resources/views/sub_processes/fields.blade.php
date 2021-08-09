
<input type="text" name="process_map_id" value="@isset($subProcess){{$subProcess->process_map_id}}@else{{$process_map_id}}@endisset">
<input type="text" name="parent_process_id" value="@isset($subProcess){{$subProcess->parent_process_id}}@else{{$process_id}}@endisset">

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/subProcesses.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/subProcesses.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
