{!! Form::open(['route' => ['historials.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('leer_historial_cadena_suministro')
        <a href="{{ route('historials.show', [$id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @can('eliminar_historial_cadena_suministro')
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan
    </div>
{!! Form::close() !!}
