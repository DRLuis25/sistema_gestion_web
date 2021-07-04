<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/audits.fields.description').':') !!}
    <p>{{ $audit->description }}</p>
</div>

<!-- Subject Id Field -->
<div class="col-sm-12">
    {!! Form::label('subject_id', __('models/audits.fields.subject_id').':') !!}
    <p>{{ $audit->subject_id }}</p>
</div>

<!-- Subject Type Field -->
<div class="col-sm-12">
    {!! Form::label('subject_type', __('models/audits.fields.subject_type').':') !!}
    <p>{{ $audit->subject_type }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/audits.fields.user_id').':') !!}
    <p>{{ $audit->user_id }}</p>
</div>

<!-- Properties Field -->
<div class="col-sm-12">
    {!! Form::label('properties', __('models/audits.fields.properties').':') !!}
    <p>{{ $audit->properties }}</p>
</div>

<!-- Host Field -->
<div class="col-sm-12">
    {!! Form::label('host', __('models/audits.fields.host').':') !!}
    <p>{{ $audit->host }}</p>
</div>

