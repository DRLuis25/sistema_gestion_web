{!! Form::open(['route' => ['criterios.destroy', $id, $process_map_id, $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('leer_criterio')
        <a href="{{ route('criterios.show', [$id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @can('modificar_criterio')
        <a href="{{ route('criterios.edit', [$id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-edit"></i>
        </a>
    @endcan
    @can('eliminar_criterio')
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan
    </div>
{!! Form::close() !!}
