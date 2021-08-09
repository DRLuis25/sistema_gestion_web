{!! Form::open(['route' => ['seguimientoPropuestos.destroy', $company_id, $process_map_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @if ($propuestos>1)
            @can('ver_diagrama_seguimiento')
                <a href="{{ route('getSeguimientoPropuesto', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-eye"></i>
                </a>
            @endcan
        @endif
        @can('ver_seguimiento')
            <a href="{{ route('seguimientoPropuestos.show', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                <i class="far fa-edit"></i>
            </a>
        @endcan
        @if ($propuestos!=0)
            @can('eliminar_seguimiento')
                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
            @endcan
        @endif

    </div>
{!! Form::close() !!}
