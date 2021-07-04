<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/audits.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', __('models/audits.fields.subject_id').':') !!}
    {!! Form::number('subject_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_type', __('models/audits.fields.subject_type').':') !!}
    {!! Form::text('subject_type', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/audits.fields.user_id').':') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Properties Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('properties', __('models/audits.fields.properties').':') !!}
    {!! Form::textarea('properties', null, ['class' => 'form-control']) !!}
</div>

<!-- Host Field -->
<div class="form-group col-sm-6">
    {!! Form::label('host', __('models/audits.fields.host').':') !!}
    {!! Form::text('host', null, ['class' => 'form-control']) !!}
</div>
