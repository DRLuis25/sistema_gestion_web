{!! Form::open(['route' => ['subProcesses.destroy', $company_id,$process_map_id,$parent_process_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @can('modificar_subproceso')
            <a href="{{ route('subProcesses.edit', [$company_id,$process_map_id,$parent_process_id, $id]) }}" class='btn btn-default btn-xs'>
                <i class="far fa-edit"></i>
            </a>
        @endcan
        @can('eliminar_subproceso')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan
    </div>
{!! Form::close() !!}
