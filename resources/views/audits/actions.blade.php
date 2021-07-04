{!! Form::open(['route' => ['roles.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('roles.show', [$id]) }}" class='btn btn-default btn-xs'>
        <i class="far fa-eye"></i>
    </a>
</div>
{!! Form::close() !!}
