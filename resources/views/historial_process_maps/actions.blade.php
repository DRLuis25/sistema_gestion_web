{!! Form::open(['route' => ['historialProcessMaps.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('leer_historial_mapa_proceso')
        <a href="{{ route('historialProcessMaps.show', [$id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @can('eliminar_historial_mapa_proceso')
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan
    </div>
{!! Form::close() !!}
