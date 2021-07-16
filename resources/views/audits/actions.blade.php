{!! Form::open(['route' => ['audits.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('audits.show', [$id]) }}" class='btn btn-default btn-xs'>
        <i class="far fa-eye"></i>
    </a>
</div>
{!! Form::close() !!}
