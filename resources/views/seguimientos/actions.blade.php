{!! Form::open(['route' => ['seguimientos.destroy', $company_id, $process_map_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @can('ver_diagrama_seguimiento')
            <a href="{{ route('getSeguimiento', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                <i class="far fa-eye"></i>
            </a>
        @endcan
        @can('ver_seguimiento')
            <a href="{{ route('seguimientos.show', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                <i class="far fa-edit"></i>
            </a>
        @endcan
        @can('eliminar_seguimiento')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan
    </div>
{!! Form::close() !!}
