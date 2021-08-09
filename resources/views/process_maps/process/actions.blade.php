{!! Form::open(['route' => ['process.destroy',$processMap,$id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('leer_proceso')
        <a href="{{ route('subProcesses.index', [$company_id,$process_map_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @can('modificar_proceso')
        <button type="button" class="btn btn-default btn-xs"
            data-toggle="modal" data-target="#editProcessModal"
            data-whatever="{{$id}}"><i class="far fa-edit"></i>
        </button>

    @endcan
    @can('eliminar_proceso')
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan
    </div>
{!! Form::close() !!}
