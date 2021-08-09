{!! Form::open(['route' => ['destroySeguimientoActividad', $company_id, $process_map_id,$process_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @can('eliminar_seguimiento')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan
    </div>
{!! Form::close() !!}
